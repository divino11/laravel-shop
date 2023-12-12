@extends('app-account')

@section('title', 'Корзина')

@section('content')
    <div class="heading">Корзина</div>

    <div class="container">
        <div class="order-wrapper">
        @foreach($orders as $product)
            <div class="order-item order-item-{{ $product->getOriginal('pivot_id') }}">
                <div class="order-item-image">
                <a href="{{ route('product', [
                        \App\Category::find($product->getOriginal('pivot_category_id'))->code,
                        $product->id
                    ]) }}"><img
                        class="img-size-130"
                        src="{{ url("/images/product/{$product->id}/main/" . $product->image) }}"
                        alt="{{ $product->name }}"></a>
                </div>
                <div class="order-item-info">
                    <div class="order-item-info-title">
                        <a href="{{ route('product', [
                            \App\Category::find($product->getOriginal('pivot_category_id'))->code,
                             $product->id
                         ]) }}">{{ $product->name }}</a>
                        <span>Артикул: {{ $product->code }}</span>
                    </div>
                    <div class="order-info-details">
                        <div class="order-info-details-color">
                            <div>Цвет</div>
                            <span class="order-color-box" style="background-color: {{ \App\Color::find($product->getOriginal('pivot_order_color'))->hex_code }}"></span>
                        </div>
                        <div class="order-info-details-size">
                            <div>Размер</div>
                            <span>{{ \App\Size::find($product->getOriginal('pivot_order_size'))->name }}</span>
                        </div>
                        <div class="order-info-details-quantity">
                            <div>Количество</div>
                            <button class="quantity-control button-size" data-action="decrement" data-price="{{ $product->price }}" data-price-sale="{{ $product->price_sale }}" data-product="{{ $product->getOriginal('pivot_id') }}" data-target="product_{{ $product->getOriginal('pivot_id') }}">-</button>
                            <span id="product_{{ $product->getOriginal('pivot_id') }}">{{ $product->getOriginal('pivot_quantity') }}</span>
                            <button class="quantity-control button-size" data-action="increment" data-price="{{ $product->price }}" data-price-sale="{{ $product->price_sale }}" data-product="{{ $product->getOriginal('pivot_id') }}" data-target="product_{{ $product->getOriginal('pivot_id') }}">+</button>
                        </div>
                        <div class="order-info-details-price">
                            <div>Цена</div>
                            <span>
                                @if($product->price_sale)
                                    <span
                                        class="red_price">{{ numberFormatPrice(sumByQuantity($product, (int)$product->getOriginal('pivot_quantity'), 'priceSale')) }} руб.</span>
                                    <br>
                                @endif
                                @if($product->price_sale)
                                    <s>{{ numberFormatPrice(sumByQuantity($product, (int)$product->getOriginal('pivot_quantity'))) }} руб.</s>
                                @else
                                    {{ numberFormatPrice(sumByQuantity($product, (int)$product->getOriginal('pivot_quantity'))) }} руб.
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="basket_remove">
                    <form action="{{ route('basket-remove', ['id' => $product->getOriginal('pivot_id')]) }}" method="post">
                        @csrf
                        <button><i class="fas fa-times"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    </div>

    @include('parts.basket-footer', $orders)

    <div class="similar_wrapper">
        <div class="similar_container">
            <p class="inner_heading">С этим товаром покупают</p>

            <div class="similar_gallery">
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        <div class="product_bottom">
                            <div class="product_price">
                                <div class="product_price_main">
                                    <s>
                                        3400 р.
                                    </s>
                                </div>
                                <div class="product_price-sale">
                                    2000 р.
                                </div>
                            </div>
                            <div class="sale">
                                -60%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        <div class="product_bottom">
                            <div class="product_price">
                                <div class="product_price_main">
                                    <s>
                                        3400 р.
                                    </s>
                                </div>
                                <div class="product_price-sale">
                                    2000 р.
                                </div>
                            </div>
                            <div class="sale">
                                -60%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        <div class="product_bottom">
                            <div class="product_price">
                                <div class="product_price_main">
                                    <s>
                                        3400 р.
                                    </s>
                                </div>
                                <div class="product_price-sale">
                                    2000 р.
                                </div>
                            </div>
                            <div class="sale">
                                -60%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        <div class="product_bottom">
                            <div class="product_price">
                                <div class="product_price_main">
                                    <s>
                                        3400 р.
                                    </s>
                                </div>
                                <div class="product_price-sale">
                                    2000 р.
                                </div>
                            </div>
                            <div class="sale">
                                -60%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        <div class="product_bottom">
                            <div class="product_price">
                                <div class="product_price_main">
                                    <s>
                                        3400 р.
                                    </s>
                                </div>
                                <div class="product_price-sale">
                                    2000 р.
                                </div>
                            </div>
                            <div class="sale">
                                -60%
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        <div class="product_bottom">
                            <div class="product_price">
                                <div class="product_price_main">
                                    <s>
                                        3400 р.
                                    </s>
                                </div>
                                <div class="product_price-sale">
                                    2000 р.
                                </div>
                            </div>
                            <div class="sale">
                                -60%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
