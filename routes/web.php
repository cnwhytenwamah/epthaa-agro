<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPages\RvsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FrontPages\CartController;
use App\Http\Controllers\FrontPages\HomeController;
use App\Http\Controllers\FrontPages\ShopController;
use App\Http\Controllers\FrontPages\BookingController;
use App\Http\Controllers\FrontPages\CheckoutController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// RVS Routes
Route::prefix('rvs')->name('rvs.')->group(function () {
    Route::get('/', [RvsController::class, 'index'])->name('index');
    Route::get('/services', [RvsController::class, 'services'])->name('services');
    Route::get('/services/{slug}', [RvsController::class, 'serviceDetail'])->name('service.detail');
});

// Booking Routes
Route::prefix('bookings')->name('bookings.')->group(function () {
    Route::get('/create/{serviceSlug?}', [BookingController::class, 'create'])->name('create');
    Route::post('/', [BookingController::class, 'store'])->name('store');
    Route::get('/success', [BookingController::class, 'success'])->name('success');
    Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('my-bookings');
});

// Shop Routes
Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('index');
    Route::get('/{slug}', [ShopController::class, 'show'])->name('show');
});

// Cart Routes
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
    Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
});

// Checkout Routes
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('process');
    Route::get('/success/{orderNumber}', [CheckoutController::class, 'success'])->name('success');
    Route::get('/paystack/callback', [CheckoutController::class, 'paystackCallback'])->name('paystack.callback');
    Route::get('/flutterwave/callback', [CheckoutController::class, 'flutterwaveCallback'])->name('flutterwave.callback');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Services
    Route::resource('services', AdminServiceController::class);
    
    // Bookings
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'destroy']);
    Route::patch('/bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
    
    // Products
    Route::resource('products', AdminProductController::class);
    
    // Orders
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('/orders/{order}/invoice', [AdminOrderController::class, 'invoice'])->name('orders.invoice');
});

require __DIR__.'/auth.php';