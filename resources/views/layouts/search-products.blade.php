@extends('app')

@section('title', 'Товары')

@section('content')
    @foreach($products as $product)
        <div class="col-xs-12 col-md-4 product-item">
            <a href="{{ route('product', [$product->category->code, $product->id]) }}"><img
                    src="{{ url("/images/product/{$product->id}/main/{$product->image}") }}" class="img-fluid img-center"></a>
            <div class="product">
                <div class="product_top">
                    <p class="product-title"><a href="{{ route('product', [$product->category->code, $product->id]) }}">{{ $product->name }}</a></p>
                    <favorite
                        :product={{ $product->id }}
                :favorited={{ $product->favorited() ? 'true' : 'false' }}
                    ></favorite>
                </div>
                @auth
                    <div class="product_bottom">
                        <div class="product_price">
                            @isset($product->price_sale)
                                <div class="product_price-sale">
                                    {{ numberFormatPrice($product->price_sale) }} руб.
                                </div>
                            @endisset
                            <div class="product_price_main">
                                @if($product->price_sale)
                                    <s>
                                        {{ numberFormatPrice($product->price) }} руб.
                                    </s>
                                @else
                                    {{ numberFormatPrice($product->price) }} руб.
                                @endif
                            </div>
                        </div>
                        <div class="sale">
                            @isset($product->price_sale)
                                -{{ $product->price_sale_percent }}%
                            @endif
                        </div>
                    </div>
                @endauth
            </div>
        </div>

    @endforeach
@endsection
