<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(20);
        $category = Category::all();

        return view('index', [
            'products' => $products,
            'categories' => $category
        ]);
    }

    public function category($code): View
    {
        $categories = Category::all();
        $category = Category::where('code', $code)->first();

        return view('layouts.category', [
            'categories' => $categories,
            'category' => $category
        ]);
    }

    public function product($code, $id, $color): View
    {
        $category = Category::where('code', $code)->first();
        $product = Product::where('id', $id)->where('colors', $color)->first();
        $productSizes = DB::table('sizes_products')->where('product_id', $id)->get(['type', 'count']);
        $productColors = Product::where('parent_id', $product->parent_id)->get(['id', 'colors']);

        return view('layouts.product', [
            'product' => $product,
            'productSizes' => $productSizes,
            'category' => $category,
            'productColors' => $productColors,
        ]);
    }

    public function contact(): View
    {
        return view('layouts.contact');
    }

    public function auth(): View
    {
        return view('layouts.auth');
    }

    public function registration(): View
    {
        return view('layouts.register');
    }

    public function registrationSuccess(): View
    {
        return view('layouts.register-success');
    }

    public function search(Request $request): View
    {
        $products = $request->search ? Product::where('name', 'like', '%' . $request->search . '%')->paginate(20) : [];

        return view('layouts.search-products', [
            'products' => $products
        ]);
    }

    public function filter()
    {

    }
}
