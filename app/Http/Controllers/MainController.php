<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;
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

    public function product($code, $id): View
    {
        $category = Category::where('code', $code)->first();
        $product = Product::where('id', $id)->first();
        $ratings = Rating::where('product_id', $id)->orderBy('id', 'DESC')->get();

        return view('layouts.product', [
            'product' => $product,
            'category' => $category,
            'ratings' => $ratings,
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

    public function chooseSize(): View {
        return view('layouts.choose-size');
    }

    public function instaShop() {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://instagram85.p.rapidapi.com/tag/christmas/feed",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: instagram85.p.rapidapi.com",
                "x-rapidapi-key: 6b7d3f1c1emshd91131f8cb7ed9ap1bd81bjsn5343aac1cb8e"
            ],
        ]);

        $response = curl_exec($curl);
        dd($response);
        $err = curl_error($curl);

        curl_close($curl);

        return view('layouts.insta-shop', [
            'posts' => $response
        ]);
    }

    public function filter()
    {

    }
}
