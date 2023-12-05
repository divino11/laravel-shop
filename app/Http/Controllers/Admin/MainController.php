<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MainPage;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $orders = Order::where('status', 1)->get();

        return view('admin.index', [
            'orders' => $orders
        ]);
    }

    public function mainPage()
    {
        return view('admin.main_page', [
            'mainPage' => MainPage::first()
        ]);
    }

    public function updateMainPage(Request $request)
    {
        $mainPage = MainPage::first();

        if (isset($request->main_banner)) {
            $this->storeBannerObject($mainPage, $request->file('main_banner'), 'main_banner');
        }

        if (isset($request->main_banner_mobile)) {
            $this->storeBannerObject($mainPage, $request->file('main_banner_mobile'), 'main_banner_mobile');
        }

        if (isset($request->second_banner)) {
            $this->storeBannerObject($mainPage, $request->file('second_banner'), 'second_banner');
        }

        if (isset($request->second_banner_mobile)) {
            $this->storeBannerObject($mainPage, $request->file('second_banner_mobile'), 'second_banner_mobile');
        }

        if (isset($request->third_banner)) {
            $this->storeBannerObject($mainPage, $request->file('third_banner'), 'third_banner');
        }

        if (isset($request->third_banner_mobile)) {
            $this->storeBannerObject($mainPage, $request->file('third_banner_mobile'), 'third_banner_mobile');
        }

        session()->flash('success', 'Баннеры обновленны!');
        return redirect()->back();
    }

    public function storeBannerObject(MainPage $mainPage, $file, string $column): void
    {
        $filename = $file->getClientOriginalName();
        $file->storeAs('/public/banners/', $filename);

        $mainPage->update([
            $column => $filename
        ]);
    }
}
