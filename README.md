# Gallery

## Maintainer Contact
Frank Mullenger  
[Contact Me](http://swipestripe.com/support/contact-us)  
[Blog](http://deadlytechnology.com)  
[Ecommerce Module](https://swipestripe.com)

## Requirements
* SilverStripe framework >3.1.2
* SilverStripe cms >3.1.2

## Version
1.1

## Documentation
Very simple gallery solution to upload images and display them in a basic gallery using Fancybox. 

A __gallery can be added to any page type__, GalleryPage is shipped with this module as an example.

Uses customised UploadField to manage the images, allowing bulk upload of images then resorting using drag drop and editing of captions inline.

An example implementation using Fancybox2 has been provided.
You are required to [purchase a licence for Fancybox](http://fancyapps.com/fancybox/#license) for commercial websites. Fancybox can be replaced easily for each page type you apply the gallery to.

## Installation Instructions

### Composer
1. ```composer require frankmullenger/gallery 1.0.*@dev```
2. Visit yoursite.com/dev/build?flush=1 to rebuild the database (you may need to do this twice).

### Manual
1. Place this directory in the root of your SilverStripe installation, rename the folder 'gallery'.
2. Visit yoursite.com/dev/build?flush=1 to rebuild the database (you may need to do this twice).

## Usage
1. Create "Gallery page" in the CMS
2. Edit the gallery page and go to "Gallery" tab
3. Drag images into the "Drop" area
4. [Edit caption for images](http://i.imgur.com/h8EwN.png)
5. [Drag and drop images to re-order them](http://i.imgur.com/vPrX3.png)

### Extended usage
You can make any page type a gallery by applying the extensions in this module to a page type. Using GalleryPage as an example:

#### Create a page type 
Including Javascript in your controller to display the images in your gallery and a DataObject representing the join table. Because we are applying an extension with a many_many Images component you will need a DataObject {PageType}_Images to represent the join. This object requires Caption and SortOrder fields.

```php
<?php

class GalleryPage extends Page {

}

class GalleryPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();

		Requirements::javascript('gallery/javascript/jquery-1.7.1.min.js');
		Requirements::javascript('gallery/javascript/jquery.fancybox.js');
		Requirements::javascript('gallery/javascript/GalleryPage.js');

		Requirements::css('gallery/css/jquery.fancybox.css');
	}
}

class GalleryPage_Images extends DataObject {
	
	static $db = array (
		'PageID' => 'Int',
		'ImageID' => 'Int',
		'Caption' => 'Text',
		'SortOrder' => 'Int'
	);
}
```

_You may need to run /dev/build twice during this process to ensure the join object is created correctly._

#### Create a template
Using the GalleryPage.ss layout template as an example, loop through the ordered images and display them with necessary markup for your lightbox Javascript.
```html
<% loop OrderedImages %>
	<a class="fancybox" data-fancybox-group="gallery" href="$Filename" title="$Caption">
		$SetSize(250,250)
	</a>
<% end_loop %>
```

#### Apply the extension
Apply the extension to the page type in a config yaml file:
```yaml
GalleryPage:
  extensions: 
    - 'Gallery_PageExtension'
```

## Attribution
This extension uses:
* [jQuery](http://jquery.com)
* [Fancybox](http://fancyapps.com/fancybox/) [Licence](http://fancyapps.com/fancybox/#license)

## License
	Copyright (c) 2013, [Frank Mullenger](http://nz.linkedin.com/in/frankmullenger)
	All rights reserved.

	Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

	    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
	    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the 
	      documentation and/or other materials provided with the distribution.
	    * Neither the name of SilverStripe nor the names of its contributors may be used to endorse or promote products derived from this software 
	      without specific prior written permission.

	THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
	IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE 
	LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE 
	GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, 
	STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY 
	OF SUCH DAMAGE.