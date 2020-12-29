<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::paginate(20);
        $category = Category::all();

        return view('index', [
            'products' => $products,
            'categories' => $category
        ]);
    }

    public function category($code)
    {
        $categories = Category::all();
        $category = Category::where('code', $code)->first();

        return view('category', [
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function product($code, $id)
    {
        $category = Category::where('code', $code)->first();
        $product = Product::where('id', $id)->first();

        return view('product', [
            'product' => $product,
            'category' => $category
        ]);
    }
}
