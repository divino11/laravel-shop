@extends('app')

@section('title', 'Home Page')

@section('categories')
    @include('parts.categories')
@endsection

@section('content')
    @foreach($category->products as $product)
        @include('parts.products', ['columns' => 4])
    @endforeach
@endsection
