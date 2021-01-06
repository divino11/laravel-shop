<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Auth::user()->favorites;
        $category = Category::all();

        return view('favorites', [
            'products' => $products,
            'categories' => $category
        ]);
    }

    /**
     * Favorite a particular product
     *
     * @param  Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function favoriteProduct(Product $product)
    {
        Auth::user()->favorites()->attach($product->id);

        return back();
    }

    /**
     * Unfavorite a particular product
     *
     * @param  Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unFavoriteProduct(Product $product)
    {
        Auth::user()->favorites()->detach($product->id);

        return back();
    }
}
