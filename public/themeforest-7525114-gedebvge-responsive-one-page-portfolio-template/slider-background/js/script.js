//preloader
$(window).bind("load", function () { // makes sure the whole site is loaded
    $("#status").fadeOut(); // will first fade out the loading animation
    $("#preloader").delay(450).fadeOut("slow"); // will fade out the white DIV that covers the website.
});

//slider homepage setting
$(".home-slider").owlCarousel({
    navigation: false, // Hide next and prev buttons
    slideSpeed: 300,
    autoplay: true,
    pagination: true,
    paginationSpeed: 300,
    singleItem: true,
    transitionStyle: "fade"
});

//slider about section and blog slider setting
$(".about-slider,.blog-slider").owlCarousel({
    navigation: true,
    navigationText: ['<span class="slide-nav inleft"><i class="fa fa-long-arrow-left"></i></span >', '<span class="slide-nav inright"><i class="fa fa-long-arrow-right"></i></span >'],
    slideSpeed: 300,
    autoplay: true,
    pagination: false,
    paginationSpeed: 300,
    singleItem: true,
    transitionStyle: "fade"
});

//sticky navigation
$("#header").sticky({
    topSpacing: 0
});

//header scrolling
$('.home .navigation').onePageNav({
    filter: ':not(.external a)',
    scrollThreshold: 0.25,
    scrollOffset: 93
});

//isotope setting(portfolio)
var $container = $('.portfolio-body');
$container.imagesLoaded(function () {
    $container.isotope();
});

// filter items when filter link is clicked
$('.port-filter a').click(function () {
    var selector = $(this).attr('data-filter');
    $container.isotope({
        itemSelector: '.port-item',
        filter: selector
    });
    return false;
});
$(".port-filter a").click(function (e) {
    $(".port-filter a").removeClass("active");
    $(this).addClass("active");
});




// script prettyphoto
$(document).ready(function () {
    $("a[data-rel^='prettyPhoto']").prettyPhoto({
        hook: 'data-rel',
        deeplinking: false
    });
});

//add portfolio width
var port = $(".container-portfolio");

function portbody() {
    port.width($(window).width());
}
portbody();

//run functions on window resize
$(window).on('resize', function () {
    portbody();
    marginFooter();
});

//fix isotope layout onload
$(window).bind("load", function () {
    $container.isotope('layout');
});

//margin for footer
function marginFooter() {
    $('.transparent').css('height', $('.footer').outerHeight() + 'px');
}
marginFooter();

//black&white effect
$(window).load(function () {
    $('.bw-box').BlackAndWhite({
        hoverEffect: true, // default true
        // set the path to BnWWorker.js for a superfast implementation
        webworkerPath: false,
        // for the images with a fluid width and height 
        responsive: true,
        // to invert the hover effect
        invertHoverEffect: false,
        // this option works only on the modern browsers ( on IE lower than 9 it remains always 1)
        intensity: 1,
        speed: { //this property could also be just speed: value for both fadeIn and fadeOut
            fadeIn: 200, // 200ms for fadeIn animations
            fadeOut: 800 // 800ms for fadeOut animations
        },
        onImageReady: function (img) {
            // this callback gets executed anytime an image is converted
        }
    });
});

// Video responsive
$("body").fitVids();

//portfolio ajax setting
$(document).ready(function () {
    $('.port-ajax').click(function () {

        var toLoad = $(this).attr('data-link') + ' .worksajax > *';
        $('.worksajax').slideUp('slow', loadContent);

        function loadContent() {
            $('.worksajax').load(toLoad, '', showNewContent)
        }
        function showNewContent() {
            $.getScript("js/portfolio.js");
            $('.worksajax').slideDown('slow');
        }
        return false;
    });

});


//replace the data-background into background image
$(".img-bg").each(function () {
    var imG = $(this).data('background');
    $(this).css('background-image', "url('" + imG + "') "

    );
});
//portfolio scrolling
$(function () {
    $('.port-ajax').bind('click', function (event) {
        var $anchor = $('#portfolio');

        $('html, body').stop().animate({
            scrollTop: $($anchor).offset().top - 93
        }, 1000, 'linear');
        event.preventDefault();
    });
});

//add/remove active class in team nav
$(".team-list").click(function (e) {
    $(".team-list").removeClass("active");
    $(this).addClass("active");
});

//team scrolling
$(function () {
    $('.team-list').bind('click', function (event) {
        var $anchor = $('#teamtab');

        $('html, body').stop().animate({
            scrollTop: $($anchor).offset().top - 93
        }, 300, 'linear');
        event.preventDefault();
    });
});

//team close button function
$(".team-close").click(function (e) {
    $('.tab-content').slideUp('fast', function () {
        $(".team-list,.team-bg").removeClass("active");
        $('.tab-content').show();
    });
});
$(function () {
    $('.team-close').bind('click', function (event) {
        var $anchor = $('#team');

        $('html, body').stop().animate({
            scrollTop: $($anchor).offset().top - 93
        }, 300, 'linear');
        event.preventDefault();
    });
});

//move to hash after loading
$(window).bind("load", function () {
    if (window.location.hash) {
        $('html, body').stop().animate({
            scrollTop: $(window.location.hash).offset().top - 93
        }, 300, 'linear');
    }
});

//script for navigation(superfish)
$('.menu-box .navigation ').superfish({
    delay: 400, //delay on mouseout
    animation: {
        opacity: 'show',
        height: 'show'
    }, // fade-in and slide-down animation
    animationOut: {
        opacity: 'hide',
        height: 'hide'
    },
    speed: 200, //  animation speed
    speedOut: 200,
    autoArrows: false // disable generation of arrow mark-up
})

//create menu for tablet/mobile

$(".menu-box .navigation").clone(false).find("ul,li").removeAttr("id").remove(".sub-menu").appendTo($(".mobile-menu"));
$(".mobile-menu .sub-menu").remove();
$('.mobile-menu').on('show.bs.collapse', function () {
    $('body').on('click', function () {
        $('.mobile-menu').collapse('hide');
    })
})

//toggle menu
$('.menu-btn').on('click', function () {
    $('.mobile-menu').collapse({
        toggle: false
    });
})
//menu for tablet/mobile scrolling
$('.mobile-menu a').bind('click', function (event) {
    var $anchor = $(this);

    $('html, body').stop().animate({
        scrollTop: $($anchor.attr('href')).offset().top -93
    }, 800, 'linear');
    event.preventDefault();
});