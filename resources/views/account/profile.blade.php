@extends('app-account')

@section('title', 'Account')

@section('content')
    <div class="container-fluid profile-page">
        <div class="heading">Мои данные</div>

        <form action="{{ route('updateProfile') }}" method="POST" class="place_order">
            @csrf
            @method('POST')
            <div class="group_items">
                <div class="inner_heading">Личная информация</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->firstname ?: '' }}" name="firstname"
                                   required="required"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Имя</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->middle_name ?: '' }}" name="middle_name"/>
                            <span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Отчество</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->lastname ?: '' }}" name="lastname" required="required"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Фамилия</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="group">
                            <input type="text"
                                   value="{{ $user->birthday ?: '' }}"
                                   id="datepicker"
                                   name="birthday"
                                   autocomplete="off"
                                   class="datepicker-input"
                                   placeholder="Дата рождения"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <select name="sex" id="sex">
                                <option value="Мужской" @selected($user->sex === 'Мужской')>Мужской</option>
                                <option value="Женский" @selected($user->sex === 'Женский')>Женский</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->city ?: '' }}" name="city"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Город</label>
                        </div>
                    </div>
                </div>
                <div class="inner_heading">Контакты</div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->email ?: '' }}" name="email" required="required"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Email</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->phone ?: '' }}" name="phone"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Телефон</label>
                        </div>
                    </div>
                </div>

                <div class="group button_box" style="justify-content: flex-start">
                    <button class="button">Сохранить</button>
                </div>
            </div>
        </form>

        <div class="heading">Адрес доставки</div>

        <form action="{{ route('updateProfileAddress') }}" method="POST" class="place_order">
            @csrf
            @method('POST')
            <div class="group_items">
                <div class="row">
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->address?->city ?: '' }}" required name="city"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Город *</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->address?->street ?: '' }}" required name="street"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Улица *</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->address?->house ?: '' }}" required name="house"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Дом *</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->address?->corpus ?: '' }}" name="corpus"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Корпус</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->address?->stroenie ?: '' }}" name="stroenie"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Строение</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->address?->podiezd ?: '' }}" name="podiezd"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Подьезд</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->address?->floor ?: '' }}" name="floor"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Этаж</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="group">
                            <input type="text" value="{{ $user->address?->apartment ?: '' }}" name="apartment"/><span
                                class="highlight"></span><span
                                class="bar"></span>
                            <label>Квартира</label>
                        </div>
                    </div>
                </div>

                <div class="group button_box" style="justify-content: flex-start">
                    <button class="button">Сохранить</button>
                </div>
            </div>
        </form>
    </div>

    @section('additional_scripts')
        <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
        <script src="https://unpkg.com/gijgo@1.9.14/js/messages/messages.ru-ru.js" type="text/javascript"></script>
        <script>
            $('#datepicker').datepicker({
                uiLibrary: 'bootstrap4',
                locale: 'ru-ru',
                format: 'dd.mm.yyyy',
            });
        </script>
    @endsection
@endsection
