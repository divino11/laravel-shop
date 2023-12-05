@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Создание категории</h1>
@stop

@section('content')
    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="Название">
        </div>
        <div class="form-group">
            <label for="code">Код</label>
            <input type="text" id="code" class="form-control" name="code" placeholder="Код">
        </div>
        <div class="form-group">
            <label for="description">Изображение</label>
            <input type="file" name="main_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea id="description" class="form-control" name="description" placeholder="Описание"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Создать</button>
        </div>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
