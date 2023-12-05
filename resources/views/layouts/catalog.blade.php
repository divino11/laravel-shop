@extends('app')

@section('title', 'Каталог')

@section('content')
    @if(count($products) !== 0)
        @foreach($products as $product)
            @include('parts.products', ['columns' => 3])
        @endforeach
    @endif
@endsection
