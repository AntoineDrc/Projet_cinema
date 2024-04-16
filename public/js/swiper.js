// swiper.js
document.addEventListener('DOMContentLoaded', function () {
    // Swiper pour le carrousel du haut
    const swiperTop = new Swiper('.carousselTop', {
        loop: true,
        pagination: {
            el: '.carousselTop-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.carousselTop-button-next',
            prevEl: '.carousselTop-button-prev',
        },
    });

    // Swiper pour le carrousel du bas
    const swiperBot = new Swiper('.carousselBot', {
        loop: true,
        pagination: {
            el: '.carousselBot-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.carousselBot-button-next',
            prevEl: '.carousselBot-button-prev',
        },
    });
});
