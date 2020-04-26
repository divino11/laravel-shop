@extends('layout.app')

@section('title', 'Home Page')

@section('categories')
    @include('layout.categories')
@endsection

@section('content')
    @foreach($products as $product)
        @include('layout.products')
    @endforeach
@endsection
