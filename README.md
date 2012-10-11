Gallery
===========================

Maintainer Contact
------------------
Frank Mullenger 

* [Contact Me](http://swipestripe.com/support/contact-us)
* [Blog](http://deadlytechnology.com)
* [Ecommerce Module](https://swipestripe.com)

Requirements
------------
* SilverStripe 3.0.*

Documentation
-------------
Very simple gallery solution to upload images and display them in a basic gallery using Fancybox. 

Uses GridField to manage the images, circumvents the issue of requiring a record to exist before attaching an image by saving the record
first when creating a new record - this approach is not ideal but acceptable in many cases.

Ready for dropping in [SortableGridField](https://github.com/UndefinedOffset/SortableGridField) module.

You are required to [purchase a licence for Fancybox](http://fancyapps.com/fancybox/#license) for commercial websites.

Installation Instructions
-------------------------
1. Place this directory in the root of your SilverStripe installation, rename the folder 'gallery'.
2. Visit yoursite.com/dev/build?flush=1 to rebuild the database.

Attribution
-----------
This extension uses:
* [jQuery](http://jquery.com)
* [Fancybox](http://fancyapps.com/fancybox/) [Licence](http://fancyapps.com/fancybox/#license)