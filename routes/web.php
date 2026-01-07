<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\MyOrderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\FrontPages\RvsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FrontPages\CartController;
use App\Http\Controllers\FrontPages\HomeController;
use App\Http\Controllers\FrontPages\ShopController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\FrontPages\BookingController;
use App\Http\Controllers\FrontPages\PaymentController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\FrontPages\CheckoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisterController;
use App\Http\Controllers\FrontPages\Auth\UserLoginController;
use App\Http\Controllers\FrontPages\Auth\UserRegisterController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\FrontPages\Auth\UserResetPasswordController;
use App\Http\Controllers\FrontPages\Auth\UserForgotPasswordController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::group(['middleware'=>'auth:user'], function(){
    // Route::group(['prefix'=>'user'], function(){
    //     Route::get('profile', [UserDashboardController::class, 'index'])->name('user.profile');
    // });
    //add other authenticated pages here.

    Route::middleware('auth')->group(function () {
        Route::get('profile', [UserProfileController::class, 'show'])->name('user.profile');
        Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/password', [UserProfileController::class, 'updatePassword'])->name('profile.password.update');
        Route::delete('/profile/avatar', [UserProfileController::class, 'deleteAvatar'])->name('profile.avatar.delete');


        Route::get('/my-bookings', [BookingController::class, 'myBookings'])->name('bookings.my-bookings');
    
        // My Orders
        Route::get('/my-orders', [MyOrderController::class, 'index'])->name('orders.my-orders');
        Route::get('/my-orders/{order}', [MyOrderController::class, 'show'])->name('orders.show');
    });

    Route::post('/logout', function () {
        Auth::guard('user')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    })->name('logout');


    // RVS Routes
    Route::prefix('rvs')->name('rvs.')->group(function () {
        Route::get('/', [RvsController::class, 'index'])->name('index');
        Route::get('/services', [RvsController::class, 'services'])->name('services');
        Route::get('/services/{slug}', [RvsController::class, 'serviceDetail'])->name('service.detail');
    });



    // Cart Routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/add/{id}', [CartController::class, 'add'])->name('add');
        // Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::patch('/update/{id}', [CartController::class, 'update'])->name('update');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    });

    // Checkout Routes
    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('process');
        Route::get('/success/{orderNumber}', [CheckoutController::class, 'success'])->name('success');
        Route::post('/payment/initialize', [PaymentController::class, 'initializePayment'])->name('payment.initialize');
        Route::get('/payment/verify/{reference}', [CheckoutController::class, 'paystackCallback'])->name('payment.verify');
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

    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

// User Auth
Route::get('login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('login',[UserLoginController::class,'login'])->name('auth.login');
Route::get('register', [UserRegisterController::class, 'showRegisterForm'])->name('register');
Route::post('process-register', [UserRegisterController::class, 'register'])->name('auth.register');
Route::get('forgot-password', [UserForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('send-password-reset-link', [UserForgotPasswordController::class, 'sendResetLink'])->name('auth.send-password-email');
Route::get('reset-password/{token}', [UserResetPasswordController::class, 'showResetPasswordForm'])->name('reset-password');
Route::post('password-update', [UserResetPasswordController::class, 'resetPassword'])->name('auth.password-update');


// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth:admin'])->group(function () {

    // Dashboard
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // Services
    Route::resource('services', AdminServiceController::class);
    // Bookings
    Route::resource('bookings', AdminBookingController::class)->only(['index', 'show', 'destroy']);        
    Route::patch('bookings/{booking}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.update-status');
    // Products
    Route::resource('products', AdminProductController::class);    
    // Orders
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('orders/{order}/invoice', [AdminOrderController::class, 'invoice'])->name('orders.invoice');


    // Category
    Route::resource('categories', CategoryController::class);
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
    // Orders
    Route::resource('orders', OrderController::class);
    Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');

});

