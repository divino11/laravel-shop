<div class="col-xs-12 col-md-{{ $columns }} product-item">
    <a href="{{ route('product', [$category->code, $item->product->id]) }}"><img
            src="{{ url("/images/product/{$item->product->id}/main/{$item->product->image}") }}" class="img-fluid img-center"></a>
    <div class="product">
        <div class="product_top">
            <p class="product-title"><a href="{{ route('product', [$category->code, $item->product->id]) }}">{{ $item->product->name }}</a></p>
            <favorite
                :product={{ $item->product->id }}
                :favorited={{ $item->product->favorited() ? 'true' : 'false' }}
            ></favorite>
        </div>
        @auth
            <div class="product_bottom">
                <div class="product_price">
                    @isset($item->product->price_sale)
                        <div class="product_price-sale">
                            {{ numberFormatPrice($item->product->price_sale) }} руб.
                        </div>
                    @endisset
                    <div class="product_price_main">
                        @if($item->product->price_sale)
                            <s>
                                {{ numberFormatPrice($item->product->price) }} руб.
                            </s>
                        @else
                            {{ numberFormatPrice($item->product->price) }} руб.
                        @endif
                    </div>
                </div>
                <div class="sale">
                    @isset($item->product->price_sale)
                        -{{ $item->product->price_sale_percent }}%
                    @endif
                </div>
            </div>
        @endauth
    </div>
</div>
