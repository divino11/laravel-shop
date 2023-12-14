<?php

namespace App\Http\Controllers\Account;

use App\Category;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $favorites = Product::whereIn('id', Favorite::where('user_id', Auth::id())->pluck('product_id'))->get();

        $category = Category::whereNotIn('id', [2, 3, 4])->get();

        return view('account.favorites', [
            'products' => $favorites ?? [],
            'categories' => $category
        ]);
    }

    public function favoriteProduct(Product $product): JsonResponse
    {
        $userId = Auth::id();

        // For authenticated users, store the view in the database
        Favorite::updateOrCreate([
            'user_id' => $userId,
            'product_id' => $product->id,
        ]);

        // For non-authenticated users, store the view in cookies
        $favoriteIds = json_decode(Cookie::get('favoriteId', '[]'), true);

        // Avoid duplicate entries
        if (!in_array($product->id, $favoriteIds)) {
            array_unshift($favoriteIds, $product->id);

            // Update the cookie
            Cookie::queue('favoriteId', json_encode($favoriteIds), 60 * 24 * 30); // Cookie for 30 days
        }

        return response()->json([
            'count' => Favorite::where('user_id', $userId)->count()
        ]);
    }

    public function unFavoriteProduct(Product $product): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $userId = Auth::id();

        Favorite::where('user_id', $userId)->where('product_id', $product->id)->delete();

        // For non-authenticated users, store the view in cookies
        $favoriteIds = json_decode(Cookie::get('favoriteId', '[]'), true);

        if (in_array($product->id, $favoriteIds)) {
            $index = array_search($product->id, $favoriteIds);
            unset($favoriteIds[$index]);
        }

        // Update the cookie
        Cookie::queue('favoriteId', json_encode($favoriteIds), 60 * 24 * 30); // Cookie for 30 days

        return response()->json([
            'count' => Favorite::where('user_id', $userId)->count()
        ]);
    }
}
