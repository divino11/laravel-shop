@extends('layouts.app')

@section('title', 'Товары')

@section('content')
    <div class="col-xs-6 col-md-6">
        <div class='image-hover-zoom' scale="1.5">
            <img src="/images/cardproduct.png" class="w100" alt="">
        </div>
    </div>
    <div class="col-xs-6 col-md-6">
        <form action="{{ route('basket-add', $product->id) }}" method="POST" class="singleproduct-form">
            @method('POST')
            @csrf
            <div class="product_container">
                <div class="product_wrapper">
                    <div class="product-title">{{ $product->name }}</div>
                    <div class="product_price">{{ $product->price }},00 р.</div>
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
                                <input type="radio" name="color" id="red" value="red" />
                                <label for="red"><span class="red"></span></label>

                                <input type="radio" name="color" id="green" />
                                <label for="green"><span class="green"></span></label>

                                <input type="radio" name="color" id="yellow" />
                                <label for="yellow"><span class="yellow"></span></label>

                                <input type="radio" name="color" id="olive" />
                                <label for="olive"><span class="olive"></span></label>

                                <input type="radio" name="color" id="orange" />
                                <label for="orange"><span class="orange"></span></label>

                                <input type="radio" name="color" id="teal" />
                                <label for="teal"><span class="teal"></span></label>

                                <input type="radio" name="color" id="blue" />
                                <label for="blue"><span class="blue"></span></label>

                                <input type="radio" name="color" id="violet" />
                                <label for="violet"><span class="violet"></span></label>

                                <input type="radio" name="color" id="purple" />
                                <label for="purple"><span class="purple"></span></label>

                                <input type="radio" name="color" id="pink" />
                                <label for="pink"><span class="pink"></span></label>
                            </div>
                            <div class="row">
                                <div class="col-6">Размер</div>
                                <div class="col-6">Количество штук</div>
                                <div class="col-6">XS</div>
                                <div class="col-6">
                                    <minusplusfield name="size-xs"></minusplusfield>
                                </div>
                                <div class="col-6">S</div>
                                <div class="col-6">
                                    <minusplusfield name="size-s"></minusplusfield>
                                </div>
                                <div class="col-6">M</div>
                                <div class="col-6">
                                    <minusplusfield name="size-m"></minusplusfield>
                                </div>
                                <div class="col-6">L</div>
                                <div class="col-6">
                                    <minusplusfield name="size-l"></minusplusfield>
                                </div>
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
                <div class="product_action">
                    <button class="product_button button">Добавить в корзину</button>
                    <singlefavorite
                        :product={{ $product->id }}
                        :favorited={{ $product->favorited() ? 'true' : 'false' }}
                    ></singlefavorite>
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
            </div>
        </div>
    </div>
@endsection
