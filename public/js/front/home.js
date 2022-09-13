// home.js

$(function () {

    if ($('#home_page_banners').length) {
        $('#home_page_banners').flexslider({
            animation: "fade",
            start: function (slider) {
                $('body').removeClass('loading');
            }
        });
    }

    if ($('.how-it-works').length) {
        $('.how-it-works a').simpleLightboxVideo();
    }

    if ($('#top_ranks_slider').length) {
        var owl = $("#top_ranks_slider");

        owl.owlCarousel({
            items: 3, //10 items above 1000px browser width
            itemsDesktop: [1000, 5], //5 items between 1000px and 901px
            itemsDesktopSmall: [900, 3], // 3 items betweem 900px and 601px
            itemsTablet: [600, 2], //2 items between 600 and 0;
            itemsMobile: false // itemsMobile disabled - inherit from itemsTablet option

        });
    }

    if ($('.fancybox').length) {
        $('.fancybox').fancybox();
    }
});

/*var owlCat = $("#owl-demo-category");
owlCat.owlCarousel({
    items: 3, //10 items above 1000px browser width
    itemsDesktop: [1199, 3], //5 items between 1000px and 901px
    itemsDesktopSmall: [992, 2], //5 items between 1000px and 901px
    itemsTablet: [768, 2], //2 items between 600 and 0
    itemsMobile: [567, 1], // itemsMobile disabled - inherit from itemsTablet option
    navigation: true,
    margin: 15,
    navigationText: ["<i class='fa fa-chevron-left leftbtn'></i>", "<i class='fa fa-chevron-right'></i>"]
});*/

if ($('.main-slider').length) {
    $('.main-slider').owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        loop: true,
        margin: 0,
        nav: true,
        autoHeight: true,
        smartSpeed: 500,
        autoplay: 6000,
        navText: [''],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            800: {
                items: 1
            },
            1024: {
                items: 1
            },
            1200: {
                items: 1
            }
        }
    });
}

if ($('.owl-demo-category').length) {
    $('.owl-demo-category').owlCarousel({
        loop: false,
        margin: 15,
        nav: true,
        autoHeight: true,
        dotsData: true,
        smartSpeed: 500,
        autoplay: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            767: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    });
}

$('.counter_count').each(function () {
    $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
    }, {

        //chnage count up speed here
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});

(function () {
    var $frame = $('#cyclepages');
    var $wrap = $frame.parent();

    // Call Sly on frame
    $frame.sly({
        horizontal: 1,
        itemNav: 'basic',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 0,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        pagesBar: $wrap.find('.pages'),
        activatePageOn: 'click',
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,

        // Cycling
        cycleBy: 'pages',
        cycleInterval: 1000,
        pauseOnHover: 1,
        startPaused: 1,


    });
}());

(function () {
    var $frame = $('#cyclepages1');
    var $wrap = $frame.parent();

    // Call Sly on frame
    $frame.sly({
        horizontal: 1,
        itemNav: 'basic',
        smart: 1,
        activateOn: 'click',
        mouseDragging: 1,
        touchDragging: 1,
        releaseSwing: 1,
        startAt: 0,
        scrollBar: $wrap.find('.scrollbar'),
        scrollBy: 1,
        pagesBar: $wrap.find('.pages'),
        activatePageOn: 'click',
        speed: 300,
        elasticBounds: 1,
        easing: 'easeOutExpo',
        dragHandle: 1,
        dynamicHandle: 1,
        clickBar: 1,

        // Cycling
        cycleBy: 'pages',
        cycleInterval: 1000,
        pauseOnHover: 1,
        startPaused: 1,


    });
}());

