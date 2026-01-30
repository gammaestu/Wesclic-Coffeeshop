# Mata Uang: Rupiah (IDR)

Semua harga dan pembayaran di project ini menggunakan **Rupiah (Rp)**.

---

## 1. Format tampilan

- **Pemisah ribuan:** titik (.) — contoh: `25.000`, `1.250.000`
- **Desimal:** tidak dipakai untuk Rupiah (angka bulat)
- **Contoh:** `Rp 25.000`, `Rp 1.250.000`

### Di PHP (Blade)

```php
Rp {{ number_format($price, 0, ',', '.') }}
```

- Parameter: `number_format(angka, 0 desimal, pemisah_desimal, pemisah_ribuan)`  
- Untuk Rupiah: desimal tidak dipakai, pemisah ribuan = titik.

### Di JavaScript (cart, payment)

```javascript
function formatRupiah(n) {
    return 'Rp ' + Math.round(Number(n)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
```

---

## 2. Seeder (MenuSeeder)

- **File:** `database/seeders/MenuSeeder.php`
- Semua `price` menu disimpan dalam **Rupiah (integer)**.
- Contoh: Espresso `25000`, Latte `35000`, Tiramisu `42000`.
- Setelah ubah seeder, jalankan:  
  `php artisan db:seed --class=MenuSeeder`  
  (atau `php artisan migrate:fresh --seed` jika ingin reset DB.)

---

## 3. Tempat yang memakai Rupiah

| Lokasi | Keterangan |
|--------|------------|
| **Admin** | Dashboard (Recent Menus), Daftar Menu, Daftar Order, Detail Order, Form Tambah/Edit Menu (label "Harga (Rupiah)", prefix input "Rp") |
| **Front** | Product card, Menu detail, Cart, Checkout (payment), Order status, Halaman bayar (pay) |
| **Export** | Excel & PDF: kolom Total dalam format Rp (titik pemisah ribuan) |

---

## 4. Validasi & backend

- **Menu (admin):** `price` → `required`, `numeric`, `min:0` (nilai dalam Rupiah).
- **Order:** `total_price` dihitung dari harga menu (Rupiah) × quantity; tidak ada konversi mata uang.
- **Midtrans:** `gross_amount` dikirim dalam Rupiah (integer); Midtrans Indonesia mendukung IDR.

---

## 5. Checklist

- [x] MenuSeeder: semua price dalam Rupiah (integer).
- [x] View admin & front: tampil "Rp" + `number_format(..., 0, ',', '.')`.
- [x] Form menu: label "Harga (Rupiah)", prefix "Rp", `step="1"`, placeholder `25000`.
- [x] Cart & payment (JS): format Rupiah tanpa desimal, pemisah ribuan titik.
- [x] Export Excel/PDF: Total dalam format Rp.
