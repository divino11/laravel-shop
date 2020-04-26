<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');
        $categories = Category::all();

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return view('basket', [
            'categories' => $categories,
            'order' => $order
        ]);
    }

    public function basketPlace()
    {
        return view('order');
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        $order->products()->attach($productId);

        return redirect()->route('basket');
    }
}
