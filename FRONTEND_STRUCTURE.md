# Frontend Structure - Wesclic Coffee Shop

## 📁 Struktur Folder

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php          # Layout utama dengan navbar & footer
│   ├── components/
│   │   ├── navbar.blade.php        # Navbar component (reusable)
│   │   ├── footer.blade.php        # Footer component (reusable)
│   │   ├── logo.blade.php          # Logo SVG component
│   │   └── product-card.blade.php  # Product card component
│   └── pages/
│       ├── home.blade.php          # Home/Landing page
│       ├── menu.blade.php           # Menu page dengan filter
│       ├── about.blade.php          # About page
│       ├── contact.blade.php        # Contact page
│       └── cart.blade.php           # Shopping cart page
├── css/
│   ├── app.css                     # Main CSS dengan Tailwind & custom colors
│   └── custom.css                  # Custom animations & utilities
└── js/
    ├── app.js                      # Main JS dengan cart manager
    └── bootstrap.js                # Axios setup
```

## 🎨 Color Palette

- **Sage Green**: `#A3B18A` - Primary color untuk buttons & accents
- **Off White**: `#F7F7F2` - Background color
- **Light Brown**: `#B08968` - Secondary color untuk highlights
- **Dark Gray**: `#3A3A3A` - Text color utama
- **Terracotta**: `#D4A373` - Accent color untuk badges & special elements

## 🧩 Components

### 1. Layout (`layouts/app.blade.php`)
- Main layout yang digunakan semua halaman
- Include navbar dan footer
- Support untuk `@yield`, `@stack`, dan `@push`

### 2. Navbar (`components/navbar.blade.php`)
- Sticky navigation dengan backdrop blur
- Responsive mobile menu
- Active state untuk current page
- Cart counter yang update otomatis

### 3. Footer (`components/footer.blade.php`)
- 4-column layout (desktop)
- Social media links
- Quick links & contact info
- Responsive design

### 4. Logo (`components/logo.blade.php`)
- SVG vector logo dengan tema earthy modern
- Coffee bean + cup design
- Customizable size via `$class` parameter

### 5. Product Card (`components/product-card.blade.php`)
- Reusable component untuk menu items
- Support untuk image, badge, category
- Add to cart functionality
- Hover effects & transitions

## 📄 Pages

### 1. Home Page (`pages/home.blade.php`)
- Hero section dengan gradient background
- Features section (3 columns)
- Popular items preview
- CTA section

### 2. Menu Page (`pages/menu.blade.php`)
- Filter buttons (All, Coffee, Tea, Pastry, Dessert)
- Grid layout dengan product cards
- Dynamic filtering dengan JavaScript
- 20+ menu items

### 3. About Page (`pages/about.blade.php`)
- Story section
- Values section (3 columns)
- Team section
- CTA section

### 4. Contact Page (`pages/contact.blade.php`)
- Contact form
- Contact information
- Opening hours
- Map placeholder

### 5. Cart Page (`pages/cart.blade.php`)
- Cart items list
- Quantity controls
- Order summary dengan tax calculation
- Checkout button

## 🚀 Design Patterns & Performance

### 1. Component-Based Architecture
- Reusable Blade components
- DRY (Don't Repeat Yourself) principle
- Easy maintenance & updates

### 2. Lazy Loading
- Images dengan `loading="lazy"` attribute
- Intersection Observer untuk dynamic loading
- Reduced initial page load time

### 3. LocalStorage Cart Management
- Client-side cart storage
- Persistent across page reloads
- Global cart manager (`window.cartManager`)

### 4. Optimized CSS
- Tailwind CSS untuk utility classes
- Custom CSS untuk animations
- Minimal custom CSS (mostly Tailwind)

### 5. JavaScript Performance
- Event delegation where possible
- Debounced functions untuk filters
- Efficient DOM manipulation

### 6. Responsive Design
- Mobile-first approach
- Breakpoints: sm, md, lg
- Flexible grid layouts

## 🔧 Routes

```php
Route::get('/', 'pages.home')->name('home');
Route::get('/menu', 'pages.menu')->name('menu');
Route::get('/about', 'pages.about')->name('about');
Route::get('/contact', 'pages.contact')->name('contact');
Route::get('/cart', 'pages.cart')->name('cart');
```

## 📦 Dependencies

- **Laravel 12** - PHP Framework
- **Tailwind CSS 4** - Utility-first CSS framework
- **Vite** - Build tool
- **Axios** - HTTP client (for future API calls)

## 🎯 Features

✅ Responsive design (mobile, tablet, desktop)
✅ Shopping cart dengan localStorage
✅ Menu filtering
✅ Smooth animations & transitions
✅ Modern earthy theme
✅ SEO-friendly structure
✅ Accessible components
✅ Performance optimized

## 🔄 Future Enhancements

- [ ] Image optimization dengan WebP
- [ ] Service Worker untuk offline support
- [ ] API integration untuk real data
- [ ] Payment gateway integration
- [ ] User authentication
- [ ] Order tracking
- [ ] Reviews & ratings
- [ ] Newsletter subscription

## 📝 Usage

1. **Build assets**: `npm run build` atau `npm run dev`
2. **Access pages**: Navigate ke routes yang sudah didefinisikan
3. **Customize colors**: Edit `resources/css/app.css` theme variables
4. **Add components**: Create new files di `resources/views/components/`
5. **Add pages**: Create new files di `resources/views/pages/` dan tambahkan route

## 🎨 Customization

### Mengubah Colors
Edit `resources/css/app.css`:
```css
--color-sage-green: #A3B18A;
--color-off-white: #F7F7F2;
--color-light-brown: #B08968;
--color-dark-gray: #3A3A3A;
--color-terracotta: #D4A373;
```

### Menambah Menu Items
Edit `resources/views/pages/menu.blade.php`:
```php
$menuItems = [
    ['name' => 'Item Name', 'price' => 5.00, 'description' => '...', 'category' => 'coffee'],
    // ...
];
```

## 📱 Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

---

**Created with ❤️ for Wesclic Coffee Shop**