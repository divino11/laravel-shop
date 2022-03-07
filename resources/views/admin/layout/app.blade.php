<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/app.css">

    <title>@yield('title')</title>
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
                            <li class="nav-item">
                                <a
                                    class="nav-link nav-link-collapse"
                                    href="#"
                                    id="hasSubItems"
                                    data-toggle="collapse"
                                    data-target="#collapseSubItems2"
                                    aria-controls="collapseSubItems2"
                                    aria-expanded="false"
                                >Товары</a>
                                <ul class="nav-second-level collapse" id="collapseSubItems2"
                                    data-parent="#navAccordion">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('products.index') }}">
                                            <span class="nav-link-text">Все товары</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('products.create') }}">
                                            <span class="nav-link-text">Добавить товар</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link nav-link-collapse"
                                    href="#"
                                    id="hasSubItems"
                                    data-toggle="collapse"
                                    data-target="#collapseSubItems3"
                                    aria-controls="collapseSubItems3"
                                    aria-expanded="false"
                                >Категории</a>
                                <ul class="nav-second-level collapse" id="collapseSubItems3"
                                    data-parent="#navAccordion">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category.index') }}">
                                            <span class="nav-link-text">Все категории</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('category.create') }}">
                                            <span class="nav-link-text">Добавить категорию</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a
                                    class="nav-link nav-link-collapse"
                                    href="#"
                                    id="hasSubItems"
                                    data-toggle="collapse"
                                    data-target="#collapseSubItems4"
                                    aria-controls="collapseSubItems4"
                                    aria-expanded="false"
                                >Блог</a>
                                <ul class="nav-second-level collapse" id="collapseSubItems4"
                                    data-parent="#navAccordion">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('post.index') }}">
                                            <span class="nav-link-text">Все записи</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('post.create') }}">
                                            <span class="nav-link-text">Добавить запись</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="col-10">
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://use.fontawesome.com/8019868c42.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
