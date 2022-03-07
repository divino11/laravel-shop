@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Все товары</h1>
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
                <td><img src="/images/{{ $product->image }}" class="img-size-xs" alt=""></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->count }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        <a class="btn btn-small btn-info" href="{{ route('products.edit', $product->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-small btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <td colspan="7" style="text-align: center">None of one product not found</td>
        @endforelse
        </tbody>
    </table>

    {!! $products->links() !!}
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script src="/js/app.js"></script>

    <script>
        $(document).ready(function () {
            $('#product-table').DataTable();
        });
    </script>
@stop
