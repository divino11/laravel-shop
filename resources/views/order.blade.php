@extends('layout.app')

@section('title', 'Order Page')

@section('content')
    <div class="col-12">
        <p>Total price: {{ $order->getFullPrice() }}</p>
    </div>
    <div class="col-12">
        <form action="{{ route('basket-confirm') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" class="form-control" name="phone" placeholder="Phone">
            </div>
            <button type="submit" class="btn btn-success">Order</button>
        </form>
    </div>
@endsection
