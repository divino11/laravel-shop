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
                    <div class="col-md-3">{{ $order->order_id }}</div>
                    <div class="col-md-3">{{ date('d.m.Y', strtotime($order->created_at)) }}</div>
                    <div class="col-md-3">{{ numberFormatPrice(getTotalSum($order)) }}</div>
                    <div class="col-md-3">{{ $order->status === 1 ? 'Выполнен' : '' }}</div>
                </summary>
                <div class="product__content">
                    <div class="col-md-4">
                        <img src="{{ '/images/' . $order->image }}" alt="{{ $order->name }}">
                    </div>
                    <div class="col-md-4">
                        <div class="product-name">{{ $order->name }}, размер {{ $order->order_size }},
                            рост {{ $order->order_height }}</div>
                        <div class="product-price">{{ numberFormatPrice(getTotalSum($order)) }} руб.</div>
                    </div>
                    <div class="col-md-4">
                        <div class="product-size">размер {{ $order->order_size }}, рост {{ $order->order_height }}</div>

                        @if ($order->a4_file)
                            <div class="product-pdf">
                                <a href="{{ '/files/' . $order->a4_file }}"><img src="/images/pdf-image.png" class="pdf-image_admin" alt="{{ $order->a4_file }}"> Скачать А4 верх</a>
                            </div>
                        @endif

                        @if ($order->plotter_file)
                            <div class="product-pdf">
                                <a href="{{ '/files/' . $order->plotter_file }}"><img src="/images/pdf-image.png" class="pdf-image_admin" alt="{{ $order->plotter_file }}"> Скачать плоттер верх</a>
                            </div>
                        @endif

                        @if ($order->description_file)
                            <div class="product-pdf">
                                <a href="{{ '/files/' . $order->description_file }}"><img src="/images/pdf-image.png" class="pdf-image_admin" alt="{{ $order->description_file }}"> Скачать описание</a>
                            </div>
                        @endif
                    </div>
                </div>
            </details>
        @endforeach
    </div>
@endsection
