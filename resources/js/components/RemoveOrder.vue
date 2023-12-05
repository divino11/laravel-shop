<template>
    <div class="removeBtn">
        <button type="button" @click.prevent="removeOrder(product)"><i class="far fa-trash-alt"></i> Удалить</button>
    </div>
</template>

<script>
    import toastr from 'toastr';

    export default {
        props: ['product'],

        methods: {
            removeOrder(product) {
                axios.post('/remove_product_from_order/' + product)
                    .then(response => {
                        this.$el.closest('.extended_basket-item').remove();

                        axios.get('/basket/total-price')
                            .then(response => {
                                $('.extended_basket-footer--right .extended_basket-total_price').html(response.data + ' руб.');
                            })
                            .catch(response => {
                                toastr.error('Произошла ошибка!');
                            })

                        axios.get('/basket/count')
                            .then(response => {
                                if (response.data === 0) {
                                    $('.basket_badge').remove();
                                    $('.expanded_basket').html('<div class="extended_basket-empty">Ваша корзина покупок пуста</div>');
                                } else {
                                    $('.basket_badge').html(response.data);
                                    $('.extended_basket-inner_heading').html('Корзина (' + response.data + ')');
                                }
                            })
                            .catch(response => {
                                toastr.error('Произошла ошибка!');
                            })

                        toastr.success('Товар был успешно удален!');
                    })
                    .catch(response => {
                        toastr.error('Произошла ошибка!');
                    });
            }
        }
    }
</script>
