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
                <td><a href="{{ route('product', [$product->category->code, $product->id, $product->colors]) }}"><img class="img-size-xs"
                                                                                                     src="{{ url('images/' . $product->image) }}"
                                                                                                     alt=""></a></td>
                <td><a href="{{ route('product', [$product->category->code, $product->id, $product->colors]) }}">{{ $product->name }}</a>
                </td>
                <td>{{ $product->colors }}</td>
                <td>
                    @if($product->getOriginal('pivot_xs')) XS - {{ $product->getOriginal('pivot_xs') }} шт. <br> @endif
                    @if($product->getOriginal('pivot_s')) S - {{ $product->getOriginal('pivot_s') }} шт. <br> @endif
                    @if($product->getOriginal('pivot_m')) M - {{ $product->getOriginal('pivot_m') }} шт. <br> @endif
                    @if($product->getOriginal('pivot_l')) L - {{ $product->getOriginal('pivot_l') }} шт. @endif
                </td>
                <td>165 см</td>
                <td>
                    <span class="badge">{{ $product->count }}</span>
                    <div class="btn-group form-inline">
                        <form action="{{ route('basket-remove', $product) }}" method="post">
                            @csrf
                            <button class="btn btn-danger" type="submit"><i class="fas fa-minus-circle"></i></button>
                        </form>
                        <form action="{{ route('basket-add', $product) }}" method="post">
                            @csrf
                            <button class="btn btn-success" type="submit"><i class="fas fa-plus-circle"></i></button>
                        </form>
                    </div>
                </td>
                <td>{{ $product->price_sale ? $product->price_sale : $product->price }} руб.</td>
            </tr>
        @empty
            <td colspan="8" style="text-align: center">Корзина пока что пуста</td>
        @endforelse
        </tbody>
    </table>
    {{--        <tr>--}}
    {{--            <td colspan="6">Total price:</td>--}}
    {{--            <td>{{ $order->getFullPrice() }}</td>--}}
    {{--            <td>{{ $product->price }}</td>--}}
    {{--        </tr>--}}

    @include('layouts.basket-footer')
@endsection
