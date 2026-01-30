# Struktur Map Terintegrasi & Gallery

Dokumen ini menjelaskan **route → controller → view** dan struktur folder untuk fitur **Peta (Contact)** dan **Gallery** secara rinci.

---

## 1. Peta Terintegrasi (Lokasi Akurat)

### Masalah sebelumnya
- Peta memakai OpenStreetMap dengan bbox/marker tetap; koordinat bisa mengarah ke tempat lain (mis. gudang).
- Tidak ada cara mengatur lokasi tepat dari admin.

### Solusi
- **Settings** menyimpan `map_lat`, `map_lng`, `map_place_query`.
- Halaman Contact memakai **Google Maps embed** dengan URL dari settings (koordinat atau query).
- Admin bisa mengisi koordinat tepat atau nama tempat di **Settings**.

---

### Route (Peta)

| Method | URI | Name | Controller |
|--------|-----|------|------------|
| GET | `/contact` | `contact` | `ContactController@index` |
| POST | `/contact` | `contact.store` | `ContactController@store` |

**Admin (untuk mengatur peta):**

| Method | URI | Name | Controller |
|--------|-----|------|------------|
| GET | `/admin/settings` | `admin.settings.edit` | `SettingsController@edit` |
| PUT | `/admin/settings` | `admin.settings.update` | `SettingsController@update` |

**File route:** `routes/web.php` (contact), `routes/admin.php` (settings).

---

### Controller

**ContactController** — `app/Http/Controllers/ContactController.php`

- `index(): View`  
  - Memanggil `Setting::getShopSettings()`.  
  - Return view `pages.contact` dengan variabel `$settings`.  
  - View memakai `$settings->map_embed_url`, `$settings->map_link_url`, `$settings->shop_address`, `$settings->shop_phone`.

**SettingsController (Admin)** — `app/Http/Controllers/Admin/SettingsController.php`

- `edit(): View` — menampilkan form settings (termasuk map_lat, map_lng, map_place_query).
- `update(Request): RedirectResponse` — validasi dan update settings (termasuk map fields).

---

### Model

**Setting** — `app/Models/Setting.php`

- **Fillable:** `shop_name`, `shop_address`, `shop_phone`, `shop_logo`, `tax`, `map_lat`, `map_lng`, `map_place_query`.
- **Accessor (peta):**
  - `map_embed_url`: URL iframe Google Maps.  
    - Jika `map_lat` & `map_lng` ada → `https://www.google.com/maps?q={lat},{lng}&output=embed`.  
    - Jika tidak → pakai `map_place_query` atau `shop_address` atau default "Wesclic Coffee Shop, Cobongan...".
  - `map_link_url`: URL buka di Google Maps (untuk tombol "Buka di Google Maps").

---

### View

**Contact (front)** — `resources/views/pages/contact.blade.php`

- Bagian **Lokasi Kami**:
  - Alamat teks: `$settings->shop_address` (atau fallback teks tetap).
  - Link "Buka di Google Maps": `$settings->map_link_url`.
  - Iframe peta: `src="{{ $settings->map_embed_url }}"` (Google Maps).

**Admin Settings** — `resources/views/admin/settings/edit.blade.php`

- Form tambahan untuk peta:
  - **Latitude** (`map_lat`), **Longitude** (`map_lng`).
  - **Nama tempat / alamat** (`map_place_query`) — dipakai jika lat/lng kosong.

---

### Database

**Migration:** `database/migrations/2025_01_28_000012_add_map_to_settings_table.php`

- Menambah kolom di tabel `settings`:
  - `map_lat` (decimal 10,8, nullable)
  - `map_lng` (decimal 11,8, nullable)
  - `map_place_query` (string 255, nullable)

Jalankan: `php artisan migrate`

---

### Ringkasan alur peta

1. Admin isi **Settings** → Map: Latitude, Longitude **atau** Nama tempat.
2. Front **Contact** → `ContactController@index` baca `Setting::getShopSettings()`.
3. View contact pakai `$settings->map_embed_url` (iframe) dan `$settings->map_link_url` (link).
4. Peta tampil akurat sesuai koordinat atau query yang diisi admin.

---

## 2. Gallery (Kreatif & Berisi Gambar)

