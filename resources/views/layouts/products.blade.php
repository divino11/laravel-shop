<div class="col-xs-12 col-md-{{ $columns }} product-item">
    <a href="{{ route('product', [$product->category->code ?? $product->code, $product->id, $product->colors]) }}"><img
            src="{{ url("/images/$product->image") }}" class="img-fluid img-center"></a>
    <div class="product">
        <div class="product_top">
            <p class="product-title"><a href="">{{ $product->name }}</a></p>
            <favorite
                :product={{ $product->id }}
                :favorited={{ $product->favorited() ? 'true' : 'false' }}
            ></favorite>
        </div>
        <div class="product_bottom">
            <div class="product_price">
                <div class="product_price_main">
                    @if($product->price_sale)
                        <s>
                            {{ $product->price }}р.
                        </s>
                    @else
                        {{ $product->price }}р.
                    @endif
                </div>
                @isset($product->price_sale)
                    <div class="product_price-sale">
                        {{ $product->price_sale }} р.
                    </div>
                @endisset
            </div>
            <div class="sale">
                -{{ $product->price_sale_percent }}%
            </div>
        </div>
    </div>
</div>
