# Project Structure - Wesclic Coffee Shop

## 📁 Struktur Folder Lengkap

```
wesclic_coffeshop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Controller.php (base)
│   │   │   ├── HomeController.php
│   │   │   ├── MenuController.php
│   │   │   ├── AboutController.php
│   │   │   ├── ContactController.php
│   │   │   ├── CartController.php
│   │   │   ├── PaymentController.php
│   │   │   └── Admin/
│   │   │       ├── AdminController.php
│   │   │       ├── AuthController.php
│   │   │       ├── CategoryController.php
│   │   │       ├── MenuController.php
│   │   │       ├── UserController.php
│   │   │       └── CustomerController.php
│   │   └── ViewComposers/
│   │       └── CategoryComposer.php
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Menu.php
│   │   └── ... (other models)
│   ├── Repositories/
│   │   ├── CategoryRepository.php
│   │   └── MenuRepository.php
│   ├── Services/
│   │   └── MenuService.php
│   ├── Helpers/
│   │   └── ImageHelper.php
│   └── Providers/
│       └── AppServiceProvider.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── components/
│   │   │   ├── navbar.blade.php
│   │   │   ├── footer.blade.php
│   │   │   ├── logo.blade.php
│   │   │   └── product-card.blade.php
│   │   └── pages/
│   │       ├── home.blade.php
│   │       ├── menu.blade.php
│   │       ├── about.blade.php
│   │       ├── contact.blade.php
│   │       ├── cart.blade.php
│   │       └── payment.blade.php
│   │   └── admin/
│   │       ├── layouts/
│   │       │   └── app.blade.php
│   │       ├── auth/
│   │       │   └── login.blade.php
│   │       ├── components/
│   │       │   ├── navbar.blade.php
│   │       │   └── sidebar.blade.php
│   │       ├── dashboard.blade.php
│   │       ├── categories/
│   │       │   ├── index.blade.php
│   │       │   ├── create.blade.php
│   │       │   └── edit.blade.php
│   │       ├── menus/
│   │       │   ├── index.blade.php
│   │       │   ├── create.blade.php
│   │       │   └── edit.blade.php
│   │       ├── users/
│   │       │   ├── index.blade.php
│   │       │   ├── create.blade.php
│   │       │   └── edit.blade.php
│   │       └── customers/
│   │           ├── index.blade.php
│   │           ├── create.blade.php
│   │           └── edit.blade.php
│   ├── css/
│   │   ├── app.css (Tailwind + custom)
│   │   └── custom.css (animations & utilities)
│   └── js/
│       ├── app.js (main entry)
│       ├── bootstrap.js (axios setup)
│       └── utils/
│           ├── cart.js
│           ├── notifications.js
│           └── lazy-loading.js
├── routes/
│   ├── web.php
│   └── admin.php
├── public/
│   └── images/
│       └── logos/ (26 SVG files)
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── CategorySeeder.php
│       └── MenuSeeder.php
└── config/
    └── ... (Laravel config files)
```

---

## 🏗️ Architecture Pattern

### 1. **MVC Pattern** (Model-View-Controller)
- **Models**: `app/Models/` - Database entities
- **Views**: `resources/views/` - Blade templates
- **Controllers**: `app/Http/Controllers/` - Request handling

### 2. **Repository Pattern**
- **Location**: `app/Repositories/`
- **Purpose**: Abstract data access layer
- **Benefits**: 
  - Easier testing
  - Centralized query logic
  - Caching implementation
  - Database abstraction

### 3. **Service Layer Pattern**
- **Location**: `app/Services/`
- **Purpose**: Business logic separation
- **Benefits**:
  - Reusable business logic
  - Controller stays thin
  - Easier to test

### 4. **View Composer Pattern**
- **Location**: `app/Http/ViewComposers/`
- **Purpose**: Share data across views
- **Usage**: Categories available in navbar and menu page

---

## 🎨 Tailwind CSS Configuration

### Setup
- **Version**: Tailwind CSS 4.0
- **Build Tool**: Vite with `@tailwindcss/vite` plugin
- **Configuration**: `resources/css/app.css`

