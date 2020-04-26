@extends('admin/layout.app')

@section('title', 'Create Product')

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
            <textarea id="description" class="form-control" name="description" placeholder="Description"></textarea>
        </div>
        <div class="form-group">
            <label for="count">Count</label>
            <input type="text" id="count" class="form-control" name="count" placeholder="Count">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" class="form-control" name="price" placeholder="Price">
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
@endsection
