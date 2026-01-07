<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\AdminRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\ServiceRepository;
use App\Repositories\Eloquent\BookingsRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Services\Factories\PaymentServiceFactory;
use App\Repositories\Eloquent\TestimonialRepository;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Interface\AdminRepositoryInterface;
use App\Repositories\Interface\OrderRepositoryInterface;
use App\Repositories\Interface\PaymentRepositoryInterface;
use App\Repositories\Interface\ProductRepositoryInterface;
use App\Repositories\Interface\ServiceRepositoryInterface;
use App\Repositories\Interface\BookingsRepositoryInterface;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\TestimonialRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BookingsRepositoryInterface::class, BookingsRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(TestimonialRepositoryInterface::class, TestimonialRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, function () {
            $gateway = request()->input('payment_method') ?? env('PAYMENT_GATEWAY');
            return PaymentServiceFactory::make($gateway);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
