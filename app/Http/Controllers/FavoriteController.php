<?php

namespace App\Http\Controllers;

use App\Category;
use App\Favorite;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        $category = Category::all();

        return view('layouts.favorites', [
            'products' => $favoriteData ?? [],
            'categories' => $category
        ]);
    }

    /**
     * Favorite a particular product
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function favoriteProduct(Product $product)
    {
        $favoriteId = session('favoriteId');

        if (is_null($favoriteId)) {
            $favorite = Favorite::create();
            session(['favoriteId' => $favorite->id]);
        } else {
            $favorite = Favorite::create();
        }

        $favorite->user_id = $favoriteId;
        $favorite->product_id = $product->id;

        $favorite->save();

        return back();
    }

    /**
     * Unfavorite a particular product
     *
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unFavoriteProduct(Product $product)
    {
        $favoriteId = session('favoriteId');

        if (is_null($favoriteId)) {
            return back();
        }

        Favorite::where('user_id', session('favoriteId'))->where('product_id', $product->id)->delete();

        return back();
    }
}
