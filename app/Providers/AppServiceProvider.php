<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer([
            'partials.cart_nav_item',
            'shop.cart.index',
            'shop.cart.checkout',
        ], function ($view) {
            if (!session('cart')) {
                $view->with([
                    'products' => null,
                    'totalPrice' => 0,
                    'totalQty' => 0,
                ]);
            }

            $oldCart = session('cart');
            $cart = new Cart($oldCart);

            $view->with([
                'products' => $cart->items,
                'totalPrice' => $cart->totalPrice,
                'totalQty' => $cart->totalQty,
            ]);
        });

        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $idOrders = $user->orders()->pluck('id')->toArray();
                if (count($idOrders) > 0) {
                    $view->with([
                        'idOrders' => $idOrders,
                    ]);
                } else {
                    $view->with([
                        'idOrders' => [0],
                    ]);
                }
            }
        });
    }
}
