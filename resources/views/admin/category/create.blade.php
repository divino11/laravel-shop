@extends('admin/layout.app')

@section('title', 'Create Category')

@section('content')
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
    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" id="code" class="form-control" name="code" placeholder="Code">
        </div>
        <div class="form-group">
            <label for="description">Main image</label>
            <input type="file" name="main_image" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Add</button>
        </div>
    </form>
@endsection
