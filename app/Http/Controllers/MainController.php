<?php

namespace App\Http\Controllers;

use App\Category;
use App\LastViewedProduct;
use App\Product;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class MainController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(20);
        $category = Category::whereNotIn('id', [2, 3, 4])->get();

        return view('index', [
            'products' => $products,
            'categories' => $category
        ]);
    }

    public function catalog(): View
    {
        $products = Product::paginate(20);
        $category = Category::whereNotIn('id', [2, 3, 4])->get();

        return view('layouts.catalog', [
            'products' => $products,
            'categories' => $category
        ]);
    }

    public function category($code): View
    {
        $categories = Category::whereNotIn('id', [2, 3, 4])->get();
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
        $categories = Category::whereNotIn('id', [2, 3, 4])->get();

        $this->middleware('last.viewed')->only(['product']);

        // Retrieve the last viewed products
        $lastViewedProducts = $this->getLastViewedProducts($product);

        return view('layouts.product', [
            'product' => $product,
            'category' => $category,
            'categories' => $categories,
            'lastViewedProducts' => $lastViewedProducts
        ]);
    }

    private function getLastViewedProducts(Product $product): Collection
    {
        $userId = Auth::id();

        if ($userId) {
            $lastViewedProducts = LastViewedProduct::where('user_id', $userId)
                ->whereNotIn('product_id', [$product->id])
                ->orderByDesc('viewed_at')
                ->take(8)
                ->with('product')
                ->get();

            $products = collect();

            foreach ($lastViewedProducts as $lastViewedProduct) {
                $products[] = $lastViewedProduct->product;
            }

            return $products;
        }

        $cookieValue = Cookie::get('last_viewed_products');

        if ($cookieValue) {
            $lastViewedProducts = json_decode($cookieValue, true);

            if (in_array($product->id, $lastViewedProducts)) {
                $index = array_search($product->id, $lastViewedProducts);
                unset($lastViewedProducts[$index]);
            }

            return Product::whereIn('id', $lastViewedProducts)->get();
        }

        return collect();
    }

    public function contact(): View
    {
        return view('layouts.contact');
    }

    public function paymentsAndDelivery(): View
    {
        return view('layouts.payments-and-delivery');
    }

    public function returnAndChange(): View
    {
        return view('layouts.return-and-change');
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
        $products = $request->search ? Product::where('name', 'like', '%' . $request->search . '%')->with('categories')->paginate(20) : [];

        foreach ($products as &$product) {
            $product['category'] = Category::find($product->categories[0]->category_id);
        }

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
