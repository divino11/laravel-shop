@extends('app')

@section('title', 'Товары')

@section('content')
    <div class="col-xs-8 col-md-8">
        <div class="row">
            @foreach($product->images as $image)
                <div class="col-xs-12 col-md-6">
                    @if ($image->type === 'image')
                        <a href="{{ url("/images/product/{$product->id}/images/{$image->path}") }}" data-fancybox="gallery">
                            <img src="{{ url("/images/product/{$product->id}/images/{$image->path}") }}" class="w100" />
                        </a>
                    @else
                        <video autoplay muted loop class="w100">
                            <source src="{{ url("/images/product/{$product->id}/images/{$image->path}") }}">
                        </video>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-xs-4 col-md-4">
        <div class="product_container">
            <div class="product_wrapper">
                <div class="product-title">{{ $product->name ?? '' }}</div>
                {{--                <div class="product_price">{{ numberFormatPrice($product->price) }} руб.</div>--}}
                @auth
                    <div class="product-price_wrapper">
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
                <div class="product_articul">Артикул: {{ $product->code }}</div>

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active button" id="nav-product-tab" data-toggle="tab"
                           href="#nav-product"
                           role="tab" aria-controls="nav-product" aria-selected="true">Товар</a>
                        <a class="nav-item nav-link button" id="nav-description-tab" data-toggle="tab"
                           href="#nav-description"
                           role="tab" aria-controls="nav-description" aria-selected="false">Описание</a>
                        <a class="nav-item nav-link button" id="nav-contains-tab" data-toggle="tab"
                           href="#nav-contains"
                           role="tab" aria-controls="nav-contains" aria-selected="false">Состав и уход</a>
                        <a class="nav-item nav-link button" id="nav-params-tab" data-toggle="tab"
                           href="#nav-params"
                           role="tab" aria-controls="nav-params" aria-selected="false">Параметры изделия</a>
                        <a class="nav-item nav-link button" id="nav-delivery-tab" data-toggle="tab"
                           href="#nav-delivery"
                           role="tab" aria-controls="nav-delivery" aria-selected="false">Доставка и оплата</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-product" role="tabpanel"
                         aria-labelledby="nav-product-tab">
                        <form action="{{ route('basket-add') }}" method="POST" class="singleproduct-form">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="category_id" value="{{ $category->id }}">
                            <input type="hidden" name="price" value="{{ $product->price_sale ?? $product->price }}">
                            <a href="{{ route('choose-size') }}" class="single_product-choose-size">
                                КАК ВЫБРАТЬ РАЗМЕР (ТАБЛИЦА РАЗМЕРОВ)
                            </a>
                            <div class="single_product-choose-size_wrapper">
                                <div class="single_product-choose-size_title">Выберите размер:</div>
                                <div class="size-wrapper">
                                    @foreach ($product->sizes as $size)
                                        <div class="size-item">
                                            <label for="size_{{ $size->id }}">{{ $size->name }}</label>
                                            <button class="quantity-control button-size" data-action="decrement" data-target="size_{{ $size->id }}">-</button>
                                            <input type="number" class="input-size" required name="size[{{ $size->id }}]" id="size_{{ $size->id }}" min="0" value="0">
                                            <button class="quantity-control button-size" data-action="increment" data-target="size_{{ $size->id }}">+</button>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="single_product-choose-size_title">Выберите цвет:</div>
                                <div class="color-wrapper">
                                    @foreach($product->colors as $color)
                                        <div class="color-checkbox">
                                            <input type="radio" id="color_{{ $color->id }}" required name="color" value="{{ $color->id }}">
                                            <label for="color_{{ $color->id }}">
                                                <span style="background-color: {{ $color->hex_code }};"></span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="product_action">
                                <button class="product_button button">Добавить в корзину</button>
                                <singlefavorite
                                    :product={{ $product->id }}
                                        :favorited={{ $product->favorited() ? 'true' : 'false' }}
                                ></singlefavorite>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-description" role="tabpanel"
                         aria-labelledby="nav-description-tab">
                        {{ $product->description }}
                    </div>
                    <div class="tab-pane fade" id="nav-contains" role="tabpanel"
                         aria-labelledby="nav-contains-tab">
                        {{ $product->care }}
                    </div>
                    <div class="tab-pane fade" id="nav-params" role="tabpanel" aria-labelledby="nav-params-tab">
                        {{ $product->params }}
                    </div>
                    <div class="tab-pane fade" id="nav-delivery" role="tabpanel" aria-labelledby="nav-delivery-tab">
                        {{ $product->delivery }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="similar_wrapper">
        <div class="similar_container">
            <p class="inner_heading">Похожие товары</p>

            <div class="similar_gallery">
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="similar_wrapper">
        <div class="similar_container">
            <p class="inner_heading">Последние модели, которые вы смотрели</p>

            <div class="similar_gallery">
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    <div class="product">
                        <div class="product_top">
                            <p class="product-title"><a href="">Пижама Moomlight</a></p>
                            <p><i class="far fa-heart"></i></p>
                        </div>
                        @auth
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
                        @endauth
                    </div>
                </div>
                <div class="gallery_item">
                    <a href=""><img src="{{ url("/images/similar.png") }}" class="img-fluid img-center"></a>
                    @auth
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
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
