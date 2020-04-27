@extends('layout.app')

@section('title', 'Basket')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <td>Name</td>
            <td>Image</td>
            <td>Count</td>
            <td>Price</td>
            <td>Total</td>
        </tr>
        </thead>
        <tbody>
        @forelse($order->products as $product)
            <tr>
                <td><a href="#">{{ $product->name }}</a></td>
                <td><img style="width: 100px" src="{{ url('images/' . $product->image) }}" alt=""></td>
                <td>
                    <span class="badge">{{ $product->pivot->count }}</span>
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
                <td>{{ $product->price }}</td>
                <td>{{ $product->getPriceByCount() }}</td>
            </tr>
        @empty
            <td colspan="5" style="text-align: center">None of one product in basket not found</td>
        @endforelse
        <tr>
            <td colspan="4">Total price:</td>
            <td>{{ $order->getFullPrice() }}</td>
        </tr>
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        <a href="{{ route('basket-place') }}" class="btn btn-success">Checkout</a>
    </div>
@endsection
