(function($) {
    /**
     * Setup Galleries in jQuery by looping through all instances, getting their
     * requred width and height and then putting it all together
     *
     * This function expects 2 variables to be set using the html 5 "data" attribute
     * data-width: width of the gallery, set on the ".ad-gallery" element
     * data-height: height of the gallery, set on the ".ad-gallery" element
     */
    $.fn.ss_galleries = function() {
        $(this).each(function(){
            var width = $(this).attr('data-width');
            var height = $(this).attr('data-height');
            
            $('.ad-gallery').adGallery({
                loader_image: 'gallery/images/loader.gif',
                width: width,
                height: height,
                callbacks: {
                    beforeImageVisible: function() {
                        cur_wrapper = this.wrapper.find('.ad-image-wrapper .ad-image');

                        cur_wrapper
                            .css({
                                'width': width,
                                'height': height,
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
        
        return $(this);
    }
})(jQuery)
