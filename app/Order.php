<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('color', 'xs', 's', 'm', 'l')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
            $this->firstname = $order->firstname;
            $this->lastname = $order->lastname;
            $this->city = $order->city;
            $this->house = $order->house;
            $this->building = $order->building;
            $this->room = $order->room;
            $this->type_delivery = $order->type_delivery;
            $this->type_pay = $order->type_pay;
            $this->phone = $order->phone;
            $this->status = 1;
            $this->save();
            return true;
        } else {
            return false;
        }
    }
}
