@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Все товары</h1>

    <a href="/admin/products/create" class="btn btn-success">Создать товар</a>
@stop

@section('content')
    <table class="table table-striped table-bordered" id="product-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Изображение</th>
            <th>Наименование</th>
            <th>Описание</th>
            <th>Кол-во</th>
            <th>Цена</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><img src="/images/product/{{ $product->id }}/main/{{ $product->image }}" class="img-size-xs" alt=""></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->count }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        <a class="btn btn-small btn-info" href="{{ route('products.edit', $product->id) }}">Редактировать</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-small btn-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @empty
            <td colspan="7" style="text-align: center">Товаров пока еще нет</td>
        @endforelse
        </tbody>
    </table>

    {!! $products->links() !!}
@stop

@section('css')
    <link rel="stylesheet" href="/css/libraries/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="/js/libraries/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#product-table').DataTable();
        });
    </script>
@stop
