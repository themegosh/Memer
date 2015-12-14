
function positionFooter() {

    var headerHeight = parseInt($(document.body).css('padding-top'), 10);
    var contentHeight = $('#content').outerHeight();
    var footerHeight = $('#footer').outerHeight();
    var windowHeight = $(window).outerHeight();

    var marginTop = windowHeight - (headerHeight + contentHeight + footerHeight);

    if (marginTop < 0)
        marginTop = 0;

    $('#footer').css('margin-top', marginTop + 'px');
}


// When DOM is fully loaded
$(document).ready(function ($) {

    //Position the footer initially
    positionFooter();

    //after 300ms reposition footer, because content resizes dynamically etc
    setTimeout(function () { positionFooter(); }, 300);
    
    
    //tooltip hover show
    $('.hoverTooltip').hover(function () {
        $(this).tooltip('show');
    });

    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') || location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });


});

$(window).resize(function ($) {

    (function () {
        positionFooter();
    })();


});

//on scroll effect for navbar

$(document).scroll(function () {

    var mainNav = $('.mainHeader .navbar');

    if ($(document).scrollTop() > 0) {
        if (!mainNav.hasClass('scrolled'))
            mainNav.addClass('scrolled');
    } else {
        if (mainNav.hasClass('scrolled'))
            mainNav.removeClass('scrolled');
    }
});

