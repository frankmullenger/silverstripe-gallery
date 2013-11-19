Silverstripe Image Gallery
==========================

Adds an image gallery to your silverstripe website.

## Author
This module was created by [i-lateral](http://www.i-lateral.com).

Although this module can be extended with your own templates / JavaScript,
the default makes use of:

The CoffeeScriper and his [JavaScript adgallery](http://coffeescripter.com/code/ad-gallery).

## Installation
Install this module either by downloading and adding to:

[silverstripe-root]/gallery

Then run: http://yoursiteurl.com/dev/build/

Or alternativly add to your projects composer.json

## Usage
Once installed, you can add a gallery to your site by creating a
"gallery page" from within the CMS.

Under the gallery tab, you can then upload as many images as needed. 

## Changing the width and height of images
If you wish to change the width and height of the gallery images loaded, you can
do this using the Gallery Config object (in you _config, or controller).

Gallery config has a static method called setDimensions() to do this.

For example, if you wanted to set your gallery to be 900px wide by 300px high,
in your _config.php file use:

    GalleryConfig::setDimensions(900,300);
    
## Changing the gallery JS
By default, the galllery plugin uses [jQuery Ad Gallery](http://coffeescripter.com/code/ad-gallery)
To set itself up, it calls the ss_galleries jquery plugin (gallery/javascript/ss_galleries.js).

If you want to switch out this behaviour, you can remove the default ss_galleries
file and replace it with your own (in your controller or template). 
