require('./bootstrap');
require('slick-carousel');
require('image-zoom-on-hover')
require('admin-lte/plugins/select2/js/select2')
require('admin-lte/plugins/datatables/jquery.dataTables')

window.Vue = require('vue');

Vue.component('favorite', require('./components/Favorite.vue').default);
Vue.component('minusplusfield', require('./components/MinusPlusComponent.vue').default);
Vue.component('singlefavorite', require('./components/SingleFavorite.vue').default);
Vue.component('productattribute', require('./components/ProductAttributes.vue').default);

const app = new Vue({
    el: '#app',
});

$(".similar_gallery").slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 5000,
    prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fas fa-chevron-left'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>",
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true
            }
        },
        {
            breakpoint: 728,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true
            }
        }]
});
