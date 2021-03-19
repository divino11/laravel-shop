@if(isset($basketProducts))
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
                                $basketProduct->id,
                                $basketProduct->colors
                            ]) }}">{{ $basketProduct->name }}</a>
                        </div>
                        <div class="extended_basket-item--price">
                            {{ sumByCount($basketProduct) }} руб.
                        </div>
                    </div>
                    <div class="extended_basket-item--sizes">
                        @if($basketProduct->getOriginal('pivot_xs'))
                            <div class="extended_basket-item--size">XS - {{ $basketProduct->getOriginal('pivot_xs') }}
                                шт.
                            </div>
                        @endif
                        @if($basketProduct->getOriginal('pivot_s'))
                            <div class="extended_basket-item--size">S - {{ $basketProduct->getOriginal('pivot_s') }}
                                шт.
                            </div>
                        @endif
                        @if($basketProduct->getOriginal('pivot_m'))
                            <div class="extended_basket-item--size">M - {{ $basketProduct->getOriginal('pivot_m') }}
                                шт.
                            </div>
                        @endif
                        @if($basketProduct->getOriginal('pivot_l'))
                            <div class="extended_basket-item--size">L - {{ $basketProduct->getOriginal('pivot_l') }}
                                шт.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="extended_basket-footer">
        <div class="extended_basket-footer--left">
            <div class="extended_basket-total_price">Всего:</div>
            <div class="extended_basket-delivery">Доставка</div>
        </div>
        <div class="extended_basket-footer--right">
            <div class="extended_basket-total_price">{{ sumByFullPrice($basketProducts) }} руб.</div>
            <div class="extended_basket-delivery">Бесплатная доставка</div>
        </div>
    </div>
    <a class="extended_basket-button button" href="{{ route('basket') }}">Купить</a>
    <div class="extended_basket-fee">Включая НДС Россия</div>
@else
    <div class="extended_basket-empty">Ваша корзина покупок пуста</div>
@endif
