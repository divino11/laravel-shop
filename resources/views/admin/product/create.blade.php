@extends('adminlte::page')

@section('title', 'Создание товара')

@section('content_header')
    <h1>Создание товара</h1>
@stop

@section('content')
    <div id="app">
        <div class="row">
            <div class="col-md-6">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Main image</label>
                        <input type="file" name="main_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description"
                                  placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="size">Размеры</label>
                        <div class="size-group">
                            {{--<div class="size-group_item">
                                <input type="text" id="size_name" class="form-control" name="size_name[]"
                                       placeholder="Название размера">
                                <input type="text" id="size_count" class="form-control" name="size_count[]"
                                       placeholder="Количество">
                            </div>--}}
                            <productattribute></productattribute>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" id="price" class="form-control" name="price" placeholder="Price">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_sale">Sale price</label>
                                <input type="text" id="price_sale" class="form-control" name="price_sale"
                                       placeholder="Sale Price">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_sale_percent">Sale price (%)</label>
                                <input type="text" id="price_sale_percent" class="form-control"
                                       name="price_sale_percent"
                                       placeholder="Sale Price Percent">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Available</option>
                            <option value="0">Not available</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/js/app.js"></script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@stop
