@extends('admin/layout.app')

@section('title', 'Admin Panel')

@section('content')
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Phone</td>
            <td>Price</td>
            <td>Time</td>
            <td>Action</td>
        </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->getFullPrice() }}</td>
                <td>{{ $order->created_at->format('H:i d-m-Y') }}</td>
                <td>

                </td>
            </tr>
        @empty
            <td colspan="6" style="text-align: center">-</td>
        @endforelse
        </tbody>
    </table>
@endsection
