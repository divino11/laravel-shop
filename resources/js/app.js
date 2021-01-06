require('./bootstrap');
require('slick-carousel');
require('@fancyapps/fancybox')

window.Vue = require('vue');

Vue.component('favorite', require('./components/Favorite.vue').default);

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
    nextArrow: "<button type='button' class='slick-next pull-right'><i class='fas fa-chevron-right'></i></button>"
});

$("#addNewSize").click(function () {
    $('<div class="size-group_item">\n' +
        '                            <input type="text" id="size_name" class="form-control" name="size_name[]"\n' +
        '                                   placeholder="Название размера">\n' +
        '                            <input type="text" id="size_count" class="form-control" name="size_count[]"\n' +
        '                                   placeholder="Количество">\n' +
        '                        </div>').appendTo('.size-group')
});

$('#removeSize').click(function () {
    if ($(".size-group_item").length > 1) {
        $(".size-group_item:last-child").remove();
    }
});
