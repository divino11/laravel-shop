<?php

function sumByCount(\App\Product $product): float
{
    $price = $product->price;

    $sizeXS = $product->getOriginal('pivot_xs') ? $product->getOriginal('pivot_xs') : 0;
    $sizeS = $product->getOriginal('pivot_s') ? $product->getOriginal('pivot_s') : 0;
    $sizeM = $product->getOriginal('pivot_m') ? $product->getOriginal('pivot_m') : 0;
    $sizeL = $product->getOriginal('pivot_l') ? $product->getOriginal('pivot_l') : 0;

    $sum = $price * ($sizeXS + $sizeS + $sizeM + $sizeL);

    return $sum;
}

function sumByFullPrice($order)
{
    $sum = 0;

    foreach ($order as $product) {
        $sizeXS = $product->getOriginal('pivot_xs') ? $product->getOriginal('pivot_xs') : 0;
        $sizeS = $product->getOriginal('pivot_s') ? $product->getOriginal('pivot_s') : 0;
        $sizeM = $product->getOriginal('pivot_m') ? $product->getOriginal('pivot_m') : 0;
        $sizeL = $product->getOriginal('pivot_l') ? $product->getOriginal('pivot_l') : 0;

        $sum = $sum + $product->price * ($sizeXS + $sizeS + $sizeM + $sizeL);
    }

    return $sum;
}

function sumByPriceSale($order)
{
    $sum = 0;

    foreach ($order as $product) {
        $sizeXS = $product->getOriginal('pivot_xs') ? $product->getOriginal('pivot_xs') : 0;
        $sizeS = $product->getOriginal('pivot_s') ? $product->getOriginal('pivot_s') : 0;
        $sizeM = $product->getOriginal('pivot_m') ? $product->getOriginal('pivot_m') : 0;
        $sizeL = $product->getOriginal('pivot_l') ? $product->getOriginal('pivot_l') : 0;

        $sum = $sum + $product->price_sale * ($sizeXS + $sizeS + $sizeM + $sizeL);
    }

    return $sum;
}
