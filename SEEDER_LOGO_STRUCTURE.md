# Seeder dan Logo Structure

## 📁 Struktur Folder Logo

```
public/
└── images/
    └── logos/
        ├── category-coffee.svg
        ├── category-tea.svg
        ├── category-pastry.svg
        ├── category-dessert.svg
        ├── menu-espresso.svg
        ├── menu-americano.svg
        ├── menu-cappuccino.svg
        ├── menu-latte.svg
        ├── menu-mocha.svg
        ├── menu-macchiato.svg
        ├── menu-flat-white.svg
        ├── menu-cold-brew.svg
        ├── menu-green-tea.svg
        ├── menu-black-tea.svg
        ├── menu-chai-latte.svg
        ├── menu-earl-grey.svg
        ├── menu-herbal-tea.svg
        ├── menu-croissant.svg
        ├── menu-cookie.svg
        ├── menu-muffin.svg
        ├── menu-cinnamon-roll.svg
        ├── menu-almond-croissant.svg
        ├── menu-tiramisu.svg
        ├── menu-cheesecake.svg
        ├── menu-chocolate-cake.svg
        └── menu-apple-pie.svg
```

**Total: 4 category logos + 22 menu item logos = 26 logo vektor SVG**

---

## 🎨 Logo Specifications

### Category Logos (100x100 viewBox)
- **Coffee**: Coffee bean + cup dengan steam
- **Tea**: Tea cup dengan handle dan tea leaf
- **Pastry**: Croissant shape dengan texture
- **Dessert**: Layered cake dengan frosting dan cherry

### Menu Item Logos (100x100 viewBox)
Semua logo menggunakan:
- **Color Palette**: Sage Green (#A3B18A), Light Brown (#B08968), Terracotta (#D4A373), Dark Gray (#3A3A3A), Off White (#F7F7F2)
- **Style**: Modern, minimalist, earthy theme
- **Format**: SVG vector (scalable, tidak pixelated)

---

## 🌱 Seeder Structure

### 1. CategorySeeder
**File**: `database/seeders/CategorySeeder.php`

**Data yang di-seed:**
- Coffee (aktif)
- Tea (aktif)
- Pastry (aktif)
- Dessert (aktif)

**Fields:**
- `name`: Nama kategori
- `description`: Deskripsi kategori
- `status`: 'aktif' atau 'nonaktif'

---

### 2. MenuSeeder
**File**: `database/seeders/MenuSeeder.php`

**Data yang di-seed:**

#### Coffee Items (8 items)
1. Espresso - $3.50
2. Americano - $4.00
3. Cappuccino - $4.50
4. Latte - $4.75
5. Mocha - $5.00
6. Macchiato - $4.25
7. Flat White - $4.50
8. Cold Brew - $4.75

#### Tea Items (5 items)
1. Green Tea - $3.50
2. Black Tea - $3.50
3. Chai Latte - $4.50
4. Earl Grey - $3.75
5. Herbal Tea - $3.50

#### Pastry Items (5 items)
1. Croissant - $3.00
2. Chocolate Chip Cookie - $2.50
3. Blueberry Muffin - $3.25
4. Cinnamon Roll - $3.50
5. Almond Croissant - $3.75

#### Dessert Items (4 items)
1. Tiramisu - $5.50
2. Cheesecake - $5.00
3. Chocolate Cake - $4.75
4. Apple Pie - $4.50

**Total: 22 menu items**

**Fields:**
- `category_id`: Foreign key ke categories
- `name`: Nama menu item
- `description`: Deskripsi menu
- `price`: Harga (decimal 10,2)
- `stock`: Stok tersedia (integer)
- `image`: Path ke logo SVG (contoh: 'images/logos/menu-espresso.svg')
- `status`: 'tersedia' atau 'habis'

---

## 🚀 Cara Menjalankan Seeder

### 1. Reset dan Seed Database
```bash
php artisan migrate:fresh --seed
```

### 2. Seed Hanya Categories dan Menus
```bash
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=MenuSeeder
```

### 3. Seed Semua (dari DatabaseSeeder)
```bash
php artisan db:seed
```

---

## 📊 Database Schema

### Categories Table
```sql
- id (bigint, primary key)
- name (varchar 100)
- description (text, nullable)
- status (enum: 'aktif', 'nonaktif')
- created_at (timestamp)
- updated_at (timestamp)
```

### Menus Table
```sql
- id (bigint, primary key)
- category_id (foreign key → categories.id)
- name (varchar 150)
- description (text, nullable)
- price (decimal 10,2)
- stock (integer, default 0)
- image (varchar 255, nullable) → Path ke logo SVG
- status (enum: 'tersedia', 'habis')
- created_at (timestamp)
- updated_at (timestamp)
- deleted_at (timestamp, nullable) → Soft deletes
```

---

## 🎯 Logo Usage di Views

### Di Product Card Component
```blade
@include('components.product-card', [
    'id' => $menu->id,
    'name' => $menu->name,
    'price' => $menu->price,
    'description' => $menu->description,
    'category' => $menu->category->name,
    'image' => $menu->image ? asset($menu->image) : null,
])
```

### Di Menu Page
Logo akan otomatis ditampilkan dari field `image` di database:
- Jika `image` ada → tampilkan logo dari `public/images/logos/`
- Jika `image` null → tampilkan placeholder

---

## 🔧 Customization

### Menambah Category Baru
1. Buat logo SVG di `public/images/logos/category-[name].svg`
2. Tambahkan data di `CategorySeeder.php`
3. Run seeder: `php artisan db:seed --class=CategorySeeder`

### Menambah Menu Item Baru
1. Buat logo SVG di `public/images/logos/menu-[name].svg`
2. Tambahkan data di `MenuSeeder.php` dengan category_id yang sesuai
3. Run seeder: `php artisan db:seed --class=MenuSeeder`

### Mengubah Logo
1. Edit file SVG di `public/images/logos/`
2. Pastikan nama file sesuai dengan path di database
3. Clear cache jika perlu: `php artisan cache:clear`

---

## ✅ Checklist Logo

- [x] 4 Category logos (Coffee, Tea, Pastry, Dessert)
- [x] 8 Coffee menu logos
- [x] 5 Tea menu logos
- [x] 5 Pastry menu logos
- [x] 4 Dessert menu logos
- [x] Semua logo menggunakan color palette yang konsisten
- [x] Semua logo dalam format SVG (vector)
- [x] Semua logo memiliki viewBox 100x100
- [x] Semua logo mengikuti tema modern earthy

---

## 📝 Notes

1. **Logo bukan AI-generated**: Semua logo dibuat manual dengan SVG code
2. **Scalable**: SVG format memastikan logo tidak pixelated di berbagai ukuran
3. **Consistent**: Semua logo menggunakan color palette yang sama
4. **Optimized**: SVG files kecil dan load cepat
5. **Maintainable**: Mudah di-edit dan di-customize

---

**Semua logo siap digunakan dan terintegrasi dengan seeder!**