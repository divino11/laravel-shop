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
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <div class="header">
            <a class="logo" href="{{ route('index') }}"><img src="/images/logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="menu">
                <ul>
                    <li><a href="#">Женское</a></li>
                    <li><a href="#">Мужское</a></li>
                    <li><a href="#">Детское</a></li>
                    <li><a href="#">Аксессуары</a></li>
                    <li><a href="#">Sale</a></li>
                </ul>
            </div>
            <div class="navigation_right">
                <div class="navigation_right-item">
                    <a href=""><i class="fas fa-search"></i></a>
                </div>
                <div class="navigation_right-item">
                    <a href=""><i class="far fa-user"></i></a>
                </div>
                <div class="navigation_right-item">
                    <a href=""><i class="far fa-heart"></i></a>
                </div>
                <div class="navigation_right-item">
                    <a href="{{ route('basket') }}"><i class="fas fa-shopping-bag"></i></a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row">
                @if(session()->has('success'))
                    <p class="alert alert-success text-center w100">{{ session()->get('success') }}</p>
                @elseif (session()->has('warning'))
                    <p class="alert alert-warning text-center w100">{{ session()->get('warning') }}</p>
                @endif

                @yield('content')

                <div class="footer">
                    <div class="footer_item">
                        <p class="footer_item-heading">О компании</p>

                        <ul class="footer_item-list">
                            <li><a href="">О компании</a></li>
                            <li><a href="">Публичная оферта</a></li>
                            <li><a href="">Конфеденциальность</a></li>
                            <li><a href="">#INSTA SHOP</a></li>
                            <li><a href="">Пресса</a></li>
                            <li><a href="">Блог</a></li>
                        </ul>
                    </div>

                    <div class="footer_item">
                        <p class="footer_item-heading">Помощь</p>

                        <ul class="footer_item-list">
                            <li><a href="">Часто задаваемые вопросы</a></li>
                            <li><a href="">Карта сайта</a></li>
                            <li><a href="">Подарочный сертификат</a></li>
                            <li><a href="">VIP карта</a></li>
                            <li><a href="">Контакты</a></li>
                        </ul>
                    </div>

                    <div class="footer_item">
                        <p class="footer_item-heading">Сотрудничество</p>

                        <ul class="footer_item-list">
                            <li><a href="">Униформа</a></li>
                            <li><a href="">Для отелей</a></li>
                            <li><a href="">Реквизиты</a></li>
                            <li><a href="">Сотрудничество (ОПТ)</a></li>
                        </ul>
                    </div>

                    <div class="footer_item">
                        <p class="footer_item-heading">Доставка и возврат</p>

                        <ul class="footer_item-list">
                            <li><a href="">Как сделать заказ</a></li>
                            <li><a href="">Информация о доставке</a></li>
                            <li><a href="">Отслеживания заказа</a></li>
                            <li><a href="">Правила возврата</a></li>
                        </ul>
                    </div>

                    <div class="footer_item">
                        <form action="">
                            <input type="email" name="email" placeholder="Ваш Email">
                            <button>></button>
                        </form>

                        <p class="footer_item-subheading">Вы принимаете "Политику конфиденциальность"</p>

                        <p class="footer_item-subheading">Подпишитесь на рассылку, чтобы узнавать о
                            новых поступлениях, открытии новых
                            магазинов, акциях и скидках.</p>

                        <p class="footer_item-subheading">8-800-000-00-00 9.00-21.00</p>

                        <p class="footer_item-subheading">info@....ru</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer_social">
    <div class="container">
        <ul class="footer_social-list">
            <li><a href=""><i class="fab fa-vk"></i></a></li>
            <li><a href=""><i class="fab fa-instagram"></i></a></li>
            <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
            <li><a href=""><i class="fab fa-youtube"></i></a></li>
            <li><a href=""><i class="fab fa-pinterest-p"></i></a></li>
            <li><a href=""><i class="fab fa-telegram-plane"></i></a></li>
            <li><a href=""><i class="fab fa-viber"></i></a></li>
            <li><a href=""><i class="fab fa-whatsapp"></i></a></li>
        </ul>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="/js/app.js"></script>
</body>
</html>
