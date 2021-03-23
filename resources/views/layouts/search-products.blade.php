@extends('app')

@section('title', 'Товары')

@section('content')
    @foreach($products as $product)
        @include('parts.products', ['columns' => 4])
    @endforeach
@endsection
