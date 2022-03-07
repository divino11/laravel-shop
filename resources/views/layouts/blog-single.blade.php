@extends('app')

@section('title', 'Blog')

@section('content')
    <div class="blog-container">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8 d-flex flex-column justify-content-center align-items-center">
                    <div class="inner_heading">{{ $post->title }}</div>

                    <img src="{{ '/images/' . $post->image }}" class="blog-single_image" alt="{{ $post->title }}">

                    <div class="blog-single_wrapper">
                        {{ $post->content }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
