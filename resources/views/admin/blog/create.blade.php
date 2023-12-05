@extends('adminlte::page')

@section('title', 'Блог - Создание записи')

@section('content_header')
    <h1>Создание записи</h1>
@stop

@section('content')
    <div id="app">
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('blog.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Заголовок</label>
                        <input type="text" id="name" class="form-control" name="title" placeholder="Заголовок">
                    </div>
                    <div class="form-group">
                        <label for="description">Главное изображение</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editor">Контент</label>
                        <textarea id="editor" class="form-control" name="content"
                                  placeholder="Текст"></textarea>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '/admin/blog/upload-image' // Replace this with your upload endpoint
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@stop
