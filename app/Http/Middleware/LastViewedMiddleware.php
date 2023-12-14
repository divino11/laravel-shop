<?php

namespace App\Http\Middleware;

use App\LastViewedProduct;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class LastViewedMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        $userId = Auth::id();

        if ($userId) {
            // For authenticated users, store the view in the database
            LastViewedProduct::updateOrCreate([
                'user_id' => $userId,
                'product_id' => $request->route('product'),
            ]);
        }

        // For non-authenticated users, store the view in cookies
        $productId = $request->route('product');

        $lastViewedProducts = json_decode(Cookie::get('last_viewed_products', '[]'), true);

        // Avoid duplicate entries
        if (!in_array($productId, $lastViewedProducts)) {
            array_unshift($lastViewedProducts, $productId);

            // Update the cookie
            Cookie::queue('last_viewed_products', json_encode($lastViewedProducts), 60 * 24 * 30); // Cookie for 30 days
        }

        return $next($request);
    }
}
