<?php

function sumByCount(\App\Product $product, $typePrice = 'fullPrice'): float
{
    if ($typePrice === 'fullPrice') {
        $price = $product->price;
    } else {
        $price = $product->price_sale;
    }

    $sum = 0;

    $sum += $price;

    return $sum;
}

function sumByQuantity(\App\Product $product, int $quantity, $typePrice = 'fullPrice'): float
{
    if ($typePrice === 'fullPrice') {
        $price = $product->price;
    } else {
        $price = $product->price_sale;
    }

    $sum = 0;

    $sum += $price * $quantity;

    return $sum;
}


function getTotalSum($order)
{
    return $order->order_price;
}

function sumByFullPrice($order)
{
    $sum = 0;

    foreach ($order as $product) {
        $price = $product->price;

        $sum += $price * $product->getOriginal('pivot_quantity');
    }

    return $sum;
}

function sumByPriceSale($order)
{
    $sum = 0;

    foreach ($order as $product) {
        $price = $product->price_sale ?: $product->price;

        $sum += $price * $product->getOriginal('pivot_quantity');
    }

    return $sum;
}

function numberFormatPrice($price)
{
    return number_format($price, 2, ',', ' ');
}
