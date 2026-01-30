# Updates: Image Upload, Order Status Persistence, Animations

## 1. Admin – Upload Gambar PNG/JPG/SVG

### Masalah
Bagian admin hanya bisa input path teks (biasanya SVG). Sekarang mendukung **upload file** PNG, JPG, dan SVG.

### Struktur & Alur
- **Route**: Tetap `admin.menus.store` / `admin.menus.update` (POST dengan `enctype="multipart/form-data"`).
- **Controller**: `App\Http\Controllers\Admin\MenuController`
  - `store()`: validasi `image_file` (file) dan/atau `image` (path teks), panggil `ImageService` untuk simpan file.
  - `update()`: sama; jika ada file baru, hapus file lama lewat `ImageService::deleteByPath()` lalu simpan yang baru.
- **Service** (Design Pattern: Single Responsibility): `App\Services\ImageService`
  - `validate(UploadedFile)`: cek MIME (png, jpeg, svg) dan ukuran (maks 2MB).
  - `storeMenuImage(UploadedFile, prefix)`: simpan ke `public/images/logos/`, return path untuk DB (mis. `images/logos/menu-abc123.png`).
  - `deleteByPath(path)`: hapus file di `public/images/logos/` jika path aman.
- **View**: `resources/views/admin/menus/create.blade.php` & `edit.blade.php`
  - Input file: `name="image_file"`, `accept=".png,.jpg,.jpeg,.svg"`.
  - Tetap ada input teks opsional `name="image"` untuk path manual.

### Aturan
- Format: PNG, JPG/JPEG, SVG.
- Maksimal ukuran: 2MB.
- File disimpan di `public/images/logos/` dengan nama unik (prefix + random).

---

## 2. User – Lihat Status Pesanan Tanpa Login (Tidak Hilang Saat Keluar/Tutup Browser)

### Masalah
Tanpa login, kode pesanan terakhir hanya di session. Saat user keluar/tutup browser, session bisa hilang dan tampilan “last order” ikut hilang.

### Solusi
- **Cookie** `recent_order_codes` (JSON array, maks 10 kode, masa berlaku 30 hari).
- Setelah checkout, kode pesanan disimpan di session **dan** ditambahkan ke cookie.
- Halaman **Track Order** (`/status`) membaca **session + cookie**, lalu menampilkan daftar “Pesanan terakhir Anda” dari gabungan keduanya.

### Alur
- **OrderController::store()**
  - Setelah create order: `session()->put('last_order_code', ...)`.
  - Baca cookie `recent_order_codes` → unshift kode baru → unique → slice(0, 10) → set cookie 30 hari.
- **OrderController::statusLookup()**
  - `mergeRecentOrderCodes(Request)`: gabung session + cookie, unique, max 10.
  - Pass `recentOrderCodes` ke view `pages.status`.
- **View** `resources/views/pages/status.blade.php`
  - Blok “Pesanan terakhir Anda” menampilkan list `recentOrderCodes` dengan link ke `orders.show` per kode.

### Route
- `GET /status` → `OrderController@statusLookup` (nama route: `orders.status`).
- `GET /orders/{order:order_code}` → `OrderController@show` (nama route: `orders.show`).

User bisa selalu buka **Track Order** dan memilih salah satu pesanan terakhir dari daftar, meskipun sudah menutup browser atau tidak login.

---

## 3. Model & Tampilan Gambar

- **Menu model** (`App\Models\Menu`): accessor `image_url` mendukung:
  - URL penuh (return as-is).
  - Path public: diawali `images/` → `asset($this->image)`.
  - Path storage → `asset('storage/' . $this->image)`.
- View menu (home, menu, product-card) memakai `$menu->image_url` / `$item->image_url` agar PNG/JPG/SVG dari upload maupun path lama tetap tampil benar.

---

## 4. Animasi (CSS)

### File
- `resources/css/custom.css`

### Class yang ditambah
- **Masuk**: `animate-fade-in`, `animate-fade-in-up`, `animate-slide-in-right`, `animate-scale-in`.
- **Loop**: `animate-float`, `animate-pulse-soft`.
- **Anak berurutan**: `stagger-children` (delay per child).
- **Hover**: `hover-lift` (naik sedikit + shadow).

### Pemakaian
- Layout utama: `main` dengan `animate-fade-in`.
- Halaman status & order-status: header + card pakai `animate-fade-in`, `animate-fade-in-up`, `hover-lift`, `stagger-children`.
- Halaman menu: header `animate-fade-in`, grid menu `stagger-children` + `hover-lift` per item.
- Home: hero teks `animate-fade-in-up`, logo `animate-scale-in` + `animate-float`.
- Admin: `main` dengan `animate-fade-in`.

Navbar sekarang punya link **Track Order** (desktop & mobile) ke `orders.status`.

---

## 5. Ringkasan Struktur (Route – Controller – View)

| Fitur              | Route                    | Controller                    | View / Catatan                    |
|--------------------|--------------------------|-------------------------------|-----------------------------------|
| Admin create menu  | POST admin/menus         | Admin\MenuController@store   | admin.menus.create (form + file)  |
| Admin update menu   | PUT admin/menus/{menu}   | Admin\MenuController@update  | admin.menus.edit (form + file)   |
| Track order        | GET /status              | OrderController@statusLookup | pages.status (recent dari cookie) |
| Order detail       | GET /orders/{order_code}  | OrderController@show         | pages.order-status                |
| Upload gambar      | -                        | ImageService                 | Dipakai di MenuController         |

Semua mengikuti pola Route → Controller → View dan Service/Repository yang sudah dipakai di project (design pattern tetap terjaga).
