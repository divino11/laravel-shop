@extends('admin/layout.app')

@section('title', 'Create Product')

@section('content')
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
    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" value="{{ $category->name }}" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" id="code" class="form-control" value="{{ $category->code }}" name="code" placeholder="Code">
        </div>
        <div class="form-group">
            <label for="description">Main image</label>
            <input type="file" name="main_image" class="form-control">
            <img src="{{ url('images/' . $category->image) }}" class="img-size-s" alt="">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" placeholder="Description">{{ $category->description }}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Change</button>
        </div>
    </form>
@endsection
