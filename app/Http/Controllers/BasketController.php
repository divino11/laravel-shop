<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return view('layouts.basket', [
            'orders' => $order->products ?? []
        ]);
    }

    public function basketPlace()
    {
        if (!Auth::check()) {
            session()->flash('info', 'Нужно выполнить авторизацию!');

            return redirect()->route('authentication');
        }

        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }

        $order = Order::find($orderId);

        return view('layouts.order', [
            'order' => $order
        ]);
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }

        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if ($success) {
            session()->forget('orderId');
            session()->flash('success', 'You order is complete!');
        } else {
            session()->flash('warning', 'Happen failure');
        }

        return redirect()->route('index');
    }

    public function basketAdd(Request $request)
    {
        if (
            $request->sizes['size-xs'] == 0 &&
            $request->sizes['size-s'] == 0 &&
            $request->sizes['size-m'] == 0 &&
            $request->sizes['size-l'] == 0
        ) {
            session()->flash('error', 'Выберите хотя бы один размер!');

            return back();
        }

        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($request->product_id)) {
            $pivotRow = $order->products()->where('product_id', $request->product_id)->first()->pivot;
            $pivotRow->color = $request->color;
            $pivotRow->xs += $request->sizes['size-xs'];
            $pivotRow->s += $request->sizes['size-s'];
            $pivotRow->m += $request->sizes['size-m'];
            $pivotRow->l += $request->sizes['size-l'];
            $pivotRow->update();
        } else {
            if ($request->sizes) {
                $order->products()->attach($request->product_id, [
                    'color' => $request->color,
                    'xs' => $request->sizes['size-xs'],
                    's' => $request->sizes['size-s'],
                    'm' => $request->sizes['size-m'],
                    'l' => $request->sizes['size-l'],
                ]);
            }
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($request->product_id);

        session()->flash('success', 'Товар был добавлен ' . $product->name);

        return redirect()->back();
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }

        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);

        session()->flash('warning', 'Product has been removed ' . $product->name);

        return redirect()->route('basket');
    }

    public function addSizeToOrder(Order $order, $size)
    {
        $size = str_replace('sizes[size-', '', str_replace(']', '', $size));
        $order->products()->increment($size);
    }

    public function removeSizeFromOrder(Order $order, $size)
    {
        $size = str_replace('sizes[size-', '', str_replace(']', '', $size));
        $order->products()->decrement($size);
    }

    public function removeProductFromOrder($productId)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }

        $order = Order::find($orderId);

        $order->products()->detach($productId);
    }
}
