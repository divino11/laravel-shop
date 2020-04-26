@extends('admin/layout.app')

@section('title', 'All Product')

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
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Image</td>
            <td>Name</td>
            <td>Description</td>
            <td>Count</td>
            <td>Price</td>
            <td>Status</td>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->image }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->description }}</td>
                <td>{{ $value->count }}</td>
                <td>{{ $value->price }}</td>
                <td>{{ $value->status === 1 ? 'Available' : 'Not available' }}</td>
                <td>
                    <form action="{{ route('products.destroy', $value->id) }}" method="post">
                        <a class="btn btn-small btn-success" href="{{ route('products.show', $value->id) }}">Show</a>
                        <a class="btn btn-small btn-info" href="{{ route('products.edit', $value->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-small btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <td colspan="7" style="text-align: center">None of one product not found</td>
        @endforelse
        </tbody>
    </table>

    {!! $products->links() !!}
@endsection
