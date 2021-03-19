@extends('app')

@section('title', 'Account')

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Image</td>
            <td>Name</td>
            <td>Count</td>
            <td>Price</td>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->image }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->count }}</td>
                <td>{{ $order->price }}</td>
            </tr>
        @empty
            <td colspan="5" style="text-align: center">-</td>
        @endforelse
        </tbody>
    </table>
@endsection
