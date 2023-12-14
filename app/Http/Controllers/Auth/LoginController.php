<?php

namespace App\Http\Controllers\Auth;

use App\Favorite;
use App\Http\Controllers\Controller;
use App\LastViewedProduct;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // After the user is authenticated, retrieve products from the cookie
        $lastViewedProductsFromCookie = $this->getLastViewedProductsFromCookie();

        // Save the products to the LastViewedProduct model
        foreach ($lastViewedProductsFromCookie as $productId) {
            if (!is_null($productId)) {
                LastViewedProduct::updateOrCreate([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);
            }
        }

        $favoriteProductsFromCookie = $this->getFavoriteProductsFromCookie();

        // Save the products to the Favorite model
        foreach ($favoriteProductsFromCookie as $productId) {
            Favorite::updateOrCreate([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
        }

        // Continue with the default authenticated logic
        return redirect()->intended($this->redirectPath());
    }

    private function getLastViewedProductsFromCookie()
    {
        $cookieValue = Cookie::get('last_viewed_products');

        if ($cookieValue) {
            return json_decode($cookieValue, true);
        }

        return [];
    }

    private function getFavoriteProductsFromCookie()
    {
        $cookieValue = Cookie::get('favoriteId');

        if ($cookieValue) {
            return json_decode($cookieValue, true);
        }

        return [];
    }
}
