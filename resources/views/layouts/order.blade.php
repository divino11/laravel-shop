@extends('app')

@section('title', 'Order Page')

@section('content')
    <div class="heading">Оформление заказа</div>
    <form action="{{ route('basket-confirm') }}" method="POST" class="place_order">
        @csrf
        @method('POST')
        <div class="group_items">
            <div class="inner_heading">Информация о покупателе</div>

            <div class="group">
                <input type="text" value="{{ $user->firstname ? $user->firstname : '' }}" name="lastname" required="required"/><span class="highlight"></span><span
                    class="bar"></span>
                <label>Фамилия *</label>
            </div>
            <div class="group">
                <input type="text" value="{{ $user->lastname ? $user->lastname : '' }}" name="firstname" required="required"/><span class="highlight"></span><span
                    class="bar"></span>
                <label>Имя *</label>
            </div>
            <div class="group">
                <input type="tel" value="{{ $user->phone ? $user->phone : '' }}" name="phone" required="required"/><span class="highlight"></span><span
                    class="bar"></span>
                <label>Телефон *</label>
            </div>
            <div class="group">
                <select name="sex">
                    <option value="Мужской" {{ $user->sex == "Мужской" ? 'checked' : '' }}>Мужской</option>
                    <option value="Женский" {{ $user->sex == "Мужской" ? 'checked' : '' }}>Женский</option>
                </select>
                <span class="highlight"></span><span class="bar"></span>
                <label>Пол</label>
            </div>
            <div class="group">
                <input type="text" name="birthday" value="{{ $user->birthday ? $user->birthday : '' }}" placeholder="дд.мм.гггг" required="required"/><span
                    class="highlight"></span><span class="bar"></span>
                <label>Дата рождения *</label>
            </div>
            <div class="group checkbox_input">
                <input type="checkbox" name="newsletter">
                <div>Я хочу получать свежие новости по<br> почте и даю свое
                    согласие на это
                </div>
            </div>
        </div>

        <div class="group_items">
            <div class="inner_heading">Выбор способа доставки</div>

            <div class="group radio_input">
                <input type="radio" name="type_delivery" value="Постматы" required> Постматы и пункты выдачи PickPoint
            </div>
            <div class="group radio_input">
                <input type="radio" name="type_delivery" value="Курьером" required> Курьером до двери
            </div>
            <div class="group">
                <input type="text" name="city"><span class="highlight"></span><span class="bar"></span>
                <label>Город</label>
            </div>
            <div class="group">
                <input type="text" name="house"><span class="highlight"></span><span class="bar"></span>
                <label>Дом</label>
            </div>
            <div class="group">
                <input type="text" name="building"><span class="highlight"></span><span class="bar"></span>
                <label>Корпус</label>
            </div>
            <div class="group">
                <input type="text" name="room"><span class="highlight"></span><span class="bar"></span>
                <label>Квартира</label>
            </div>
            <div class="group checkbox_input">
                <input type="checkbox" name="newsletter">
                <div>Примерка / частичная доставка - 0 руб.</div>
            </div>
        </div>

        <div class="group_items">
            <div class="inner_heading">Выбор способа оплаты</div>

            <div class="group radio_input">

                <input type="radio" required value="Наложеный платеж" name="type_pay">
                <div class="radio_item-input">
                    <span class="text-bold">Оплата при получении</span>
                    <span>Оплата курьеру или в пункте самовывоза <br>
                    наличными, банковской картой, картой <br>
                        рассрочки “Халва” при получении заказа</span>
                </div>
            </div>
            <div class="group radio_input">
                <input type="radio" required value="Картой" name="type_pay"> Электронная платежная система
            </div>

            <div class="group">
                <div class="full_price-info">
                    <div class="left_part">
                        <span class="text-bold text-uppercase">{{ count($order) }} Товар(-а)</span>
                    </div>
                    <div class="right_part">
                        <span class="text-bold">{{ numberFormatPrice(sumByPriceSale($order)) }} руб.</span>
                    </div>
                </div>
                <div class="full_price-info">
                    <div class="left_part">
                        Стоимость доставки
                    </div>
                    <div class="right_part">
                        0 руб.
                    </div>
                </div>
                <div class="full_price-info">
                    <div class="left_part">
                        <span class="text-bold text-uppercase">Итого</span>
                    </div>
                    <div class="right_part">
                        <span class="text-bold">{{ numberFormatPrice(sumByPriceSale($order)) }} руб.</span>
                    </div>
                </div>
            </div>
            <div class="group button_box">
                <button class="button">Оформить заказ</button>
            </div>
        </div>
    </form>
@endsection
