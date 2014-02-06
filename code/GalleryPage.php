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
	
	private static $db = array (
		'PageID' => 'Int',
		'ImageID' => 'Int',
		'Caption' => 'Text',
		'SortOrder' => 'Int'
	);
}
