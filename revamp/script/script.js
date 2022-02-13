$(function($){
    var $navbar = $('.desktop');
    $(window).scroll(function(event){
        var $current = $(this).scrollTop();
        if( $current > 0 ){
            $navbar.addClass('nav-bgc');
        } else{
            $navbar.removeClass('nav-bgc');
        }
    })
})

$('.buttons button').on('click', function() {
    const goToSection = '[data-section=' + $(this).attr('class') + ']';
    $('body, html').animate({
        scrollTop: $(goToSection).offset().top
    })
})

$('.hamburger, .buttons button').on('click', function () {
    $('.fa-bars, .fa-arrow-right, .mobile').toggleClass('active')
})

