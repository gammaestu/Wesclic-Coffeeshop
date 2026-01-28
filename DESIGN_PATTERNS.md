# Design Patterns Implementation

## 🎯 Patterns yang Diterapkan

### 1. Repository Pattern

**Location**: `app/Repositories/`

**Purpose**: Abstract data access layer dari business logic

**Benefits**:
- Centralized query logic
- Easier testing dengan mock repositories
- Caching implementation
- Database abstraction

**Example**:
```php
// MenuRepository.php
public function getAvailable(): Collection
{
    return Cache::remember('menus.available', 60, function () {
        return Menu::where('status', 'tersedia')
            ->with('category:id,name')
            ->get();
    });
}
```

**Usage**:
```php
// Controller
$menus = $this->menuRepository->getAvailable();
```

---

### 2. Service Layer Pattern

**Location**: `app/Services/`

**Purpose**: Business logic separation dari controllers

**Benefits**:
- Reusable business logic
- Thin controllers
- Easier to test
- Single responsibility

**Example**:
```php
// MenuService.php
public function getPopularItems(int $limit = 3): Collection
{
    return $this->menuRepository->getAvailable()
        ->take($limit);
}
```

**Usage**:
```php
// Controller
$popularItems = $this->menuService->getPopularItems(3);
```

---

### 3. View Composer Pattern

**Location**: `app/Http/ViewComposers/`

**Purpose**: Share data across multiple views

**Benefits**:
- DRY principle
- Centralized data fetching
- Automatic data binding

**Example**:
```php
// CategoryComposer.php
public function compose(View $view): void
{
    $view->with('categories', $this->categoryRepository->getActive());
}
```

**Registration**:
```php
// AppServiceProvider.php
View::composer(['components.navbar', 'pages.menu'], CategoryComposer::class);
```

---

### 4. Dependency Injection Pattern

**Location**: Controllers, Services, Repositories

**Purpose**: Loose coupling dan testability

**Benefits**:
- Easier testing dengan mocks
- Loose coupling
- Single responsibility

**Example**:
```php
// Controller
public function __construct(
    protected MenuService $menuService,
    protected CategoryRepository $categoryRepository
) {}
```

---

### 5. Singleton Pattern

**Location**: `app/Providers/AppServiceProvider.php`

**Purpose**: Single instance untuk repositories dan services

**Benefits**:
- Memory efficient
- Consistent state
- Shared cache

**Example**:
```php
$this->app->singleton(MenuRepository::class);
$this->app->singleton(MenuService::class);
```

---

### 6. Factory Pattern (Laravel Eloquent)

**Location**: Models dengan factories

**Purpose**: Create test data

**Example**:
```php
Menu::factory()->create([
    'name' => 'Espresso',
    'price' => 3.50,
]);
```

---

### 7. Observer Pattern (Laravel Events)

**Purpose**: Decouple components

**Usage**: Cache invalidation on model updates

---

### 8. Strategy Pattern (JavaScript)

**Location**: `resources/js/utils/`

**Purpose**: Different strategies untuk cart, notifications, lazy loading

**Example**:
```javascript
// cart.js - Cart management strategy
export class CartManager {
    // Strategy implementation
}
```

---

## ⚡ Performance Patterns

### 1. Caching Pattern

**Implementation**: Repository-level caching

```php
return Cache::remember('menus.available', 60, function () {
    // Expensive query
});
```

**Benefits**:
- Reduced database queries
- Faster response times
- Lower server load

---

### 2. Lazy Loading Pattern

**Implementation**: JavaScript IntersectionObserver

```javascript
// lazy-loading.js
const observer = new IntersectionObserver((entries) => {
    // Load images when visible
});
```

**Benefits**:
- Faster initial page load
- Reduced bandwidth
- Better user experience

---

### 3. Code Splitting Pattern

**Implementation**: Vite manual chunks

```javascript
// vite.config.js
manualChunks: {
    'vendor': ['axios'],
    'utils': ['./resources/js/utils/...'],
}
```

**Benefits**:
- Smaller initial bundle
- Faster load times
- Better caching

---

### 4. Eager Loading Pattern

**Implementation**: Eloquent `with()`

```php
Menu::with('category')->get();
```

**Benefits**:
- Reduced N+1 queries
- Faster data retrieval
- Optimized database access

---

## 🎨 Frontend Patterns

### 1. Component Pattern

**Location**: `resources/views/components/`

**Purpose**: Reusable UI components

**Example**:
```blade
@include('components.product-card', [
    'name' => $menu->name,
    'price' => $menu->price,
])
```

---

### 2. Layout Pattern

**Location**: `resources/views/layouts/`

**Purpose**: Consistent page structure

**Example**:
```blade
@extends('layouts.app')
@section('content')
    <!-- Page content -->
@endsection
```

---

### 3. Utility-First CSS Pattern

**Implementation**: Tailwind CSS

**Benefits**:
- Rapid development
- Consistent design
- Small CSS bundle (purged)

---

## 🔄 Data Flow Patterns

### Request → Response Flow

```
HTTP Request
    ↓
Route
    ↓
Middleware (if any)
    ↓
Controller
    ↓
Service (business logic)
    ↓
Repository (data access)
    ↓
Model (database)
    ↓
View (presentation)
    ↓
HTTP Response
```

---

## 📊 Cache Strategy

### Cache Layers

1. **Repository Cache** (60-120 min)
   - Menu queries
   - Category queries

2. **View Cache** (Laravel)
   - Compiled Blade templates

3. **Config Cache** (Production)
   - Configuration files

4. **Route Cache** (Production)
   - Route definitions

---

## 🧪 Testing Patterns

### Unit Testing
- Test individual classes
- Mock dependencies
- Test business logic

### Integration Testing
- Test service + repository
- Test controller + service
- Test with database

### Feature Testing
- Test HTTP endpoints
- Test user flows
- Test API responses

---

## 🔐 Security Patterns

### 1. CSRF Protection
- Laravel CSRF tokens
- Form validation

### 2. Input Validation
- Request validation
- Sanitization

### 3. SQL Injection Prevention
- Eloquent ORM
- Parameterized queries

---

**Semua patterns ini diterapkan untuk memastikan code yang maintainable, testable, dan performant!**