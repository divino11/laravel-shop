@extends('layouts.app')

@section('title', 'Корзина')

@section('content')
    <div class="heading">Корзина</div>

    <table class="table table-basket">
        <thead>
        <tr>
            <td>Товар</td>
            <td>Описание</td>
            <td>Цвет</td>
            <td>Размер</td>
            <td>Рост</td>
            <td>Количество</td>
            <td>Цена</td>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $product)
            <tr>
                <td><a href="{{ route('product', [$product->category->code, $product->id, $product->colors]) }}"><img
                            class="img-size-130"
                            src="{{ url('images/' . $product->image) }}"
                            alt=""></a></td>
                <td>
                    <a href="{{ route('product', [$product->category->code, $product->id, $product->colors]) }}">{{ $product->name }}</a>
                </td>
                <td>{{ $product->colors }}</td>
                <td>
                    XS <br>
                    S <br>
                    M <br>
                    L
                </td>
                <td>165 см</td>
                <td>
                    <minusplusfield
                        :value="{{ $product->getOriginal('pivot_xs') }}"
                        name="sizes[size-xs]"
                    ></minusplusfield>
                    <minusplusfield
                        :value="{{ $product->getOriginal('pivot_s') }}"
                        name="sizes[size-s]"
                    ></minusplusfield>
                    <minusplusfield
                        :value="{{ (int)$product->getOriginal('pivot_m') }}"
                        name="sizes[size-m]"
                    ></minusplusfield>
                    <minusplusfield
                        :value="{{ $product->getOriginal('pivot_l') }}"
                        name="sizes[size-l]"
                    ></minusplusfield>
                </td>
                <td>
                    <div class="basket_actions">
                        <div class="basket_fullprice">
                            {{ sumByCount($product) }} руб.
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
            <td colspan="8" style="text-align: center">Корзина пока что пуста</td>
        @endforelse
        </tbody>
    </table>

    @include('layouts.basket-footer')
@endsection
