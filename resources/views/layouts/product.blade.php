@extends('app')

@section('title', 'Товары')

@section('content')
    <div class="col-xs-8 col-md-8">
        <img src="/images/cardproduct.png" class="w100" alt="">
        <img src="/images/cardproduct.png" class="w100" alt="">
    </div>
    <div class="col-xs-4 col-md-4">
        <form action="{{ route('basket-add') }}" method="POST" class="singleproduct-form">
            @method('POST')
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="product_container">
                <div class="product_wrapper">
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product_price">{{ numberFormatPrice($product->price) }} руб.</div>
                    <div class="product_articul">Арктикул: 0000000000</div>

                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active button" id="nav-product-tab" data-toggle="tab"
                               href="#nav-product"
                               role="tab" aria-controls="nav-product" aria-selected="true">Товар</a>
                            <a class="nav-item nav-link button" id="nav-parameter-tab" data-toggle="tab"
                               href="#nav-parameter"
                               role="tab" aria-controls="nav-parameter" aria-selected="false">Параметры</a>
                            <a class="nav-item nav-link button" id="nav-description-tab" data-toggle="tab"
                               href="#nav-description"
                               role="tab" aria-controls="nav-description" aria-selected="false">Описание</a>
                            <a class="nav-item nav-link button" id="nav-quality-tab" data-toggle="tab"
                               href="#nav-quality"
                               role="tab" aria-controls="nav-quality" aria-selected="false">Качество и уход</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-product" role="tabpanel"
                             aria-labelledby="nav-product-tab">
                            <div class="single_product-colors">
                                <div class="single_product-colors--title">Цвета:</div>
                                @foreach($productColors as $productColor)
                                    <input
                                        type="radio"
                                        name="color"
                                        id="{{ $productColor->colors }}"
                                        value="{{ $productColor->colors }}"
                                        @if($productColor->colors === $product->colors) checked @endif
                                    />
                                    <label for="{{ $productColor->colors }}">
                                        <a href="{{ route('product', [$product->category->code, $productColor->id, $productColor->colors]) }}">
                                            <span class="{{ $productColor->colors }}"></span>
                                        </a>
                                    </label>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-6">Размер</div>
                                <div class="col-6">Количество штук</div>
                                <div class="col-6">XS</div>
                                <div class="col-6">
                                    <minusplusfield name="sizes[size-xs]"></minusplusfield>
                                </div>
                                <div class="col-6">S</div>
                                <div class="col-6">
                                    <minusplusfield name="sizes[size-s]"></minusplusfield>
                                </div>
                                <div class="col-6">M</div>
                                <div class="col-6">
                                    <minusplusfield name="sizes[size-m]"></minusplusfield>
                                </div>
                                <div class="col-6">L</div>
                                <div class="col-6">
                                    <minusplusfield name="sizes[size-l]"></minusplusfield>
                                </div>
                            </div>
                            <div class="product_action">
                                <button class="product_button button">Добавить в корзину</button>
                                <singlefavorite
                                    :product={{ $product->id }}
                                        :favorited={{ $product->favorited() ? 'true' : 'false' }}
                                ></singlefavorite>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-parameter" role="tabpanel"
                             aria-labelledby="nav-parameter-tab">
                            ...
                        </div>
                        <div class="tab-pane fade" id="nav-description" role="tabpanel"
                             aria-labelledby="nav-description-tab">
                            {{ $product->description }}
                        </div>
                        <div class="tab-pane fade" id="nav-quality" role="tabpanel" aria-labelledby="nav-quality-tab">
                            Состав
                            100% полиестер
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
