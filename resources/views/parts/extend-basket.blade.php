@if(count($basketProducts) !== 0)
    <div class="extended_basket-inner_heading">Корзина ({{ count($basketProducts) }})</div>

    <div class="extended_basket-items">
        @foreach($basketProducts as $basketProduct)
            <div class="extended_basket-item">
                <img class="extended_basket-item--image img-size-xs" src="{{ url('images/' . $basketProduct->image) }}"
                     alt="">
                <div class="extended_basket-item--description">
                    <div class="extended_basket-item--description_price">
                        <div class="extended_basket-item--title">
                            <a href="{{ route('product', [
                                $basketProduct->category->code,
                                $basketProduct->id
                            ]) }}">{{ $basketProduct->name }}</a>
                        </div>
                        <div class="extended_basket-item--price">
                            @if($basketProduct->price_sale)
                                <span class="red_price">{{ numberFormatPrice(sumByCount($basketProduct, 'priceSale')) }} руб.</span><br>
                            @endif
                            @if($basketProduct->price_sale)
                                <s>{{ numberFormatPrice(sumByCount($basketProduct)) }} руб.</s>
                            @else
                                {{ numberFormatPrice(sumByCount($basketProduct)) }} руб.
                            @endif
                        </div>
                    </div>
                    <div class="extended_basket-item--sizes">
                        @if($basketProduct->getOriginal('pivot_height'))
                            <div class="extended_basket-item--size">Рост: {{ $basketProduct->getOriginal('pivot_height') }}</div>
                        @endif
                        @if($basketProduct->getOriginal('pivot_size'))
                            <div class="extended_basket-item--size">Размер: {{ $basketProduct->getOriginal('pivot_size') }}</div>
                        @endif
                    </div>
                </div>
                <removeorder :product="{{ $basketProduct->id }}"></removeorder>
            </div>
        @endforeach
    </div>

    <div class="extended_basket-footer">
        <div class="extended_basket-footer--left">
            <div class="extended_basket-total_price">Всего:</div>
            <div class="extended_basket-delivery">Доставка</div>
        </div>
        <div class="extended_basket-footer--right">
            <div class="extended_basket-total_price">{{ numberFormatPrice(sumByPriceSale($basketProducts)) }} руб.</div>
            <div class="extended_basket-delivery">Бесплатная доставка</div>
        </div>
    </div>
    <a class="extended_basket-button button" href="{{ route('basket') }}">Купить</a>
    <div class="extended_basket-fee">Включая НДС Россия</div>
@else
    <div class="extended_basket-empty">Ваша корзина покупок пуста</div>
@endif
