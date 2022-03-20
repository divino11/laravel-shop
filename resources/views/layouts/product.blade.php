@extends('app')

@section('title', 'Товары')

@section('content')
    <div class="col-xs-8 col-md-8">
        <img src="/images/cardproduct.png" class="w100" alt="">
        <img src="/images/cardproduct.png" class="w100" alt="">
    </div>
    <div class="col-xs-4 col-md-4">
        <div class="product_container">
            <div class="product_wrapper">
                <div class="product-title">{{ $product->name }}</div>
                {{--                <div class="product_price">{{ numberFormatPrice($product->price) }} руб.</div>--}}
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
                <div class="product_articul">Артикул: 0000000000</div>
                @if (count($ratings) > 0)
                    <div class="product_rating">
                        <div class="rating-stars">
                            <svg
                                class="cursor-pointer block w-8 h-8 @if($ratings->avg('rating') >= 1 ) star-gold @else star-grey @endif "
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <svg
                                class="cursor-pointer block w-8 h-8 @if($ratings->avg('rating') >= 2 ) star-gold @else star-grey @endif "
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <svg
                                class="cursor-pointer block w-8 h-8 @if($ratings->avg('rating') >= 3 ) star-gold @else star-grey @endif "
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <svg
                                class="cursor-pointer block w-8 h-8 @if($ratings->avg('rating') >= 4 ) star-gold @else star-grey @endif "
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                            <svg
                                class="cursor-pointer block w-8 h-8 @if($ratings->avg('rating') >= 5 ) star-gold @else star-grey @endif "
                                fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                        </div>
                        <div class="product-rating_point">{{ $ratings->avg('rating') }} / 5</div>
                    </div>
                @endif

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active button" id="nav-product-tab" data-toggle="tab"
                           href="#nav-product"
                           role="tab" aria-controls="nav-product" aria-selected="true">Выкройка</a>
                        <a class="nav-item nav-link button" id="nav-description-tab" data-toggle="tab"
                           href="#nav-description"
                           role="tab" aria-controls="nav-description" aria-selected="false">Описание</a>
                        <a class="nav-item nav-link button" id="nav-parameter-tab" data-toggle="tab"
                           href="#nav-parameter"
                           role="tab" aria-controls="nav-parameter" aria-selected="false">Рекомендации</a>
                        <a class="nav-item nav-link button" id="nav-review-tab" data-toggle="tab"
                           href="#nav-review"
                           role="tab" aria-controls="nav-review" aria-selected="false">Отзывы</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-product" role="tabpanel"
                         aria-labelledby="nav-product-tab">
                        <form action="{{ route('basket-add') }}" method="POST" class="singleproduct-form">
                            @method('POST')
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="price" value="{{ $product->price_sale ?? $product->price }}">
                            <a href="{{ route('choose-size') }}" class="single_product-choose-size">
                                КАК ВЫБРАТЬ РАЗМЕР (ТАБЛИЦА РАЗМЕРОВ)
                            </a>
                            <div class="single_product-choose-size_wrapper">
                                <div class="single_product-choose-size_form">
                                    <div class="single_product-choose-size_title">Ваш рост:</div>
                                    <div class="single_product-choose-size_select_wrapper">
                                        @foreach(explode( ', ', $product->height) as $height)
                                            <div class="single_product-choose-size_select_item">
                                                <input type="radio" id="single_product-choose_label{{ $height }}"
                                                       value="{{ $height }}"
                                                       name="height" class="single_product-choose-size_select">
                                                <label for="single_product-choose_label{{ $height }}"
                                                       class="single_product-choose_label">{{ $height }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="single_product-choose-size_form">
                                    <div class="single_product-choose-size_title">Ваш размер (европейский):</div>
                                    <div class="single_product-choose-size_select_wrapper">
                                        @foreach(explode( ' / ', $product->size) as $size)
                                            <div class="single_product-choose-size_select_item">
                                                <input type="radio" id="single_product-choose_label{{ $size }}"
                                                       value="{{ $size }}" name="size"
                                                       class="single_product-choose-size_select">
                                                <label for="single_product-choose_label{{ $size }}"
                                                       class="single_product-choose_label">{{ $size }}</label>
                                            </div>
                                        @endforeach
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
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-description" role="tabpanel"
                         aria-labelledby="nav-description-tab">
                        {{ $product->description }}
                    </div>
                    <div class="tab-pane fade" id="nav-parameter" role="tabpanel"
                         aria-labelledby="nav-parameter-tab">
                        ...
                    </div>
                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                        @auth
                            <form action="{{ route('review-add', [Auth::user()->id, $product->id]) }}"
                                  class="rating-form_wrapper" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="flex space-x-1 rating-form">
                                    <input type="radio" id="star1" name="rating" value="1"/>
                                    <label for="star1">
                                        <svg class="cursor-pointer block w-8 h-8 text-grey" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </label>

                                    <input type="radio" id="star2" name="rating" value="2"/>
                                    <label for="star2">
                                        <svg class="cursor-pointer block w-8 h-8 text-grey" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </label>

                                    <input type="radio" id="star3" name="rating" value="3"/>
                                    <label for="star3">
                                        <svg class="cursor-pointer block w-8 h-8 text-grey" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </label>

                                    <input type="radio" id="star4" name="rating" value="4"/>
                                    <label for="star4">
                                        <svg class="cursor-pointer block w-8 h-8 text-grey" fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </label>

                                    <input type="radio" id="star5" name="rating" value="5"/>
                                    <label for="star5">
                                        <svg class="cursor-pointer block w-8 h-8 text-grey " fill="currentColor"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </label>
                                </div>

                                <textarea name="review_text" placeholder="Ваш комментарий" class="form-input" id=""
                                          rows="2"></textarea>
                                <input type="file" name="image[]" multiple>

                                <button class="form-input form-button" type="submit">Оставить отзыв</button>
                            </form>
                        @endauth

                        <div class="rating-wrapper">
                            @foreach($ratings as $rating)
                                <div class="rating-block">
                                    <div class="rating-author">{{ $rating->user->firstname }}</div>
                                    <div class="rating-stars">
                                        <svg
                                            class="cursor-pointer block w-8 h-8 @if($rating->rating >= 1 ) star-gold @else star-grey @endif "
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        <svg
                                            class="cursor-pointer block w-8 h-8 @if($rating->rating >= 2 ) star-gold @else star-grey @endif "
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        <svg
                                            class="cursor-pointer block w-8 h-8 @if($rating->rating >= 3 ) star-gold @else star-grey @endif "
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        <svg
                                            class="cursor-pointer block w-8 h-8 @if($rating->rating >= 4 ) star-gold @else star-grey @endif "
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                        <svg
                                            class="cursor-pointer block w-8 h-8 @if($rating->rating >= 5 ) star-gold @else star-grey @endif "
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    </div>
                                    <div class="review-text">{{ $rating->comment ?? '' }}</div>

                                    <div class="rating-image_wrapper">
                                        @foreach($rating->ratingImage as $image)
                                            <a data-fancybox="gallery{{$rating->id}}"
                                               href="{{ '/images/' . $image->name }}">
                                                <img src="{{ '/images/' . $image->name }}" class="rating-image">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
