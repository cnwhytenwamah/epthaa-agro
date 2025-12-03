<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontPages\RvsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FrontPages\CartController;
use App\Http\Controllers\FrontPages\HomeController;
use App\Http\Controllers\FrontPages\ShopController;
use App\Http\Controllers\FrontPages\BookingController;
use App\Http\Controllers\FrontPages\CheckoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
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


Route::group(['prefix'=>'admin'], function(){
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login',[AdminLoginController::class,'login'])->name('admin.auth.login');
    Route::get('register', [AdminRegisterController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('process-register', [AdminRegisterController::class, 'register'])->name('admin.auth.register');
    Route::get('forgot-password', [AdminForgotPasswordController::class, 'showForgotPasswordForm'])->name('admin.forgot-password');
    Route::post('send-password-reset-link', [AdminForgotPasswordController::class, 'sendResetLink'])->name('admin.auth.send-password-email');
    Route::get('reset-password/{token}', [AdminResetPasswordController::class, 'showResetPasswordForm'])->name('admin.reset-password');
    Route::post('password-update', [AdminResetPasswordController::class, 'resetPassword'])->name('admin.auth.password-update');
});



// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {

        // Dashboard
        Route::get('dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // Services
        Route::resource('services', AdminServiceController::class);

        // Bookings
        Route::resource('bookings', AdminBookingController::class)
            ->only(['index', 'show', 'destroy']);

        Route::patch('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])
            ->name('bookings.update-status');

        // Products
        Route::resource('products', AdminProductController::class);

        
        Route::get('list-products', [AdminProductsController::class, 'index'])->name('admin.products.index');
        Route::get('add-product', [AdminProductsController::class, 'create'])->name('admin.product.add');
        Route::post('store-product', [AdminProductsController::class, 'store'])->name('admin.product.store');
        Route::get('edit-product/{slug}', [AdminProductsController::class, 'edit'])->name('admin.product.edit');
        Route::get('show-product/{slug}', [AdminProductsController::class, 'show'])->name('admin.product.show');
        Route::post('update-product', [AdminProductsController::class, 'update'])->name('admin.product.update');

        // Orders
        Route::resource('orders', AdminOrderController::class)
            ->only(['index', 'show']);

        Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.update-status');

        Route::get('orders/{order}/invoice', [AdminOrderController::class, 'invoice'])
            ->name('orders.invoice');
    });

