@extends('admin.layout.app')

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
                        <label for="name">Наименование</label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Наименование">
                    </div>
                    <div class="form-group">
                        <label for="category">Категория</label>
                        <select name="category_id" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Главное изображение</label>
                        <input type="file" name="main_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea id="description" class="form-control" name="description"
                                  placeholder="Описание"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="height">Рост</label>
                        <input type="text" id="height" class="form-control" name="height" placeholder="Рост напр. 160-162, 164-168 ...">
                    </div>
                    <div class="form-group">
                        <label for="size">Размеры</label>
                        <select name="size[]" multiple="multiple" id="size" class="form-control sizes-select js-example-basic-multiple">
                            @foreach($sizes as $size)
                                <option value="{{ $size->name }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="text" id="price" class="form-control" name="price" placeholder="Цена">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_sale">Цена по скидке</label>
                                <input type="text" id="price_sale" class="form-control" name="price_sale"
                                       placeholder="Цена по скидке">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price_sale_percent">Скидка в (%)</label>
                                <input type="text" id="price_sale_percent" class="form-control"
                                       name="price_sale_percent"
                                       placeholder="Скидка в процентах">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description">Загрузить файл А4</label>
                        <input type="file" name="a4_file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Загрузить файл плоттер</label>
                        <input type="file" name="plotter_file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Загрузить файл с описанием</label>
                        <input type="file" name="description_file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="status">Статус</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Отображать</option>
                            <option value="0">Не отображать</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Добавить</button>
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
