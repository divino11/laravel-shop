@extends('admin/layout.app')

@section('title', 'All Category')

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
            <td>Code</td>
            <td>Description</td>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td><img src="/images/{{ $value->image }}" class="img-size-xs" alt=""></td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->code }}</td>
                <td>{{ $value->description }}</td>
                <td>
                    <form action="{{ route('category.destroy', $value->id) }}" method="post">
                        <a class="btn btn-small btn-success" href="{{ route('category.show', $value->id) }}">Show</a>
                        <a class="btn btn-small btn-info" href="{{ route('category.edit', $value->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-small btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <td colspan="6" style="text-align: center">None of one category not found</td>
        @endforelse
        </tbody>
    </table>

    {!! $categories->links() !!}
@endsection
