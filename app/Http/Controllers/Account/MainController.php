<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::where('status', 1)->get();

        return view('account.index', [
            'orders' => $orders
        ]);
    }
}
