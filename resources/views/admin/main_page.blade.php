@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Редактирование Главной Страницы</h1>
@stop

@section('content')
    <form action="{{ route('updateMainPage') }}" method="POST" class="uploadBanners" enctype="multipart/form-data">
        @csrf
        <div class="form-rows">
            <p>Первый баннер</p>
            @if (Str::endsWith($mainPage->main_banner, '.MP4'))
                <video autoplay="" muted="" playsinline="" loop="" class="main_pages_preview"
                       poster="None">
                    <source src="{{ asset('storage/banners/' . $mainPage->main_banner) }}" type="video/mp4">
                </video>
            @else
                <img src="{{ asset('storage/banners/' . $mainPage->main_banner) }}" class="main_pages_preview">
            @endif
            <input type="file" name="main_banner" value="{{ $mainPage->main_banner }}">
        </div>

        <div class="form-rows">
            <p>Первый баннер мобильный</p>
            @if (Str::endsWith($mainPage->main_banner_mobile, '.MP4'))
                <video autoplay="" muted="" playsinline="" loop="" class="main_pages_preview"
                       poster="None">
                    <source src="{{ asset('storage/banners/' . $mainPage->main_banner_mobile) }}" type="video/mp4">
                </video>
            @else
                <img src="{{ asset('storage/banners/' . $mainPage->main_banner_mobile) }}" class="main_pages_preview">
            @endif
            <input type="file" name="main_banner_mobile" value="{{ $mainPage->main_banner_mobile }}">
        </div>

        <div class="form-rows">
            <p>Второй баннер</p>
            @if (Str::endsWith($mainPage->second_banner, '.MP4'))
                <video autoplay="" muted="" playsinline="" loop="" class="main_pages_preview"
                       poster="None">
                    <source src="{{ asset('storage/banners/' . $mainPage->second_banner) }}" type="video/mp4">
                </video>
            @else
                <img src="{{ asset('storage/banners/' . $mainPage->second_banner) }}" class="main_pages_preview">
            @endif
            <input type="file" name="second_banner" value="{{ $mainPage->second_banner }}">
        </div>

        <div class="form-rows">
            <p>Второй баннер мобильный</p>
            @if (Str::endsWith($mainPage->second_banner_mobile, '.MP4'))
                <video autoplay="" muted="" playsinline="" loop="" class="main_pages_preview"
                       poster="None">
                    <source src="{{ asset('storage/banners/' . $mainPage->second_banner_mobile) }}" type="video/mp4">
                </video>
            @else
                <img src="{{ asset('storage/banners/' . $mainPage->second_banner_mobile) }}" class="main_pages_preview">
            @endif
            <input type="file" name="second_banner_mobile" value="{{ $mainPage->second_banner_mobile }}">
        </div>

        <div class="form-rows">
            <p>Третий баннер</p>
            @if (Str::endsWith($mainPage->third_banner, '.MP4'))
                <video autoplay="" muted="" playsinline="" loop="" class="main_pages_preview"
                       poster="None">
                    <source src="{{ asset('storage/banners/' . $mainPage->third_banner) }}" type="video/mp4">
                </video>
            @else
                <img src="{{ asset('storage/banners/' . $mainPage->third_banner) }}" class="main_pages_preview">
            @endif
            <input type="file" name="third_banner" value="{{ $mainPage->third_banner }}">
        </div>

        <div class="form-rows">
            <p>Третий баннер мобильный</p>
            @if (Str::endsWith($mainPage->third_banner_mobile, '.MP4'))
                <video autoplay="" muted="" playsinline="" loop="" class="main_pages_preview"
                       poster="None">
                    <source src="{{ asset('storage/banners/' . $mainPage->third_banner_mobile) }}" type="video/mp4">
                </video>
            @else
                <img src="{{ asset('storage/banners/' . $mainPage->third_banner_mobile) }}" class="main_pages_preview">
            @endif
            <input type="file" name="third_banner_mobile" value="{{ $mainPage->third_banner_mobile }}">
        </div>

        <button type="submit" class="btn btn-info mb-3">Обновить</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
