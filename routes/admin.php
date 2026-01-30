<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Routes untuk admin panel dengan prefix /admin
|
*/

// Public admin routes (no auth required)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Protected admin routes (require admin auth)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Categories CRUD
    Route::resource('categories', CategoryController::class)->except(['show']);
    
    // Menus CRUD
    Route::resource('menus', MenuController::class)->except(['show']);

    // Users CRUD
    Route::resource('users', UserController::class)->except(['show']);

    // Customers CRUD
    Route::resource('customers', CustomerController::class)->except(['show']);

    // Orders management
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status.update');

    // Profile & settings
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [SettingsController::class, 'update'])->name('settings.update');

    // Contact messages (pesan dari halaman Hubungi Kami)
    Route::get('contact-messages', [ContactMessageController::class, 'index'])->name('contact-messages.index');
    Route::get('contact-messages/{message}', [ContactMessageController::class, 'show'])->name('contact-messages.show');
    Route::post('contact-messages/{message}/reply', [ContactMessageController::class, 'reply'])->name('contact-messages.reply');

    // Exports
    Route::get('exports/orders.xlsx', [ExportController::class, 'ordersExcel'])->name('exports.orders.excel');
    Route::get('exports/orders.pdf', [ExportController::class, 'ordersPdf'])->name('exports.orders.pdf');
    
    // Redirect /admin to dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
});