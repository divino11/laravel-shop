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

function getTotalSum($order)
{
    return $order->order_price;
}

function sumByFullPrice($order)
{
    $sum = 0;

    foreach ($order as $product) {
        $price = $product->price;

        $sum += $price;
    }

    return $sum;
}

function sumByPriceSale($order)
{
    $sum = 0;

    foreach ($order as $product) {
        $price = $product->price_sale ? $product->price_sale : $product->price;

        $sum += $price;
    }

    return $sum;
}

function numberFormatPrice($price)
{
    return number_format($price, 2, ',', ' ');
}
