<template>
    <div class="favorite_btn">
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(product)">
            <i class="fas fa-heart"></i>
        </a>
        <a href="#" v-else @click.prevent="favorite(product)">
            <i class="far fa-heart"></i>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['product', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = !!this.isFavorite;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(post) {
                axios.post('/favorite/'+post)
                    .then(response => {
                        this.isFavorited = true

                        if (response.data.count >= 1) {
                            if ($('.favorite-badge').find('.basket_badge').length > 0) {
                            } else {
                                $('.favorite-badge').append('<div class="basket_badge"></div>');
                            }
                            $('.favorite-badge .basket_badge').html(response.data.count)
                        } else {
                            $('.favorite-badge .basket_badge').remove()
                        }
                    })
                    .catch(response => console.log(response.data));
            },

            unFavorite(post) {
                axios.post('/unfavorite/'+post)
                    .then(response => {
                        this.isFavorited = false

                        if (response.data.count === 0) {
                            $('.favorite-badge .basket_badge').remove()
                        } else {
                            $('.favorite-badge .basket_badge').html(response.data.count)
                        }
                    })
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
