@extends('app')

@section('title', 'Корзина')

@section('content')
    <div class="heading">Корзина</div>

    <table class="table table-basket">
        <thead>
        <tr>
            <td>Товар</td>
            <td>Описание</td>
            <td>Рост</td>
            <td>Размер</td>
            <td>Цена</td>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $product)
            <tr>
                <td><a href="{{ route('product', [$product->category->code, $product->id]) }}"><img
                            class="img-size-130"
                            src="{{ url('images/' . $product->image) }}"
                            alt=""></a></td>
                <td>
                    <a href="{{ route('product', [$product->category->code, $product->id]) }}">{{ $product->name }}</a>
                </td>
                <td>
                    {{ $product->getOriginal('pivot_order_height') }}
                </td>
                <td>
                    {{ $product->getOriginal('pivot_order_size') }}
                </td>
                <td>
                    <div class="basket_actions">
                        <div class="basket_fullprice">
                            @if($product->price_sale)
                                <span class="red_price">{{ numberFormatPrice(sumByCount($product, 'priceSale')) }} руб.</span><br>
                            @endif
                            @if($product->price_sale)
                                <s>{{ numberFormatPrice(sumByCount($product)) }} руб.</s>
                            @else
                                {{ numberFormatPrice(sumByCount($product)) }} руб.
                            @endif
                        </div>
                        <div class="basket_action">
                            <form action="{{ route('basket-remove', $product) }}" method="post">
                                @csrf
                                <button><i class="far fa-trash-alt"></i> Удалить</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @empty
            <td colspan="5" style="text-align: center">Корзина пока что пуста</td>
        @endforelse
        </tbody>
    </table>

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
