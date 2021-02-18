@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="inner_heading">Контакты</div>
    <div class="contact_wrapper">
        <div class="contact_form contact_item">
            <div class="heading">Есть вопросы? Задайте их нам!</div>

            <hr class="horizontal_line">

            <form action="">
                @method('POST')
                @csrf
                <div class="contact_form-group">
                    <label for="lastname">Фамилия*</label>
                    <input required type="text" name="lastname" id="lastname">
                </div>
                <div class="contact_form-group">
                    <label for="firstname">Имя*</label>
                    <input required type="text" name="firstname" id="firstname">
                </div>
                <div class="contact_form-group">
                    <label for="email">E-mail*</label>
                    <input required type="email" name="email" id="email">
                </div>
                <div class="contact_form-group">
                    <label for="subject">Тема:*</label>
                    <select required name="subject" id="subject">
                        <option value=""></option>
                        <option value="Тема 1">Тема 1</option>
                        <option value="Тема 2">Тема 2</option>
                        <option value="Тема 3">Тема 3</option>
                        <option value="Тема 4">Тема 4</option>
                    </select>
                </div>
                <div class="contact_form-group">
                    <label for="order">Номер заказа:</label>
                    <input required type="text" name="order" id="order">
                </div>
                <div class="contact_form-group">
                    <label for="message">Сообщение:</label>
                    <textarea required name="message" id="message"></textarea>
                </div>
                <div class="contact_form-group contact_form-group--required">
                    <input type="checkbox" required name="send_request">
                    <div>Нажимая на кнопку "Отправить вопрос" я даю <span>согласие на обработку своих персональных данных</span></div>
                </div>

                <div class="contact_form-group contact_form-group--send">
                    <div>* обязательные поля</div>
                    <div>
                        <button class="button contact_btn">Отправить</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="contact_info contact_item">
            <div class="contact_icon"><i class="fas fa-headset"></i></div>
            <div class="contact_title">Нужна помощь?</div>
            <div class="contact_text">Позвоните нам по телефону</div>
            <div class="contact_phone">Интернет магазин +7(495) 223-223-5</div>
            <div class="contact_text">для подтверждения заказа, оформления заказа, уточнения статуса заказа, отказа от
                заказа, вызова курьера
            </div>
            <div class="contact_phone">Курьерская служба +7(495) 223-223-5</div>
            <div class="contact_text">только после передачи заказа в курьерскую службу для уточнения/изменения
                даты/адреса доставки,
                предоставления дополнительной информации для
                курьера
            </div>

            <div class="contact_icon mt-5"><i class="fas fa-headset"></i></div>
            <div class="contact_title">Часто задаваемые вопросы</div>
            <div class="contact_text">Возможно, вы сможете найти ответ на свой вопрос в разделе Часто задаваемые
                вопросы.
            </div>
            <button class="contact_btn button">Перейти</button>
        </div>
    </div>
@endsection
