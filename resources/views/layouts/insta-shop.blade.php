@extends('app')

@section('title', 'Home Page')

@section('content')
    <div class="inner_heading">Insta-shop</div>

    <div class="row">
        @foreach(json_decode($posts)->data as $post)
            <div class="col-md-4">
                <img src="{{ $post->user->profile_pic_url }}" alt="">
            </div>
        @endforeach
    </div>
@endsection
