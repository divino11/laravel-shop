@extends('layout.app')

@section('title', 'Basket')

@section('categories')
    @include('layout.categories')
@endsection

@section('content')
    <table class="table table-striped table-bordered">
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
                    <div class="badge">{{ $product->count }}</div>
                    <a href="#"><i class="fas fa-minus-circle"></i></a>
                    <form action="{{ route('basket-add', $product) }}" method="post">
                        @csrf
                        <button type="submit"><i class="fas fa-plus-circle"></i></button>
                    </form>
                </td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->price }}</td>
            </tr>
        @empty
            <td colspan="5" style="text-align: center">None of one product in basket not found</td>
        @endforelse
        </tbody>
    </table>
@endsection
