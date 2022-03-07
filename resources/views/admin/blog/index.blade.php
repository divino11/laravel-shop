@extends('admin.layout.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Все записи</h1>
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
            <th>Заголовок</th>
            <th>Контент</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td><img src="/images/{{ $post->image }}" class="img-size-xs" alt=""></td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->status }}</td>
                <td>
                    <form action="{{ route('post.destroy', $post->id) }}" method="post">
                        <a class="btn btn-small btn-info" href="{{ route('post.edit', $post->id) }}">Редактировать</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-small btn-danger" type="submit">Удалить</button>
                    </form>
                </td>
            </tr>
        @empty
            <td colspan="7" style="text-align: center">Пока нет записей</td>
        @endforelse
        </tbody>
    </table>

    {!! $posts->links() !!}
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
