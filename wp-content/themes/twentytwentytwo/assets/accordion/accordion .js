jQuery(document).ready(function ($) {
    $('.faq-heading').click(function () {
        $(this).parent('li').toggleClass('the-active').find('.faq-text').slideToggle();
        $(this).parent('li').siblings().removeClass('the-active');
        $(this).parent('li').siblings().find('.faq-text').hide();
    });
});