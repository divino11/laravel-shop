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
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" class="form-control" value="{{ $product->name }}" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="description">Main image</label>
            <input type="file" name="main_image" class="form-control">
            <img src="{{ url('images/' . $product->image) }}" class="img-size-s" alt="">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" class="form-control" name="description" placeholder="Description">{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="count">Count</label>
            <input type="text" id="count" class="form-control" value="{{ $product->count }}" name="count" placeholder="Count">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" class="form-control" value="{{ $product->price }}" name="price" placeholder="Price">
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
@endsection
