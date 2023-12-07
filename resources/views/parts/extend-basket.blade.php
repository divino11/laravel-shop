@php use App\Category; @endphp
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
                                Category::find($basketProduct->getOriginal('pivot_category_id'))->code,
                                $basketProduct->id
                            ]) }}">{{ $basketProduct->name }}</a>
                        </div>
                        @auth
                            <div class="extended_basket-item--price">
                                @if($basketProduct->price_sale)
                                    <span class="red_price">{{ numberFormatPrice(sumByCount($basketProduct, 'priceSale')) }} руб.</span>
                                    <br>
                                @endif
                                @if($basketProduct->price_sale)
                                    <s>{{ numberFormatPrice(sumByCount($basketProduct)) }} руб.</s>
                                @else
                                    {{ numberFormatPrice(sumByCount($basketProduct)) }} руб.
                                @endif
                            </div>
                        @endauth
                    </div>
                    <div class="extended_basket-item--sizes">
                        @if($basketProduct->getOriginal('pivot_order_size'))
                            <div class="extended_basket-item--size" style="text-transform: uppercase;">
                                Размер: {{ \App\Size::find($basketProduct->getOriginal('pivot_order_size'))->name }}</div>
                        @endif
                        @if($basketProduct->getOriginal('pivot_quantity'))
                            <div class="extended_basket-item--size">
                                Количество: {{ $basketProduct->getOriginal('pivot_quantity') }}</div>
                        @endif
                        @if($basketProduct->getOriginal('pivot_order_color'))
                            <div class="extended_basket-item--size">
                                Цвет: {{ \App\Color::find($basketProduct->getOriginal('pivot_order_color'))->name }}</div>
                        @endif
                    </div>
                </div>
                <removeorder :product="{{ $basketProduct->getOriginal('pivot_id') }}"></removeorder>
            </div>
        @endforeach
    </div>

    <div class="extended_basket-footer">
        <div class="extended_basket-footer--left">
            @auth
                <div class="extended_basket-total_price">Всего:</div>
            @endauth
            <div class="extended_basket-delivery">Доставка</div>
        </div>
        <div class="extended_basket-footer--right">
            @auth
                <div class="extended_basket-total_price">{{ numberFormatPrice(sumByPriceSale($basketProducts)) }} руб.</div>
            @endauth
            <div class="extended_basket-delivery">Бесплатная доставка</div>
        </div>
    </div>
    <a class="extended_basket-button button" href="{{ route('basket') }}">Купить</a>
    <div class="extended_basket-fee">Включая НДС Россия</div>
@else
    <div class="extended_basket-empty">Ваша корзина покупок пуста</div>
@endif
