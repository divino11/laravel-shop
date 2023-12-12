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
                    <div class="col-md-3">{{ numberFormatPrice($order->price) }}</div>
                    <div class="col-md-3">{{ $order->status === 1 ? 'Выполнен' : 'В процессе' }}</div>
                </summary>
                @foreach($order->orderProducts as $orderProduct)
                    <div class="product__content">
                        <div class="col-md-4">
                            <img src="{{ "/images/product/{$orderProduct->product->id}/main/" . $orderProduct->product->image }}"
                                 alt="{{ $orderProduct->product->name }}">
                        </div>
                        <div class="col-md-4">
                            <div class="product-name">{{ $orderProduct->product->name }}, размер <span
                                    style="text-transform: uppercase">{{ \App\Size::find($orderProduct->order_size)->name }}</span>,
                                цвет {{ \App\Color::find($orderProduct->order_color)->name }}, количество
                                - {{ $orderProduct->quantity }}</div>
                            <div class="product-price">{{ numberFormatPrice(getTotalSum($orderProduct)) }} руб.</div>
                        </div>
                        <div class="col-md-4">
                            <div class="product-size">размер <span
                                    style="text-transform: uppercase">{{ \App\Size::find($orderProduct->order_size)->name }}</span>,
                                цвет {{ \App\Color::find($orderProduct->order_color)->name }}</div>

                            @if ($orderProduct->a4_file)
                                <div class="product-pdf">
                                    <a href="{{ '/files/' . $orderProduct->a4_file }}"><img src="/images/pdf-image.png"
                                                                                            class="pdf-image_admin"
                                                                                            alt="{{ $orderProduct->a4_file }}">
                                        Скачать А4 верх</a>
                                </div>
                            @endif

                            @if ($orderProduct->plotter_file)
                                <div class="product-pdf">
                                    <a href="{{ '/files/' . $orderProduct->plotter_file }}"><img
                                            src="/images/pdf-image.png"
                                            class="pdf-image_admin"
                                            alt="{{ $orderProduct->plotter_file }}">
                                        Скачать плоттер верх</a>
                                </div>
                            @endif

                            @if ($orderProduct->description_file)
                                <div class="product-pdf">
                                    <a href="{{ '/files/' . $orderProduct->description_file }}"><img
                                            src="/images/pdf-image.png" class="pdf-image_admin"
                                            alt="{{ $orderProduct->description_file }}"> Скачать описание</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </details>
        @endforeach
    </div>
@endsection
