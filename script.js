jQuery(function($){
    var $navbar = $('nav');
    $(window).scroll(function(event){
        var $current = $(this).scrollTop();
        if( $current > 0 ){
            $navbar.addClass('nav-bgc');
        } else{
            $navbar.removeClass('nav-bgc');
        }
    });
});

