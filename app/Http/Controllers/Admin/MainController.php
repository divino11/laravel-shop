<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 1)->get();

        return view('admin.index', [
            'orders' => $orders
        ]);
    }
}
