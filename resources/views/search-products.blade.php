@extends('layouts.app')

@section('title', 'Товары')

@section('content')
    @foreach($products as $product)
        @include('layouts.products', ['columns' => 6])
    @endforeach
@endsection
