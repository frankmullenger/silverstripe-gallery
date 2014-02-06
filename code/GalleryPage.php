<?php

class GalleryPage extends Page {

}

class GalleryPage_Controller extends Page_Controller {
	
	public function init() {
		parent::init();
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
