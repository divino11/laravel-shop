@extends('app')

@section('title', 'Home Page')

@section('content')
    <section class="home-main">
        <a class="home-main__link" href="/collection/journal/REGULARLINE/">

            <div class="home-main__content  home-main__content_left  home-main__content_bottom"></div>
            <img class="home-main__img  d-none d-lg-block"
                 src="https://cdn.namelazz.com/media/cache/c7/b3/c7b3e46c0a5f0374a9f76e76c544472f.jpg" alt="">

            <video autoplay="" muted="" playsinline="" loop="" class="home-main__img  d-md-none" poster="">
                <source src="https://cdn.namelazz.com/media/main/video/IMG_7706.MP4" type="video/mp4">
            </video>

            <div class="home-main__bg" style="background: rgba(0, 0, 0, 0.0);"></div>
        </a>
    </section>
    <section class="home-category">
        <a href="/new/" class="home-category__slide  swiper-slide">
            <div class="home-category__img-box">
                <video autoplay="" muted="" playsinline="" loop="" class="home-main__img  d-none d-md-block"
                       poster="None">
                    <source src="https://cdn.namelazz.com/media/main/video/IMG_7707_stojPRo.MP4" type="video/mp4">
                </video>
                <picture>
                    <source media="(min-width: 768px)" srcset="None">
                    <img class="home-category__img"
                         src="https://cdn.namelazz.com/media/cache/71/31/7131085348f716e29a0edc04e7fac289.jpg" alt="">
                </picture>
                <div class="home-category__bg" style="background: rgba(0, 0, 0, 0.0);"></div>
            </div>
            <div class="home-category__content  home-category__content_left"></div>
        </a>

        <a href="/all/" class="home-category__slide  swiper-slide">
            <div class="home-category__img-box">
                <picture>
                    <source media="(min-width: 768px)"
                            srcset="https://cdn.namelazz.com/media/cache/3e/d8/3ed8e82c5f5991c9b588f9da1c002c59.jpg">
                    <img class="home-category__img"
                         src="https://cdn.namelazz.com/media/cache/06/1f/061f4baecada19534468f13448ac55de.jpg" alt="">
                </picture>
                <div class="home-category__bg" style="background: rgba(0, 0, 0, 0.0);"></div>
            </div>
            <div class="home-category__content  home-category__content_left"></div>
        </a>
    </section>

    <!--    <div class="main_galleries">
            <div class="gallery">
                <img src="images/home1.png" alt="">
            </div>
            <div class="gallery">
                <img src="images/home2.png" alt="">
            </div>
            <div class="gallery">
                <img src="images/home.png" alt="">
            </div>
        </div>

        <p class="heading">Женская</p>

        <div class="showcase">
            <div class="showcase_item">
                <img src="images/home4.png" alt="">
            </div>
            <div class="showcase_item">
                <img src="images/home5.png" alt="">
                <img src="images/home6.png" alt="">
                <img src="images/home7.png" alt="">
            </div>
        </div>

        <p class="heading">Мужская</p>

        <div class="showcase">
            <div class="showcase_item no-margin">
                <img src="images/home18.png" alt="">
            </div>
            <div class="showcase_item">
                <img src="images/home11.png" alt="">
                <img src="images/home12.png" alt="">
                <img src="images/home13.png" alt="">
            </div>
        </div>

        <p class="heading">Для детей</p>

        <div class="showcase">
            <div class="showcase_item no-margin">
                <img src="images/home14.png" alt="">
            </div>
            <div class="showcase_item">
                <img src="images/home15.png" alt="">
                <img src="images/home16.png" alt="">
                <img src="images/home17.png" alt="">
            </div>
        </div>-->
@endsection
