<?php

namespace App\Providers;

use App\Favorite;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        view()->composer('*', function ($view)
        {
            if (Session::get('orderId')) {
                $view->with('basketProducts', $this->getBasket(Session::get('orderId')));
            }
            $view->with('favoriteProducts', $this->getFavorites());
        });
    }

    public function getBasket($orderId)
    {
        if (!is_null($orderId)) {
            $order = Order::find($orderId);
        }

        return $order->products ?? [];
    }

    public function getFavorites()
    {
        if (!is_null(session('favoriteId'))) {
            $issetFavorites = Favorite::where('user_id', session('favoriteId'))->count();

            if ($issetFavorites == 0) {
                $favorites = [];
            } else {
                $favorites = Favorite::where('user_id', session('favoriteId'))->get();
            }
        }

        return $favorites ?? [];
    }
}
