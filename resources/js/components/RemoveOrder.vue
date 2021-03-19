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
                        toastr.success('Товар был успешно удален!');
                    })
                    .catch(response => {
                        toastr.error('Произошла ошибка!');
                    });
            }
        }
    }
</script>
