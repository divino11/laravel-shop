<?php

namespace App\Providers;

use App\Favorite;
use App\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        view()->composer('*', function ($view)
        {
            if (Session::get('orderId')) {
                $view->with('basketProducts', $this->getBasket(Session::get('orderId')));
                $view->with('favoriteProducts', $this->getFavorites());
            }
        });
    }

    public function getBasket($orderId)
    {
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return $order->products;
    }

    public function getFavorites()
    {
        if (!is_null(session()->getId())) {
            $favorites = Favorite::find(session()->getId())->products()->get();
        }

        return $favorites;
    }
}
