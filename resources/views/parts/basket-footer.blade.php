<div class="footer order_footer">
    <div class="footer_item">

    </div>

    <div class="footer_item">

    </div>

    <div class="footer_item">

    </div>

    <div class="footer_item">
        <div class="product_top">
            <div>Стоимость товара</div>
            <div>{{ numberFormatPrice(sumByFullPrice($orders)) }} руб.</div>
        </div>
        <div class="product_bottom">
            <div>Стоимость товара со скидкой</div>
            <div>{{ numberFormatPrice(sumByPriceSale($orders)) }} руб.</div>
        </div>

        <a href="{{ route('basket-place') }}" class="product_button button">Оформить заказ</a>
    </div>
</div>
