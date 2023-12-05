<?php

namespace App\Http\Controllers\Account;

use App\Category;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        $categories = Category::all();

        return view('account.basket', [
            'orders' => $order->products ?? [],
            'categories' => $categories
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
            'user' => Auth::user(),
            'order' => $order->products()->get()
        ]);
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }

        $order = Order::find($orderId);

        $price = $this->getTotalPriceForOrder($order->products);

        $data = array_merge($request->all(), ['price' => $price]);

        $success = $order->saveOrder($data);

        if ($success) {
            session()->forget('orderId');
            session()->flash('success', 'Ваш заказ успешно отправлен!');
        } else {
            session()->flash('error', 'Произошла ошибка!');
        }

        return redirect()->route('index');
    }

    public function basketAdd(Request $request)
    {
        $orderId = session('orderId');
        if (is_null($orderId)) {
            $order = Order::create();
            session(['orderId' => $order->id]);
        } else {
            $order = Order::find($orderId);
        }

        foreach ($request->size as $sizeId => $quantity) {
            if ((int)$quantity > 0) {
                DB::table('order_product')->insert([
                    'category_id' => $request->category_id,
                    'order_id' => $order->id,
                    'product_id' => $request->product_id,
                    'order_price' => $request->price,
                    'order_size' => $sizeId,
                    'order_color' => $request->color,
                    'quantity' => $quantity,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        /*if ($order->products->contains($request->product_id)) {
            $pivotRow = $order->products()->where('product_id', $request->product_id)->first()->pivot;
            $pivotRow->order_size = $request->size;
            $pivotRow->order_price = $request->price;
            $pivotRow->category_id = $request->category_id;
            $pivotRow->update();
        } else {
            if ($request->size) {
                $order->products()->attach($request->product_id, [
                    'order_size' => $request->size,
                    'order_price' => $request->price,
                    'category_id' => $request->category_id,
                ]);
            }
        }*/

        if (Auth::check()) {
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($request->product_id);

        session()->flash('success', 'Товар был добавлен ' . $product->name);

        return redirect()->back();
    }

    public function basketRemove($orderProductId)
    {
        /*$orderId = session('orderId');
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
        }*/

        $orderProduct = DB::table('order_product')->find($orderProductId);

        DB::table('order_product')->where('id', $orderProductId)->delete();

        $product = Product::find($orderProduct->product_id);

        session()->flash('warning', "Товар {$product->name} был удален");

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

    public function removeProductFromOrder($orderProductId)
    {
        DB::table('order_product')->where('id', $orderProductId)->delete();
    }

    public function getCount(): int
    {
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return $order->products->count() ?? 0;
    }

    public function getTotalPrice(): string
    {
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return numberFormatPrice(sumByPriceSale($order->products));
    }

    public function getTotalPriceForOrder(): string
    {
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return sumByPriceSale($order->products);
    }

    public function getTotalPriceWithoutDiscount(): string
    {
        $orderId = session('orderId');

        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }

        return numberFormatPrice(sumByFullPrice($order->products));
    }

    public function updateCount($orderProductId, $quantity)
    {
        DB::table('order_product')->where('id', $orderProductId)->update([
            'quantity' => $quantity
        ]);
    }
}
