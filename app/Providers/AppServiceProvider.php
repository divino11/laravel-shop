<?php

namespace App\Providers;

use App\Category;
use App\Favorite;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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
        if(config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        Schema::defaultStringLength(191);

        view()->share('categories', Category::whereNotIn('id', [2, 3, 4])->get());

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
        $userId = Auth::id();

        if ($userId) {
            $favorites = Favorite::where('user_id', $userId)->get();
        } else {
            $favorites = json_decode(Cookie::get('favoriteId', '[]'), true);
        }

        return $favorites ?? [];
    }
}
