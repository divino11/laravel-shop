@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Редактирование товара - {{ $product->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="name">Наименование</label>
                    <input type="text" id="name" class="form-control" value="{{ $product->name }}" name="name"
                           placeholder="Наименование">
                </div>
                <div class="form-group">
                    <label for="category">Категория</label>
                    <select name="category_id[]" id="category" class="form-control" multiple>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(in_array($category->id, $product->categories()->pluck('category_id')->toArray()))>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Главное изображение</label>
                    <input type="file" name="main_image" class="form-control">
                    <input type="hidden" value="{{ $product->image }}" name="main_image_hidden">
                    <img src="{{ url('images/' . $product->image) }}" class="img-size-s" alt="">
                </div>
                <div class="form-group">
                    <label for="description">Описание</label>
                    <textarea id="description" class="form-control" name="description"
                              placeholder="Описание">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="size">Размеры</label>
                    <select name="size[]" multiple="multiple" id="size"
                            class="form-control sizes-select js-example-basic-multiple">
                        @foreach($sizes as $size)
                            <option value="{{ $size->name }}"
                                    @selected(in_array($size->id, $product->sizes()->pluck('size_id')->toArray()))>{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Цена</label>
                    <input type="text" id="price" class="form-control" value="{{ $product->price }}" name="price"
                           placeholder="Цена">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price_sale">Цена по скидку</label>
                            <input type="text" id="price_sale" value="{{ $product->price_sale }}" class="form-control"
                                   name="price_sale"
                                   placeholder="Цена по скидке">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price_sale_percent">Скидка в (%)</label>
                            <input type="text" id="price_sale_percent" value="{{ $product->price_sale_percent }}"
                                   class="form-control" name="price_sale_percent"
                                   placeholder="Скидка в процентах">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Загрузить файл А4</label>
                    <input type="hidden" value="{{ $product->a4_file }}" name="a4_file_hidden">
                    <input type="file" name="a4_file" class="form-control">
                    @if($product->a4_file)
                        <div class="pdf-uploaded">
                            <div class="pdf-uploaded_text">Посмотреть загруженный файл</div>
                            <a href="{{ '/files/' . $product->a4_file }}" target="_blank"><img
                                    src="/images/pdf-image.png"
                                    class="pdf-image_admin"
                                    alt="{{ $product->a4_file }}"></a>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Загрузить файл плоттер</label>
                    <input type="hidden" value="{{ $product->plotter_file }}" name="plotter_file_hidden">
                    <input type="file" name="plotter_file" class="form-control">
                    @if($product->plotter_file)
                        <div class="pdf-uploaded">
                            <div class="pdf-uploaded_text">Посмотреть загруженный файл</div>
                            <a href="{{ '/files/' . $product->plotter_file }}" target="_blank"><img
                                    src="/images/pdf-image.png"
                                    class="pdf-image_admin"
                                    alt="{{ $product->plotter_file }}"></a>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Загрузить файл с описанием</label>
                    <input type="hidden" value="{{ $product->description_file }}" name="description_file_hidden">
                    <input type="file" name="description_file" class="form-control">
                    @if($product->description_file)
                        <div class="pdf-uploaded">
                            <div class="pdf-uploaded_text">Посмотреть загруженный файл</div>
                            <a href="{{ '/files/' . $product->description_file }}" target="_blank"><img
                                    src="/images/pdf-image.png"
                                    class="pdf-image_admin"
                                    alt="{{ $product->description_file }}"></a>
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="status">Статус</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $product->status === 1 ? 'selected' : '' }}>Отображать</option>
                        <option value="0" {{ $product->status === 0 ? 'selected' : '' }}>Не отображать</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Изменить</button>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="/js/app.js"></script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@stop
