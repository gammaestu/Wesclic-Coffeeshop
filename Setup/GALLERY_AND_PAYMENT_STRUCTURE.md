# Struktur Gallery & Payment (Midtrans + Track Order)

Dokumen ini menjelaskan **route → controller → view**, struktur folder, dan design pattern untuk **Gallery** (bukan dari menu, layout masonry) dan **Payment** (bayar di tempat + Transfer/QRIS via Midtrans) serta integrasi dengan **Track Order**.

---

## 1. Gallery (Bukan Menu, Layout Random/Rapi)

### Konsep
- **Sumber gambar:** Bukan dari menu. Gambar suasana kopi / orang minum kopi dari **config** (Unsplash atau URL lain).
- **Layout:** Masonry-style — ukuran **random tapi rapi** (square, tall, wide) dengan CSS Grid (`row-span-2`, `col-span-2`).

### Route
| Method | URI | Name | Controller |
|--------|-----|------|------------|
| GET | `/gallery` | `gallery` | `GalleryController@index` |

### Controller
**GalleryController** — `app/Http/Controllers/GalleryController.php`
- `index(): View` — baca `config('gallery.images')`, map ke array (id, image_url, caption, size), return view `pages.gallery` dengan `$items`.

### Config
**config/gallery.php**
- Array `images`: tiap item `url`, `caption`, `size` (`square` | `tall` | `wide`).
- Bisa diganti URL atau tambah gambar lokal.

### View
**resources/views/pages/gallery.blade.php**
- Hero + grid rapi: `grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5`, tiap item `aspect-[4/3]` (ukuran seragam, layout rapi).
- Gambar: `onerror` fallback ke URL placeholder jika gambar gagal dimuat (mis. URL Unsplash berubah/404).
- Lightbox saat klik gambar.

### Struktur folder terkait
```
config/
  gallery.php
app/Http/Controllers/
  GalleryController.php
resources/views/pages/
  gallery.blade.php
routes/
  web.php  (GET /gallery)
```

---

## 2. Payment: Bayar di Tempat + Transfer (Midtrans)

### Konsep
- **Bayar di tempat (cash):** Order dibuat, `payment_method = cash`, customer bayar di kasir.
- **Transfer / QRIS / E-wallet:** Order dibuat, `payment_method = transfer`, customer diarahkan ke halaman bayar → Snap Midtrans → setelah bayar, webhook update status order.

### Design pattern
- **Service layer:** `PaymentGatewayService` — semua logika Midtrans (create snap token, config). Controller tetap tipis.
- **Lazy initialization:** Config Midtrans **tidak** di-set di constructor; hanya di-set saat `createSnapToken()` dipanggil (`ensureMidtransConfig()`). Dengan ini, app tidak throw exception jika `.env` belum berisi `MIDTRANS_SERVER_KEY` (mis. halaman `/payment` tetap bisa dibuka, hanya opsi Transfer disembunyikan).
- **Single responsibility:** OrderController hanya create order; OrderPaymentController hanya halaman bayar + snap token; PaymentNotificationController hanya handle webhook.

### Route
| Method | URI | Name | Controller |
|--------|-----|------|------------|
| GET | `/payment` | `payment` | `PaymentController@index` |
| POST | `/checkout` | `checkout.store` | `OrderController@store` |
| GET | `/orders/{order_code}` | `orders.show` | `OrderController@show` |
| GET | `/orders/{order_code}/pay` | `orders.pay` | `OrderPaymentController@show` |
| GET | `/payment/finish` | `payment.finish` | `PaymentController@finish` |
| GET | `/payment/error` | `payment.error` | `PaymentController@error` |
| POST | `/payment/notification` | `payment.notification` | `PaymentNotificationController` (webhook, no CSRF) |

### Controller
- **PaymentController** — `app/Http/Controllers/PaymentController.php`  
  - `index()`: kirim `canUseTransfer` (dari PaymentGatewayService) ke view.  
  - `finish(Request)`: redirect dari Midtrans success → orders.show atau status.  
  - `error(Request)`: redirect dari Midtrans error → orders.show dengan pesan error.

- **OrderController** — `app/Http/Controllers/OrderController.php`  
  - `store(Request)`: validasi + `payment_method` (cash | transfer). Create order dengan `payment_method`; redirect ke `orders.show`.

- **OrderPaymentController** — `app/Http/Controllers/OrderPaymentController.php`  
  - `show(Request, Order)`: hanya untuk order unpaid + payment_method transfer. Buat snap token via PaymentGatewayService, return view `pages.pay` dengan snap_token, client_key, snap_script_url.

- **PaymentNotificationController** — `app/Http/Controllers/PaymentNotificationController.php` (invokable)  
  - Terima POST dari Midtrans, parse Notification, update Order (payment_status, paid_at) dan Payment (status, paid_at), log ke PaymentLog. Return 200 OK.

