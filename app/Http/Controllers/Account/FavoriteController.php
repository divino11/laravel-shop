<?php

namespace App\Http\Controllers\Account;

use App\Category;
use App\Favorite;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (!is_null(session('favoriteId'))) {
            $issetFavorites = Favorite::where('user_id', session('favoriteId'))->count();

            if ($issetFavorites == 0) {
                $favoriteData = [];
            } else {
                $favorites = Favorite::where('user_id', session('favoriteId'))->get();
                $favoriteData = collect();

                foreach ($favorites as $favorite) {
                    $products = Favorite::find($favorite->id)->products()->get();
                    $favoriteData = $favoriteData->merge($products);
                }
            }
        }

        $category = Category::whereNotIn('id', [2, 3, 4])->get();

        return view('account.favorites', [
            'products' => $favoriteData ?? [],
            'categories' => $category
        ]);
    }

    public function favoriteProduct(Product $product): JsonResponse
    {
        $favoriteId = session('favoriteId');

        $favorite = Favorite::create([
            'user_id' => $favoriteId,
            'product_id' => $product->id
        ]);

        if (is_null($favoriteId)) {
            session(['favoriteId' => $favorite->id]);
        } else {
            if (is_null($favoriteId)) {
                session(['favoriteId' => $favorite->id]);
            }
        }

        return response()->json([
            'count' => Favorite::where('user_id', $favoriteId)->count()
        ]);
    }

    public function unFavoriteProduct(Product $product): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $favoriteId = session('favoriteId');

        if (is_null($favoriteId)) {
            return back();
        }

        Favorite::where('user_id', session('favoriteId'))->where('product_id', $product->id)->delete();

        return response()->json([
            'count' => Favorite::where('user_id', $favoriteId)->count()
        ]);
    }
}
