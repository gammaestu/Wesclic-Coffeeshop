# Routes, Controller, dan View Structure

## 📋 Alur Route → Controller → View

### 1. Home Page
```
Route: GET /
Controller: HomeController@index
View: pages.home
Data: Popular items (3 items dari database)
```

**Flow:**
1. User mengakses `/`
2. Route memanggil `HomeController::index()`
3. Controller mengambil 3 menu items teratas dari database
4. Controller mengirim data ke view `pages.home`
5. View menampilkan hero section, features, dan popular items

---

### 2. Menu Page
```
Route: GET /menu
Controller: MenuController@index
View: pages.menu
Data: Categories dan Menus dari database
Query Parameter: ?category=coffee (optional)
```

### 2b. Menu Detail Page
```
Route: GET /menu/{menu}
Controller: MenuController@show
View: pages.menu-detail
Data: Menu + Category
```

**Flow:**
1. User mengakses `/menu` atau `/menu?category=coffee`
2. Route memanggil `MenuController::index()`
3. Controller mengambil semua categories aktif
4. Controller mengambil semua menus (filtered by category jika ada)
5. Controller mengirim data ke view `pages.menu`
6. View menampilkan filter buttons dan grid menu items

---

### 3. About Page
```
Route: GET /about
Controller: AboutController@index
View: pages.about
Data: Static content (tidak perlu database)
```

**Flow:**
1. User mengakses `/about`
2. Route memanggil `AboutController::index()`
3. Controller langsung return view `pages.about`
4. View menampilkan story, values, dan team section

---

### 4. Contact Page
```
Route: GET /contact
Controller: ContactController@index
View: pages.contact
Data: $settings (Setting::getShopSettings()) — untuk alamat, telepon, peta (map_embed_url, map_link_url)

Route: POST /contact
Controller: ContactController@store
Action: Validasi dan proses form submission
```

**Flow GET:**
1. User mengakses `/contact`
2. Route memanggil `ContactController::index()`
3. Controller mengambil Setting (getShopSettings) dan kirim ke view
4. View menampilkan contact form, info (alamat/phone dari settings), dan peta Google Maps dari $settings->map_embed_url (koordinat/place dari Admin Settings)

**Flow POST:**
1. User submit contact form
2. Route memanggil `ContactController::store()`
3. Controller validasi input
4. Controller process data (bisa kirim email atau save ke database)
5. Controller redirect back dengan success message

---

### 5. Cart Page
```
Route: GET /cart
Controller: CartController@index
View: pages.cart
Data: Cart dari localStorage (client-side)
```

---

### 6. Checkout / Pesan
```
Route: GET /payment
Controller: PaymentController@index
View: pages.payment

Route: POST /checkout
Controller: OrderController@store
Action: Create orders + order_items + order_status_logs, deduct stock
```

---

### 7. Status Pesanan
```
Route: GET /orders/{order_code}
Controller: OrderController@show
View: pages.order-status

Route: GET /status?order_code=...
Controller: OrderController@statusLookup
View: pages.status
```

---

### 8. Gallery
```
Route: GET /gallery
Controller: GalleryController@index
View: pages.gallery
Data: $items (gambar dari Menu), $categories. Fallback: public/images/logos (menu-*.jpeg)
```

**Flow:**
1. User mengakses `/gallery`
2. Route memanggil `GalleryController@index()`
3. Controller mengambil Menu (tersedia, punya image) + category; fallback ke images/logos jika kosong
4. View menampilkan filter kategori, grid card, lightbox

---

## 📁 Struktur Folder

```
app/
└── Http/
    └── Controllers/
        ├── Controller.php (base controller)
        ├── HomeController.php
        ├── MenuController.php
        ├── AboutController.php
        ├── ContactController.php
        └── CartController.php
        ├── PaymentController.php
        ├── OrderController.php
        └── GalleryController.php

routes/
└── web.php (semua web routes)

resources/
└── views/
    ├── layouts/
    │   └── app.blade.php
    ├── components/
    │   ├── navbar.blade.php
    │   ├── footer.blade.php
    │   ├── logo.blade.php
    │   └── product-card.blade.php
    └── pages/
        ├── home.blade.php
        ├── menu.blade.php
        ├── menu-detail.blade.php
        ├── about.blade.php
        ├── contact.blade.php
        ├── cart.blade.php
        ├── payment.blade.php
        ├── order-status.blade.php
        ├── status.blade.php
        └── gallery.blade.php

public/
└── images/
    └── logos/
        ├── category-*.svg (4 files)
        └── menu-*.svg (22 files)

database/
└── seeders/
    ├── DatabaseSeeder.php
    ├── CategorySeeder.php
    └── MenuSeeder.php
```

---

## 🔄 Data Flow

### Home Page
```
Database (Menu) 
    ↓
HomeController::index()
    ↓
View: pages.home
    ↓
Component: product-card
```

### Menu Page
```
Database (Category, Menu)
    ↓
MenuController::index()
    ↓
View: pages.menu
    ↓
Component: product-card (loop)
```

### Cart
```
LocalStorage (Browser)
    ↓
JavaScript (cartManager)
    ↓
View: pages.cart
    ↓
Dynamic rendering
```

---

## 🎯 Best Practices

1. **Controller hanya handle logic**, tidak ada HTML
2. **View hanya handle presentation**, tidak ada business logic
3. **Component reusable** untuk mengurangi duplikasi
4. **Route naming** konsisten dengan controller method
5. **Data validation** di controller untuk POST requests
6. **Error handling** dengan try-catch di controller
7. **Flash messages** untuk user feedback

---

## 📝 Route Naming Convention

- `home` → Home page
- `menu` → Menu listing
- `menu.show` → Menu detail
- `about` → About page
- `contact` → Contact page (GET)
- `contact.store` → Contact form submission (POST)
- `cart` → Shopping cart
- `payment` → Checkout page
- `checkout.store` → Create order
- `orders.show` → Order status/detail page
- `orders.status` → Order lookup page
- `gallery` → Gallery page

Semua routes menggunakan named routes untuk kemudahan maintenance.

---

## 🚀 Cara Menjalankan

1. **Seed database:**
   ```bash
   php artisan db:seed
   ```

2. **Jalankan server:**
   ```bash
   php artisan serve
   ```

3. **Akses routes:**
   - Home: `http://localhost:8000/`
   - Menu: `http://localhost:8000/menu`
   - About: `http://localhost:8000/about`
   - Contact: `http://localhost:8000/contact`
   - Cart: `http://localhost:8000/cart`

---

**Struktur ini mengikuti Laravel best practices dan MVC pattern.**