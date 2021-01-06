@extends('layout.app')

@section('title', 'Товары')

@section('content')
    @foreach($products as $product)
        @include('layout.products', ['columns' => 6])
    @endforeach
@endsection
