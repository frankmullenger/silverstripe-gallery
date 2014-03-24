(function($) {
    $(window).load(function() {
        // The slider being synced must be initialized first
        $('.gallery-holder .control').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 150,
            itemMargin: 5,
            asNavFor: '.gallery-holder .gallery'
        });

        $('.gallery-holder .gallery').flexslider({
            animation: "slide",
            selector: ".slides > .slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            keyboard: true,
            sync: ".gallery-holder .control"
        });
    });
})(jQuery)
