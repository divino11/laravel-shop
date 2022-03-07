@extends('admin.layout.app')

@section('title', 'Редактирование товара - ' . $product->name)

@section('content_header')
    <h1>Редактирование товара - {{ $product->name }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            @if ($message = Session::get('error'))
                <div class="alert alert-warning">
                    <p>{{ $message }}</p>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" class="form-control" value="{{ $product->name }}" name="name"
                           placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if($category->id === $product->category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Main image</label>
                    <input type="file" name="main_image" class="form-control">
                    <input type="hidden" value="{{ $product->image }}" name="main_image_hidden">
                    <img src="{{ url('images/' . $product->image) }}" class="img-size-s" alt="">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" class="form-control" name="description"
                              placeholder="Description">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="size">Размеры</label>
                    <div class="size-group">
                        @foreach($productSizes as $size)
                        <div class="size-group_item">
                            <input type="text" id="size_name" value="{{ $size->type }}" class="form-control" name="size_name[]"
                                   placeholder="Название размера">
                            <input type="text" id="size_count" value="{{ $size->count }}" class="form-control" name="size_count[]"
                                   placeholder="Количество">
                            <select name="size_colors[]" class="js-example-basic-multiple" multiple="multiple">
                                <option value="red">Красный</option>
                                <option value="pink">Розовый</option>
                                <option value="blue">Синий</option>
                                <option value="green">Зеленый</option>
                                <option value="white">Белый</option>
                                <option value="black">Черный</option>
                            </select>
                        </div>
                        @endforeach
                    </div>
                    <button id="removeSize" type="button"><i class="fas fa-trash"></i></button>
                    <button id="addNewSize" type="button"><i class="fas fa-plus"></i></button>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" id="price" class="form-control" value="{{ $product->price }}" name="price"
                           placeholder="Price">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price_sale">Sale price</label>
                            <input type="text" id="price_sale" value="{{ $product->price_sale }}" class="form-control" name="price_sale"
                                   placeholder="Sale Price">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price_sale_percent">Sale price (%)</label>
                            <input type="text" id="price_sale_percent" value="{{ $product->price_sale_percent }}" class="form-control" name="price_sale_percent"
                                   placeholder="Sale Price Percent">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $product->status === 1 ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ $product->status === 0 ? 'selected' : '' }}>Not available</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Change</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/app.css">
@stop

@section('js')
    <script src="/js/app.js"></script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@stop
