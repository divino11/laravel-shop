require('./bootstrap');
require('slick-carousel');
require('image-zoom-on-hover')
require('admin-lte/plugins/select2/js/select2')
require('admin-lte/plugins/datatables/jquery.dataTables')
require('toastr/toastr')
require('@fancyapps/fancybox/dist/jquery.fancybox');

window.Vue = require('vue');

Vue.component('favorite', require('./components/Favorite.vue').default);
Vue.component('minusplusfield', require('./components/MinusPlusComponent.vue').default);
Vue.component('singlefavorite', require('./components/SingleFavorite.vue').default);
Vue.component('productattribute', require('./components/ProductAttributes.vue').default);
Vue.component('searchcomponent', require('./components/SearchComponent.vue').default);
Vue.component('removeorder', require('./components/RemoveOrder.vue').default);

const app = new Vue({
    el: '#app',
});

$(".similar_gallery").slick({
    slidesToShow: 5,
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

(function () {
    var a = document.querySelector('.product_container'), b = null, P = 0;
    if (a) {
        window.addEventListener('scroll', Ascroll, false);
        document.body.addEventListener('scroll', Ascroll, false);
    }

    function Ascroll() {
        if (b == null) {
            var Sa = getComputedStyle(a, ''), s = '';
            for (var i = 0; i < Sa.length; i++) {
                if (Sa[i].indexOf('overflow') == 0 || Sa[i].indexOf('padding') == 0 || Sa[i].indexOf('border') == 0 || Sa[i].indexOf('outline') == 0 || Sa[i].indexOf('box-shadow') == 0 || Sa[i].indexOf('background') == 0) {
                    s += Sa[i] + ': ' + Sa.getPropertyValue(Sa[i]) + '; '
                }
            }
            b = document.createElement('div');
            b.style.cssText = s + ' box-sizing: border-box; width: ' + a.offsetWidth + 'px;';
            a.insertBefore(b, a.firstChild);
            var l = a.childNodes.length;
            for (var i = 1; i < l; i++) {
                b.appendChild(a.childNodes[1]);
            }
            a.style.height = b.getBoundingClientRect().height + 'px';
            a.style.padding = '0';
            a.style.border = '0';
        }
        var Ra = a.getBoundingClientRect(),
            R = Math.round(Ra.top + b.getBoundingClientRect().height - document.querySelector('.col-md-8').getBoundingClientRect().bottom);  // селектор блока, при достижении нижнего края которого нужно открепить прилипающий элемент
        if ((Ra.top - P) <= 0) {
            if ((Ra.top - P) <= R) {
                b.className = 'stop';
                b.style.top = -R + 'px';
            } else {
                b.className = 'sticky';
                b.style.top = P + 'px';
            }
        } else {
            b.className = '';
            b.style.top = '';
        }
        window.addEventListener('resize', function () {
            a.children[0].style.width = getComputedStyle(a, '').width
        }, false);
    }
})();



