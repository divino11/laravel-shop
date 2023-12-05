@extends('app-account')

@section('title', 'Избранные товары')

@section('content')
    @if(count($products) !== 0)
        @foreach($products as $product)
            @include('parts.favorite_products', ['columns' => 4])
        @endforeach
    @endif
@endsection
