<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\ReviewRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\RequestProductRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ProductRepository;
use App\Repositories\Eloquent\ReviewRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\RequestProductRepository;
use App\Repositories\Eloquent\UserRepository;
use App;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        App::bind(ProductRepositoryInterface::class, ProductRepository::class);
        App::bind(ReviewRepositoryInterface::class, ReviewRepository::class);
        App::bind(OrderRepositoryInterface::class, OrderRepository::class);
        App::bind(RequestProductRepositoryInterface::class, RequestProductRepository::class);
        App::bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
