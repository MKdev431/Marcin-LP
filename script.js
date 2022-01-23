$(function($){
    var $navbar = $('nav');
    $(window).scroll(function(event){
        var $current = $(this).scrollTop();
        if( $current > 0 ){
            $navbar.addClass('nav-bgc');
        } else{
            $navbar.removeClass('nav-bgc');
        }
    })
})

$('.button').on('click', function() {
    const goToSection = '[data-section=' + $(this).attr('class') + ']';
    $('body, html').animate({
        scrollTop: $(goToSection).offset().top
    })
})

$('.hamburger').on('click', function () {
    $('.hamburger').toggleClass('is-active')
})