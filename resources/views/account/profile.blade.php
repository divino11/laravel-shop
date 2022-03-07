@extends('app-account')

@section('title', 'Account')

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>№</td>
            <td>Изображение</td>
            <td>Название</td>
            <td>Рост</td>
            <td>Размер</td>
            <td>Цена</td>
            <td>Статус</td>
            <td>Действия</td>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->image }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->height }}</td>
                <td>{{ $order->size }}</td>
                <td>{{ numberFormatPrice(getTotalSum($order)) }}</td>
                <td>{{ $order->status === 1 ? 'Новый заказ' : '' }}</td>
                <td></td>
            </tr>
        @empty
            <td colspan="8" style="text-align: center">-</td>
        @endforelse
        </tbody>
    </table>
@endsection
