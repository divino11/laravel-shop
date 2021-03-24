@extends('app')

@section('title', 'Спасибо за регистрацию')

@section('content')
    <div class="register_background">
        <div class="register_success">
            <div class="inner_heading">Спасибо за регистрацию</div>
            <div>
                Вы успешно зарегистрировались на сайте... <br>Для авторизации
                в личном кабинете перейдите по ссылке ниже<br>или через иконку «Личного кабинета».
            </div>
            <a class="button" href="{{ route('authentication') }}">Войти</a>
        </div>
    </div>
@endsection
