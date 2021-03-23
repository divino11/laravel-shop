@extends('app')

@section('title', 'Страница регистрации')

@section('content')
    <div class="auth_form register_form">
        <div class="inner_heading">Создание аккаунта</div>

        <div class="row">
            <div class="col-md-9">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="contact_form-group">
                        <label for="firstname">Имя:</label>
                        <input required type="text" name="firstname" id="firstname">
                    </div>
                    <div class="contact_form-group">
                        <label for="lastname">Фамилия:</label>
                        <input required type="text" name="lastname" id="lastname">
                    </div>
                    <div class="contact_form-group">
                        <label for="email">E-Mail:</label>
                        <input required type="email" name="email" id="email">
                    </div>
                    <div class="contact_form-group">
                        <label for="password">Пароль:</label>
                        <input required type="password" min="8" name="password" id="password">
                    </div>

                    <div class="auth_form-footer">
                        <button class="button contact_btn">Создать аккаунт</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
