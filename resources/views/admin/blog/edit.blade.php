@extends('admin.layout.app')

@section('title', 'Редактирование записи - ' . $post->title)

@section('content_header')
    <h1>Редактирование записи - {{ $post->title }}</h1>
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
            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="form-group">
                    <label for="name">Заголовок</label>
                    <input type="text" id="name" class="form-control" value="{{ $post->title }}" name="title"
                           placeholder="Заголовок">
                </div>
                <div class="form-group">
                    <label for="description">Главное изображение</label>
                    <input type="file" name="image" class="form-control">
                    <input type="hidden" value="{{ $post->image }}" name="main_image_hidden">
                    <img src="{{ url('images/' . $post->image) }}" class="img-size-s" alt="">
                </div>
                <div class="form-group">
                    <label for="description">Контент</label>
                    <textarea id="description" class="form-control" name="content"
                              placeholder="Текст">{{ $post->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Статус</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{ $post->status === 1 ? 'selected' : '' }}>Отображать</option>
                        <option value="0" {{ $post->status === 0 ? 'selected' : '' }}>Скрыть</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-info">Изменить</button>
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
@stop
