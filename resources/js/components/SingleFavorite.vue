<template>
        <a href="#" class="button like_button" v-if="isFavorited" @click.prevent="unFavorite(product)">
            <i class="fas fa-heart"></i>
        </a>
        <a href="#" class="button like_button" v-else @click.prevent="favorite(product)">
            <i class="far fa-heart"></i>
        </a>
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
            this.isFavorited = this.isFavorite ? true : false;
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
                    })
                    .catch(response => console.log(response.data));
            },

            unFavorite(post) {
                axios.post('/unfavorite/'+post)
                    .then(response => {
                        this.isFavorited = false
                    })
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
