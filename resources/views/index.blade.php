@extends('app')

@section('title', 'Home Page')

@section('content')
    <div class="main_galleries">
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
    </div>
@endsection
