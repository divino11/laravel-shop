<?php

function sumByCount(\App\Product $product): float
{
    $price = $product->price;

    $size = getOriginalSizeValue($product);

    $sum = $price * ($size['xs'] + $size['s'] + $size['m'] + $size['l']);

    return $sum;
}

function sumByCountPriceSale(\App\Product $product): float
{
    $price = $product->price_sale;

    $size = getOriginalSizeValue($product);

    $sum = $price * ($size['xs'] + $size['s'] + $size['m'] + $size['l']);

    return $sum;
}

function sumByFullPrice($order)
{
    $sum = 0;

    foreach ($order as $product) {
        $size = getOriginalSizeValue($product);

        $sum = $sum + $product->price * ($size['xs'] + $size['s'] + $size['m'] + $size['l']);
    }

    return $sum;
}

function sumByPriceSale($order)
{
    $sum = 0;

    foreach ($order as $product) {
        $size = getOriginalSizeValue($product);

        $price = $product->price_sale ? $product->price_sale : $product->price;

        $sum = $sum + $price * ($size['xs'] + $size['s'] + $size['m'] + $size['l']);
    }

    return $sum;
}

function numberFormatPrice($price)
{
    return number_format($price, 2, ',', ' ');
}

function getOriginalSizeValue($product)
{
    $sizeXS = $product->getOriginal('pivot_xs') ? $product->getOriginal('pivot_xs') : 0;
    $sizeS = $product->getOriginal('pivot_s') ? $product->getOriginal('pivot_s') : 0;
    $sizeM = $product->getOriginal('pivot_m') ? $product->getOriginal('pivot_m') : 0;
    $sizeL = $product->getOriginal('pivot_l') ? $product->getOriginal('pivot_l') : 0;

    return [
        'xs' => $sizeXS,
        's'  => $sizeS,
        'm'  => $sizeM,
        'l'  => $sizeL
    ];
}
