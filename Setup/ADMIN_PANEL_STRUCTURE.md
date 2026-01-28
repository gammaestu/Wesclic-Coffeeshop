# Admin Panel Structure

## 📁 Struktur Folder Admin

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   │       ├── AdminController.php (Dashboard)
│   │       ├── AuthController.php (Login/Logout)
│   │       ├── CategoryController.php (CRUD Categories)
│   │       ├── MenuController.php (CRUD Menus)
│   │       ├── UserController.php (CRUD Users)
│   │       ├── CustomerController.php (CRUD Customers)
│   │       ├── OrderController.php (Order Management)
│   │       ├── ProfileController.php (Profile + change password)
│   │       ├── SettingsController.php (Shop settings)
│   │       └── ExportController.php (PDF/Excel export)
│   └── Middleware/
│       └── AdminMiddleware.php (Protect admin routes)

resources/
└── views/
    └── admin/
        ├── layouts/
        │   └── app.blade.php (Admin layout)
        ├── components/
        │   ├── sidebar.blade.php (Sidebar navigation)
        │   └── navbar.blade.php (Top navigation)
        ├── auth/
        │   └── login.blade.php (Login page)
        ├── dashboard.blade.php (Dashboard)
        ├── categories/
        │   ├── index.blade.php (List categories)
        │   ├── create.blade.php (Create category)
        │   └── edit.blade.php (Edit category)
        ├── menus/
        │   ├── index.blade.php (List menus)
        │   ├── create.blade.php (Create menu)
        │   └── edit.blade.php (Edit menu)
        ├── users/
        │   ├── index.blade.php
        │   ├── create.blade.php
        │   └── edit.blade.php
        ├── customers/
        │   ├── index.blade.php
        │   ├── create.blade.php
        │   └── edit.blade.php
        ├── orders/
        │   ├── index.blade.php
        │   └── show.blade.php
        ├── profile/
        │   └── edit.blade.php
        ├── settings/
        │   └── edit.blade.php
        └── exports/
            └── orders-pdf.blade.php

routes/
└── admin.php (Admin routes)
```

---

## 🔐 Authentication Flow

### Login
```
GET /admin/login
    ↓
AuthController@showLoginForm
    ↓
View: admin.auth.login
    ↓
POST /admin/login
    ↓
AuthController@login
    ↓
Validate credentials
    ↓
Check role (admin/owner)
    ↓
Redirect to dashboard
```

### Protected Routes
```
Request to /admin/*
    ↓
AdminMiddleware
    ↓
Check authentication
    ↓
Check user role
    ↓
Check user status
    ↓
Allow/Deny access
```

---

## 📋 Routes Structure

### Public Admin Routes
```php
GET  /admin/login      → AuthController@showLoginForm
POST /admin/login      → AuthController@login
```

### Protected Admin Routes (require auth + admin role)
```php
GET  /admin                    → Redirect to dashboard
GET  /admin/dashboard          → AdminController@dashboard
POST /admin/logout             → AuthController@logout

GET    /admin/categories           → CategoryController@index
GET    /admin/categories/create    → CategoryController@create
POST   /admin/categories           → CategoryController@store
GET    /admin/categories/{id}/edit → CategoryController@edit
PUT    /admin/categories/{id}     → CategoryController@update
DELETE /admin/categories/{id}     → CategoryController@destroy

GET    /admin/menus               → MenuController@index
GET    /admin/menus/create        → MenuController@create
POST   /admin/menus               → MenuController@store
GET    /admin/menus/{id}/edit     → MenuController@edit
PUT    /admin/menus/{id}          → MenuController@update
DELETE /admin/menus/{id}          → MenuController@destroy

GET    /admin/users               → UserController@index
GET    /admin/users/create        → UserController@create
POST   /admin/users               → UserController@store
GET    /admin/users/{id}/edit     → UserController@edit
PUT    /admin/users/{id}          → UserController@update
DELETE /admin/users/{id}          → UserController@destroy

GET    /admin/customers               → CustomerController@index
GET    /admin/customers/create        → CustomerController@create
POST   /admin/customers               → CustomerController@store
GET    /admin/customers/{id}/edit     → CustomerController@edit
PUT    /admin/customers/{id}          → CustomerController@update
DELETE /admin/customers/{id}          → CustomerController@destroy

GET    /admin/orders                  → OrderController@index
GET    /admin/orders/{id}             → OrderController@show
PATCH  /admin/orders/{id}/status      → OrderController@updateStatus

GET    /admin/profile                 → ProfileController@edit
PUT    /admin/profile                 → ProfileController@update

GET    /admin/settings                → SettingsController@edit
PUT    /admin/settings                → SettingsController@update

GET    /admin/exports/orders.xlsx     → ExportController@ordersExcel
GET    /admin/exports/orders.pdf      → ExportController@ordersPdf
```

---

## 🎨 Design Features

### Minimalis & Simple
- ✅ Clean white background
- ✅ Simple sidebar navigation
- ✅ Clear typography
- ✅ Consistent spacing
- ✅ Subtle shadows
- ✅ Earthy color palette

### Responsive
- ✅ Mobile-friendly sidebar (toggle)
- ✅ Responsive tables
- ✅ Flexible forms
- ✅ Mobile navigation

### User Experience
- ✅ Flash messages (success/error)
- ✅ Form validation
- ✅ Confirmation dialogs
- ✅ Loading states
- ✅ Clear CTAs

---

## 🔧 Features

### Dashboard
- Statistics cards (categories, menus, orders)
- Recent menus table
- Quick navigation

### Categories CRUD
- List all categories
- Create new category
- Edit category
- Delete category (with validation)
- Status management

### Menus CRUD
- List all menus with pagination
- Filter by category
- Filter by status
- Search functionality
- Create new menu
- Edit menu
- Delete menu (with validation)
- Stock management

---

## 🛡️ Security

### Middleware Protection
- `auth` - User must be authenticated
- `admin` - User must be admin or owner

### Validation
- Form validation on all inputs
- Unique constraints
- Foreign key constraints
- Soft delete protection

### Authorization
- Role-based access (admin/owner only)
- Status check (active users only)
- Last login tracking

---

## 📊 Database Operations

### Categories
- Create: `Category::create()`
- Update: `$category->update()`
- Delete: `$category->delete()` (soft delete)
- Cache: Clear cache on changes

### Menus
- Create: `Menu::create()`
- Update: `$menu->update()`
- Delete: `$menu->delete()` (soft delete)
- Cache: Clear cache on changes
- Relationships: Eager load category

---

## 🎯 Best Practices Applied

1. ✅ **Separation of Concerns**: Controllers → Services → Repositories
2. ✅ **Middleware Protection**: Admin routes protected
3. ✅ **Form Validation**: Request validation
4. ✅ **Error Handling**: Try-catch and user-friendly errors
5. ✅ **Cache Management**: Clear cache on updates
6. ✅ **Soft Deletes**: Prevent data loss
7. ✅ **Eager Loading**: Optimize queries
8. ✅ **Pagination**: Handle large datasets

---

## 🚀 Usage

### Access Admin Panel
1. Navigate to `/admin/login`
2. Login with admin credentials
3. Access dashboard at `/admin/dashboard`

### Create Admin User
```php
User::create([
    'name' => 'Admin',
    'email' => 'admin@example.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
    'status' => 'aktif',
]);
```

### Or via Seeder
```bash
php artisan db:seed --class=AdminSeeder
```

---

**Admin panel siap digunakan dengan struktur yang rapi dan design minimalis!**