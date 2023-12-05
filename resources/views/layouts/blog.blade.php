@extends('app')

@section('title', 'Blog')

@section('content')
    <div class="blog-container">
        <div class="inner_heading">Блог</div>

        <div class="blog-wrapper">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="blog-item" style="background: url('{{ asset('storage/posts/' . $post->image) }}') no-repeat content-box">
                            <div class="blog-item_overlay"></div>
                            <div class="blog-item_title">{{ $post->title }}</div>
                            <a href="{{ route('blog-read', [$post->slug]) }}" class="blog-item_button">Подробнее</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
