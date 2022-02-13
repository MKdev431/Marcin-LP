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

$('.desktop-btn, .mobile-btn').on('click', function () {
    const $goToSection = '[data-section=' + $(this).attr('goto-section') + ']';
    // console.log($goToSection)
    // console.log($($goToSection).offset().top)
    $('body, html').animate({
        scrollTop: $($goToSection).offset().top
    })
})

$('.hamburger, .mobile-btn').on('click', function () {
    $('.fa-bars, .fa-arrow-right, .nav-mobile').toggleClass('active')
})

$(function($) {
    const $arrow = $('.fa-arrow-circle-up');
    $(window).scroll(function(event) {
        const $current = $(this).scrollTop();
        if($current > 0) {
            $arrow.addClass('active');
        } else {
            $arrow.removeClass('active');
        }
    })
})

$('.nav-mobile__up-top-arrow').on('click', () => {
    $('body, html').animate({
        scrollTop: '0px'
    })
})