### Service
**PaymentGatewayService** — `app/Services/PaymentGatewayService.php`
- `createSnapToken(Order $order): string` — panggil `ensureMidtransConfig()` (set Midtrans config sekali), build transaction params (order_code, gross_amount, item_details, customer_details), panggil Snap::getSnapToken, simpan Payment record (pending), return token. Jika key kosong, throw sehingga controller bisa redirect dengan pesan "belum dikonfigurasi".
- `isConfigured(): bool` — cek `config('midtrans.server_key')` terisi (tanpa set MidtransConfig), untuk tampilkan opsi Transfer di checkout.

### Config & env
- **config/midtrans.php:** `server_key`, `client_key`, `is_production` dari env.
- **.env:** `MIDTRANS_SERVER_KEY`, `MIDTRANS_CLIENT_KEY`, `MIDTRANS_IS_PRODUCTION=false`.

### View
- **pages/payment.blade.php** — form checkout + pilihan **Metode Pembayaran**: Bayar di tempat (cash) / Transfer–QRIS–E-wallet (hanya jika Midtrans configured). Submit ke `checkout.store` dengan `payment_method`.
- **pages/pay.blade.php** — halaman bayar untuk order: load Snap script, tombol “Buka Halaman Pembayaran” memanggil `snap.pay(snapToken)` dengan callback success → payment.finish, pending → orders.show, error → payment.error.
- **pages/order-status.blade.php** — tampilkan status + metode bayar. Jika unpaid dan payment_method = transfer, tampilkan **“Bayar Sekarang”** link ke `orders.pay`. Tampilkan flash success/error/info.

### Integrasi Track Order
- Setelah order dibuat (cash atau transfer), user diarahkan ke **orders.show** (order status).
- Jika **transfer** dan belum bayar: tombol **“Bayar Sekarang”** → `orders.pay` → Snap → setelah bayar, Midtrans kirim POST ke **payment/notification** → backend update order payment_status → user bisa cek lagi di **Track Order** (status atau orders.show); redirect finish/error juga ke orders.show/status.

### Struktur folder
```
app/
  Http/Controllers/
    PaymentController.php
    OrderController.php
    OrderPaymentController.php
    PaymentNotificationController.php
  Services/
    PaymentGatewayService.php
  Models/
    Order.php
    Payment.php
    PaymentLog.php
config/
  midtrans.php
resources/views/pages/
  payment.blade.php
  pay.blade.php
  order-status.blade.php
  status.blade.php
routes/
  web.php
.env / .env.example  (MIDTRANS_*)
```

### Midtrans Dashboard
- Di **Merchant Admin (MAP)** set **Notification URL** ke: `https://your-domain.com/payment/notification` (POST).
- Sandbox: pakai Server Key & Client Key sandbox; production: ganti ke production key dan set `MIDTRANS_IS_PRODUCTION=true`.

---

## 3. Dashboard Admin — Pendapatan Hanya Order Dibayar

- **DashboardChartService** (`app/Services/DashboardChartService.php`) dipakai untuk grafik dan kartu pendapatan di admin.
- **Pendapatan (revenue)** hanya menghitung order dengan **`payment_status = 'paid'`** — order yang belum dibayar (unpaid) **tidak** masuk ke Total Pendapatan, Pendapatan Hari Ini, Pendapatan Bulan Ini, maupun grafik pendapatan per hari/bulan.
- Grafik **penjualan** (jumlah order) tetap menghitung semua order; yang dibatasi hanya angka uang (revenue).

---

## 4. Ringkasan alur

1. **Checkout:** User isi data + pilih **Bayar di tempat** atau **Transfer/QRIS**. Submit → OrderController store → redirect ke orders.show.
2. **Order status:** Tampil status + metode bayar. Jika transfer & unpaid → tombol “Bayar Sekarang” → orders.pay.
3. **Pay page:** OrderPaymentController buat snap token, view load Snap → user klik bayar → snap.pay() → Midtrans.
4. **Setelah bayar:** Midtrans POST ke payment/notification → backend update order + payment. User di-redirect finish/error ke orders.show atau status.
5. **Track order:** Halaman status / orders.show menampilkan status terbaru (termasuk “Lunas” setelah webhook).

---

## 5. Checklist

- [ ] Isi `config/gallery.php` (atau ganti URL) untuk gambar gallery.
- [ ] Isi `.env`: `MIDTRANS_SERVER_KEY`, `MIDTRANS_CLIENT_KEY` (sandbox/production).
- [ ] Set Notification URL di Midtrans ke `https://your-domain.com/payment/notification`.
- [ ] Test bayar di tempat: order dengan cash → cek order status.
- [ ] Test transfer: order dengan transfer → Bayar Sekarang → Snap → bayar (sandbox) → cek webhook & status order.
