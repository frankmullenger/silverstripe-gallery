(function($) {
    $(document).ready(function() {
        var ad_galleries = $('.ad-gallery').adGallery({
            loader_image: 'gallery/images/loader.gif',
            width: $Width,
            height: $Height,
            callbacks: {
                beforeImageVisible: function() {
                    cur_wrapper = this.wrapper.find('.ad-image-wrapper .ad-image');

                    cur_wrapper
                        .css({
                            'width': $Width,
                            'height': $Height,
                            'top': 0,
                            'left': 0
                        })
                        .find('img')
                        .removeAttr('width')
                        .removeAttr('height');
                }
            }
        });
    });
})(jQuery)