### Custom Colors
```css
--color-sage-green: #A3B18A
--color-off-white: #F7F7F2
--color-light-brown: #B08968
--color-dark-gray: #3A3A3A
--color-terracotta: #D4A373
```

### Usage in Views
```blade
<div class="bg-[#A3B18A] text-[#F7F7F2]">
    <!-- Content -->
</div>
```

---

## ⚡ Performance Optimizations

### 1. **Database Query Optimization**
- ✅ Eager loading dengan `with()`
- ✅ Query caching dengan Laravel Cache
- ✅ Select specific columns (`select()`)
- ✅ Indexed queries

### 2. **View Caching**
- ✅ Repository-level caching
- ✅ Cache duration: 60-120 minutes
- ✅ Cache invalidation on updates

### 3. **Image Optimization**
- ✅ Lazy loading dengan IntersectionObserver
- ✅ SVG format (scalable, small file size)
- ✅ `loading="lazy"` attribute
- ✅ `decoding="async"` attribute

### 4. **JavaScript Optimization**
- ✅ Code splitting dengan Vite
- ✅ Modular utilities (cart, notifications, lazy-loading)
- ✅ Event delegation
- ✅ Debounced functions

### 5. **CSS Optimization**
- ✅ Tailwind CSS (utility-first, purged unused)
- ✅ Custom CSS minimal
- ✅ CSS variables for theming

### 6. **Asset Optimization**
- ✅ Vite build optimization
- ✅ Manual chunks for vendor code
- ✅ Tree shaking

---

## 🔄 Data Flow

### Home Page Flow
```
Route (/) 
    → HomeController@index
    → MenuService::getPopularItems()
    → MenuRepository::getAvailable() [Cached]
    → View: pages.home
    → Component: product-card
```

### Menu Page Flow
```
Route (/menu)
    → MenuController@index
    → CategoryRepository::getActiveWithMenus() [Cached]
    → MenuService::getMenusByCategory()
    → MenuRepository::getAvailable() [Cached]
    → View: pages.menu
    → ViewComposer: CategoryComposer (shared data)
```

---

## 📦 Dependency Injection

### Service Container Bindings
```php
// AppServiceProvider.php
$this->app->singleton(CategoryRepository::class);
$this->app->singleton(MenuRepository::class);
$this->app->singleton(MenuService::class);
```

### Controller Injection
```php
public function __construct(
    protected MenuService $menuService,
    protected CategoryRepository $categoryRepository
) {}
```

---

## 🧪 Testing Structure

### Unit Tests
- `tests/Unit/` - Test individual classes
- Test repositories, services, helpers

### Feature Tests
- `tests/Feature/` - Test HTTP endpoints
- Test controllers and routes

---

## 🚀 Build & Deployment

### Development
```bash
npm run dev        # Start Vite dev server
php artisan serve  # Start Laravel server
```

### Production
```bash
npm run build      # Build assets for production
php artisan optimize  # Optimize Laravel
```

### Cache Management
```bash
php artisan cache:clear     # Clear application cache
php artisan view:clear      # Clear view cache
php artisan config:cache    # Cache config
php artisan route:cache    # Cache routes
```

---

## 📝 Best Practices Applied

1. ✅ **Separation of Concerns**: Controller → Service → Repository → Model
2. ✅ **DRY Principle**: Reusable components and services
3. ✅ **SOLID Principles**: Single responsibility, dependency injection
4. ✅ **Caching Strategy**: Repository-level caching
5. ✅ **Error Handling**: Try-catch in repositories
6. ✅ **Code Organization**: Clear folder structure
7. ✅ **Performance**: Lazy loading, code splitting, caching
8. ✅ **Maintainability**: Clear naming, documentation

---

## 🔧 Configuration Files

- `vite.config.js` - Vite & build configuration
- `package.json` - NPM dependencies
- `composer.json` - PHP dependencies
- `config/app.php` - Laravel app configuration
- `config/cache.php` - Cache configuration

---

**Struktur ini mengikuti Laravel best practices dan modern web development patterns untuk performa optimal!**