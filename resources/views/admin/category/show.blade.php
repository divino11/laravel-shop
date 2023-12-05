@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Категория - {{ $category->name }}</h1>
@stop

@section('content')
    All Product
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
