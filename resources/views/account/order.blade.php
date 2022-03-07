@extends('app-account')

@section('title', 'Account')

@section('content')
    <div class="row">
        <div class="col-md-3">Номер заказа</div>
        <div class="col-md-3">Дата</div>
        <div class="col-md-3">Сумма</div>
        <div class="col-md-3">Статус заказа</div>
        @foreach($orders as $order)
            <details class="col-md-12">
                <summary>
                    <div class="col-md-3">{{ $order->id }}</div>
                    <div class="col-md-3">{{ date('d.m.Y', strtotime($order->created_at)) }}</div>
                    <div class="col-md-3">{{ numberFormatPrice(getTotalSum($order)) }}</div>
                    <div class="col-md-3">{{ $order->status === 1 ? 'Выполнен' : '' }}</div>
                </summary>
                <div class="product__content">
                    <div class="col-md-4">
                        <img src="{{ '/images/' . $order->image }}" alt="{{ $order->name }}">
                    </div>
                    <div class="col-md-4">
                        <div class="product-name">{{ $order->name }}, размер {{ $order->size }}, рост {{ $order->height }}</div>
                        <div class="product-price">{{ numberFormatPrice(getTotalSum($order)) }} руб.</div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-size">размер {{ $order->size }}, рост {{ $order->height }}</div>

                        <div class="product-pdf">пдф 1</div>
                        <div class="product-pdf">пдф 2</div>
                        <div class="product-pdf">пдф 3</div>
                    </div>
                </div>
            </details>
        @endforeach
    </div>
@endsection
