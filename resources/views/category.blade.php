@extends('layouts.app')

@section('title', 'Home Page')

@section('categories')
    @include('layouts.categories')
@endsection

@section('content')
    @foreach($category->products as $product)
        @include('layouts.products', ['columns' => 6])
    @endforeach
@endsection
