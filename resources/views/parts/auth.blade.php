<div class="auth_form">
    <div class="inner_heading">Вход в личный кабинет</div>

    <div class="row">
        <div class="col-md-6">
            <div class="inner_heading">У меня уже есть аккаунт</div>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                @method('POST')
                <div class="contact_form-group">
                    <label for="email">E-Mail:</label>
                    <input required type="email" name="email" id="email">
                </div>
                <div class="contact_form-group">
                    <label for="password">Пароль:</label>
                    <input required type="password" name="password" id="password">
                </div>


                <div class="auth_form-footer">
                    <div class="auth_form-forget_password">
                        <a href="/">Забыли пароль?</a>
                    </div>
                    <button class="button contact_btn">Войти</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="inner_heading">Я новый покупатель</div>

            <div class="contact_description">
                Создать аккаунт быстро и просто.
                Он позволит Вам отслеживать статусы Ваших заказов, видеть подробную информацию
                по заказам, управлять Вашими данными, а так же получать специальные
                предложения. Нажмите на кнопку "Создать аккаунт", что бы зарегистрироваться.
            </div>

            <form action="{{ route('registration') }}">
                <div class="contact_form-group contact_form-group--required">
                    <input type="checkbox" required name="send_request">
                    <div>Я даю согласие на <span>обработку своих персональных данных</span>
                    </div>
                </div>

                <button class="button contact_btn">Создать аккаунт</button>
            </form>
        </div>
    </div>
</div>
