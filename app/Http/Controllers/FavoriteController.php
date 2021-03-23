<?php

namespace App\Http\Controllers;

use App\Category;
use App\Favorite;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Auth::check()
            ?
            Auth::user()->favorites
            :
            //Favorite::find(session()->getId()) ? Favorite::find(session()->getId())->products()->get() : [];
            [];

        $category = Category::all();

        return view('layouts.favorites', [
            'products' => $products ?? [],
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
        if (Auth::check()) {
            Auth::user()->favorites()->attach($product->id);
        } else {
            Favorite::create([
                'user_id' => session()->getId(),
                'product_id' => $product->id
            ]);
        }

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
        if (Auth::check()) {
            Auth::user()->favorites()->detach($product->id);
        } else {
            Favorite::where('user_id', session()->getId())->where('product_id', $product->id)->delete();
        }

        return back();
    }
}
