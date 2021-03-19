<div class="footer order_footer">
    <div class="footer_item">
        <p class="footer_item-heading">БЕСПЛАТНАЯ ДОСТАВКА ПО ВСЕЙ РОССИИ</p>

        <p class="footer_item-subheading">У вас всегда есть возможность воспользоваться бесплатной доставкой
            курьером на дом или получить товар в пункте выдачи.</p>
    </div>

    <div class="footer_item">
        <p class="footer_item-heading">БЕЗОПАСНЫЕ ПЛАТЕЖИ</p>
        <p class="footer_item-subheading">Ваши персональные данные и информация ваших кредитных карт будут в
            безопасности благодаря нашей
            современной системе шифрования (SSL), которая делает неуполномоченный доступ невозможным.</p>
    </div>

    <div class="footer_item">
        <p class="footer_item-heading">ВОЗВРАТ</p>

        <p class="footer_item-subheading">В течение 30 дней с
            даты получения заказа
            Вы можете обменять
            товар на изделие другого размера или запросить возврат денежных средств.</p>
    </div>

    <div class="footer_item">
        <div class="product_top">
            <div>Стоимость товара</div>
            <div>{{ sumByFullPrice($orders) }} руб.</div>
        </div>
        <div class="product_bottom">
            <div>Стоимость товара со скидкой</div>
            <div>{{ sumByPriceSale($orders) }} руб.</div>
        </div>

        <a href="{{ route('basket-place') }}" class="product_button button">Оформить заказ</a>
    </div>
</div>
