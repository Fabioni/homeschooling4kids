jQuery(document).ready(function($) {

/*------------------------------------------------
            DECLARATIONS
------------------------------------------------*/

    var scroll              = $(window).scrollTop();  
    var scrollup            = $('.backtotop');
    var menu_toggle         = $('.menu-toggle');
    var nav_menu            = $('.main-navigation ul.nav-menu');
    var featured_slider     = $('.featured-slider-wrapper');
    var team_slider         = $('.team-slider');
    var courses_slider      = $('.courses-slider');
    var posts_height        = $('.blog-posts-wrapper article .post-item');

/*------------------------------------------------
            BACK TO TOP
------------------------------------------------*/

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            scrollup.css({bottom:"25px"});
        } 
        else {
            scrollup.css({bottom:"-100px"});
        }
    });

    scrollup.click(function() {
        $('html, body').animate({scrollTop: '0px'}, 800);
        return false;
    });

/*------------------------------------------------
            MAIN NAVIGATION
------------------------------------------------*/

    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();  
        if (scroll > 49) {
            $(".menu-sticky #masthead").addClass("nav-shrink");
        }
        else {
             $(".menu-sticky #masthead").removeClass("nav-shrink");
        }
    });

    menu_toggle.click(function(){
        nav_menu.slideToggle();
    });

    $('.main-navigation .nav-menu .menu-item-has-children > a').after( $('<button class="dropdown-toggle"><i class="fas fa-caret-down"></i></button>') );

    $('button.dropdown-toggle').click(function() {
        $(this).toggleClass('active');
       $(this).parent().find('.sub-menu').first().slideToggle();
    });

    if( $(window).width() < 1024 ) {
        nav_menu.find("li").last().bind( 'keydown', function(e) {
            if( e.which === 9 ) {
                e.preventDefault();
                $('#masthead').find('.menu-toggle').focus();
            }
        });
    }
    else {
        nav_menu.find("li").unbind('keydown');
    }

    $(window).resize(function() {
        if( $(window).width() < 1024 ) {
            nav_menu.find("li").last().bind( 'keydown', function(e) {
                if( e.which === 9 ) {
                    e.preventDefault();
                    $('#masthead').find('.menu-toggle').focus();
                }
            });
        }
        else {
            nav_menu.find("li").unbind('keydown');
        }
    });
    
/*------------------------------------------------
            SLICK SLIDER
------------------------------------------------*/

    featured_slider.slick();

    team_slider.slick({
        responsive: [
    {
        breakpoint: 992,
        settings: {
            slidesToShow: 2
        }
    },
    {
        breakpoint: 767,
        settings: {
            slidesToShow: 1,
            arrows: false
        }
    }
    ]
    });

    courses_slider.slick({
        responsive: [
    {
        breakpoint: 992,
        settings: {
            slidesToShow: 2
        }
    },
    {
        breakpoint: 767,
        settings: {
            slidesToShow: 1,
            arrows: false
        }
    }
    ]
    });
    
/*------------------------------------------------
            MATCH HEIGHT
------------------------------------------------*/

    posts_height.matchHeight();
    $('.team-wrapper').matchHeight();
    $('#our-courses article .featured-course-wrapper').matchHeight();

/*------------------------------------------------
                END JQUERY
------------------------------------------------*/

});