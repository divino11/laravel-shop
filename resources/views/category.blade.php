@extends('layout.app')

@section('title', 'Home Page')

@section('categories')
    @include('layout.categories')
@endsection

@section('content')
    @foreach($category->products as $product)
        @include('layout.products', ['columns' => 6])
    @endforeach
@endsection
