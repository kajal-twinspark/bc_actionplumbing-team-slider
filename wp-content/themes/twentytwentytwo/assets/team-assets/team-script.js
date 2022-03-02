jQuery(document).ready(function ($) {
    var mySwiper = new Swiper('.swiper-container', {
        spaceBetween: 30,
        loop: true,
        // If we need pagination
//        pagination: {
//            el: '.swiper-pagination',
//            clickable: true,
//        },

        // Navigation arrows
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: {
            delay: 5000,
        },
        // And if we need scrollbar
//     scrollbar: {
//       el: '.swiper-scrollbar',
//     },

    });
   
})