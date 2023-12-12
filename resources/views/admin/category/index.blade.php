@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Категории</h1>

    <a href="/admin/category/create" class="btn btn-success">Создать категорию</a>
@stop

@section('content')
    @if ($errors->any())
        <div class="row col-lg-12">
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                @endforeach
            </div>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>Категория</td>
            <td>Изображение</td>
            <td>Название</td>
            <td>Код</td>
            <td>Описание</td>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td><img src="/images/{{ $value->image }}" class="img-size-xs" alt=""></td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->code }}</td>
                <td>{{ $value->description }}</td>
                <td>
                    <form action="{{ route('category.destroy', $value->id) }}" method="post">
{{--                        <a class="btn btn-small btn-success" href="{{ route('category.show', $value->id) }}">Показать</a>--}}
                        <a class="btn btn-small btn-info" href="{{ route('category.edit', $value->id) }}">Редактировать</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-small btn-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @empty
            <td colspan="6" style="text-align: center">Пока еще нет категорий</td>
        @endforelse
        </tbody>
    </table>

    {!! $categories->links() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
