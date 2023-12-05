<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('id', 'order_color', 'order_size', 'quantity', 'order_price', 'category_id')->withTimestamps();
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTotalSum()
    {
        return $this->products();
    }

    public function getFullPrice()
    {
        $sum = 0;
        foreach ($this->products as $product) {
            $sum += $product->getPriceByCount();
        }

        return $sum;
    }

    public function saveOrder($order)
    {
        if ($this->status === 0) {
            $this->user_id = Auth::user()->id;
            $this->firstname = $order['firstname'];
            $this->lastname = $order['lastname'];
            $this->city = $order['city'];
            $this->house = $order['house'];
            $this->building = $order['building'];
            $this->room = $order['room'];
            $this->type_delivery = $order['type_delivery'];
            $this->type_pay = $order['type_pay'];
            $this->phone = $order['phone'];
            $this->price = $order['price'];
            $this->status = 1;
            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();
            $this->save();
            return true;
        }

        return false;
    }
}
