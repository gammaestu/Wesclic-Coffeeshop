<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderPaymentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentNotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
Route::get('/orders/{order_code}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/orders/{order_code}/pay', [OrderPaymentController::class, 'show'])->name('orders.pay');
Route::get('/status', [OrderController::class, 'statusLookup'])->name('orders.status');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

Route::get('/payment/finish', [PaymentController::class, 'finish'])->name('payment.finish');
Route::get('/payment/error', [PaymentController::class, 'error'])->name('payment.error');
Route::post('/payment/notification', PaymentNotificationController::class)->name('payment.notification')->withoutMiddleware([\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class]);

// Admin Routes
require __DIR__.'/admin.php';
