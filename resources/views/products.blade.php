@extends('layout.app')

@section('title', 'Товары')

@section('content')
    @include('layout.products', ['columns' => 6])
@endsection
