@extends('layouts.app')

@section('title', 'Товары')

@section('content')
    @include('layouts.products', ['columns' => 6])
@endsection
