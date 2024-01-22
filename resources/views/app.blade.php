<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>@yield('title')</title>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <div class="header">
                <a class="logo" href="{{ route('index') }}"><img src="/images/logo.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="menu">
                    <ul>
                        <li><a href="#">Скоро в продаже</a></li>
                        <li><a href="#">Новинки</a></li>
                        <li class="menu_item">
                            <a href="#" class="expand_menu">Каталог</a>
                            <div class="expanded_menu">
                                <div class="expanded_menu-left">
                                    <div class="expanded_menu-title">По категориям</div>
                                    <ul>
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="{{ route('category', ['category' => $category->code]) }}">
                                                    {{ $category->name }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="expanded_menu-right">
                                    <div class="expanded_menu-right&#45;&#45;item">
                                        <a class="" href="{{ route('category', ['category' => 'new-collection']) }}">
                                            <img src="/images/similar.png" class="w-100">
                                            Новая колекция
                                        </a>
                                    </div>
                                    <div class="expanded_menu-right&#45;&#45;item">
                                        <a class="" href="{{ route('category', ['category' => 'popular-products']) }}">
                                            <img src="/images/similar.png" class="w-100">
                                            Популярные товары
                                        </a>
                                    </div>
                                    <div class="expanded_menu-right&#45;&#45;item">
                                        <a class="" href="{{ route('category', ['category' => 'sales']) }}">
                                            <img src="/images/similar.png" class="w-100">
                                            Распродажа
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Сотрудничество</a></li>
                    </ul>
                </div>
                <div class="navigation_right">
                    <div class="navigation_right-item">
                        <form action="{{ route('search') }}">
                            @csrf
                            <searchcomponent></searchcomponent>
                        </form>
                    </div>
                    <div class="navigation_right-item">
                        <a href="@if(\Illuminate\Support\Facades\Auth::check()) {{ route('account') }} @else {{ route('authentication') }} @endif">
                            <i class="fi fi-rr-user"></i>
                        </a>
                        @if(!Auth::check())
                            <div class="expanded_account">
                                @include('parts.auth')
                            </div>
                        @endif
                    </div>
                    <div class="navigation_right-item favorite-badge">
                        @include('parts.badge', ['badgeData' => $favoriteProducts ?? []])
                        <a href="{{ route('favorites') }}">
                            <i class="fi fi-rs-heart"></i>
                        </a>
                    </div>
                    <div class="navigation_right-item">
                        @include('parts.badge', ['badgeData' => $basketProducts ?? []])
                        <a href="{{ route('basket') }}">
                            <i class="fi fi-rs-basket-shopping-simple"></i>
                        </a>
                        <div class="expanded_basket">
                            @include('parts.extend-basket', ['basketProducts' => $basketProducts ?? []])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row main-row">
            <div class="col-md-12">
                <div class="row {{URL::current() === 'http://localhost' ? 'main-section' : ''}}">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
{{--    @include('layouts.footer-social')--}}
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    /*$(document).ready(function() {
        let isHovered = false;

        $('.menu_item').hover(function() {
            isHovered = true;
            $(this).find('.expanded_menu').stop(true, true).css({'display':'flex', 'z-index':999999999}).fadeIn(200);
        });

        $('.expanded_menu').hover(function() {
            isHovered = true;
        }, function() {
            $('.menu_item').find('.expanded_menu').css({'display': 'none'}).fadeOut(200);
        });
    });*/

    @if(Session::has('success'))
        toastr.options =
        {
            "closeButton": true
        }
    toastr.success("{{ session('success') }}");
    @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton": true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton": true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton": true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
</body>
</html>