### Masalah sebelumnya
- Gambar dari path lama (SVG) yang sudah tidak dipakai → gallery kosong/404.
- Tampilan sederhana dan terasa “sepi”.

### Solusi
- **Sumber gambar:** Menu yang punya foto (`image` tidak null) + fallback dari `public/images/logos` (menu-*.jpeg).
- **Tampilan:** Filter kategori, grid card, hover zoom, lightbox, caption.

---

### Route (Gallery)

| Method | URI | Name | Controller |
|--------|-----|------|------------|
| GET | `/gallery` | `gallery` | `GalleryController@index` |

**File route:** `routes/web.php`

```php
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
```

---

### Controller

**GalleryController** — `app/Http/Controllers/GalleryController.php`

- `index(): View`
  - Mengambil **Menu** dengan `status = tersedia`, `image` tidak null/kosong, dengan relasi `category`.
  - Map ke array: `id`, `image_url`, `name`, `category_name`, `category_slug`.
  - Jika tidak ada menu dengan gambar → **fallback:** baca file `menu-*.jpeg` di `public/images/logos`, buat list dengan category "Gallery".
  - Kategori unik dari items → `$categories` (slug => label), plus "Semua" (slug `all`).
  - Return view `pages.gallery` dengan `items`, `categories`.

---

### View

**Gallery** — `resources/views/pages/gallery.blade.php`

- **Hero:** Judul "Gallery", deskripsi singkat.
- **Filter:** Tombol "Semua" + satu tombol per kategori (dari `$categories`).
- **Grid:** Card per item:
  - Gambar (aspect ratio 4/3), hover zoom.
  - Gradient overlay hover dengan nama item.
  - Caption: nama + kategori.
  - `data-category="{{ category_slug }}"` untuk filter.
- **Lightbox:** Modal fullscreen; klik card → tampil gambar besar + caption; tutup dengan tombol, klik backdrop, atau Escape.

**JavaScript (inline di view, stack scripts):**
- Filter: klik tombol kategori → sembunyikan/tampilkan card sesuai `data-category`.
- Lightbox: buka/tutup, set `src` dan caption dari card yang diklik.

---

### Struktur folder terkait

```
app/
├── Http/Controllers/
│   ├── ContactController.php   # GET/POST contact, kirim $settings ke view
│   └── GalleryController.php   # GET gallery, kirim $items, $categories
├── Models/
│   └── Setting.php             # + map_lat, map_lng, map_place_query, map_embed_url, map_link_url

resources/views/
├── pages/
│   ├── contact.blade.php       # Form + info + peta (iframe dari $settings->map_embed_url)
│   └── gallery.blade.php       # Filter, grid, lightbox
└── admin/
    └── settings/
        └── edit.blade.php      # Form settings + section Peta (lat, lng, place query)

routes/
├── web.php                     # GET /contact, POST /contact, GET /gallery
└── admin.php                   # GET/PUT /admin/settings

database/migrations/
└── 2025_01_28_000012_add_map_to_settings_table.php

public/images/logos/
└── menu-*.jpeg                 # Dipakai gallery saat tidak ada menu dengan image
```

---

### Ringkasan alur gallery

1. User buka `/gallery` → `GalleryController@index`.
2. Controller ambil menu dengan gambar (atau fallback file di `public/images/logos`).
3. View tampilkan filter kategori + grid card; klik card → lightbox.
4. Gambar selalu dari data nyata (menu atau fallback), layout lebih hidup dengan filter dan lightbox.

---

## 3. Checklist singkat

**Peta**
- [ ] Jalankan migration `add_map_to_settings_table`.
- [ ] Di Admin → Settings isi **Latitude** & **Longitude** tepat lokasi coffeeshop (atau **Nama tempat**).
- [ ] Cek halaman Contact: iframe dan link "Buka di Google Maps" menunjuk lokasi yang benar.

**Gallery**
- [ ] Menu yang ingin tampil di gallery harus punya **gambar** dan status **tersedia**.
- [ ] Jika belum ada menu dengan gambar, gallery akan pakai fallback dari `public/images/logos` (menu-*.jpeg).
- [ ] Filter kategori dan lightbox berfungsi di halaman Gallery.
