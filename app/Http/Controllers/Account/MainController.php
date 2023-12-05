<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('account.profile', [
            'user' => Auth::user()
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());

        $user->update($request->all());

        session()->flash('success', 'Данные успешно обновленны!');
        return redirect()->back();
    }

    public function updateProfileAddress(Request $request)
    {
        $user = User::find(Auth::id());

        $data = $request->all();

        unset($data['_token'], $data['_method']);
        $data = array_merge(['user_id' => Auth::id()], $data);

        if (empty($user->address)) {
            UserAddress::create($data);
        } else {
            UserAddress::where('user_id', Auth::id())->update($data);
        }

        session()->flash('success', 'Данные успешно обновленны!');
        return redirect()->back();
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderProducts', 'orderProducts.product')
            ->orderByDesc('id')
            ->where('status', 1)
            ->get();

        return view('account.order', [
            'orders' => $orders
        ]);
    }
}
