<?php

namespace App\Providers;

use App\Repositories\Cart\CartInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Products\ProductInterface;
use App\Repositories\Products\ProductRepository;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ProductService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // product
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService($app->make(ProductInterface::class));
        });
        // cart
        $this->app->bind(CartInterface::class, CartRepository::class);
        $this->app->bind(CartService::class, function ($app) {
            return new CartService($app->make(CartInterface::class));
        });
        // order
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(OrderService::class, function ($app) {
            return new OrderService($app->make(OrderInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
