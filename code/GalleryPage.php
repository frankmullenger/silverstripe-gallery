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


// class GalleryPage extends Page {
	
// 	public static $many_many = array(
// 		'Images' => 'Image'	
// 	);
	
// 	public function Images() {
// 		return $this->getManyManyComponents(
// 			'Images',
// 			'',
// 			"\"GalleryPage_Images\".\"SortOrder\" ASC"
// 		);
// 	}
	
// 	public function ImagesCaptions() {
// 		$captions = GalleryPage_Images::get()
// 			->where("\"GalleryPageID\" = '{$this->ID}'")
// 			->map('ImageID', 'Caption')
// 			->toArray();
// 	}

// 	public function getCMSFields() {

// 		$fields = parent::getCMSFields();

// 		$uploadField = new GalleryUploadField('Images', '');
// 		$fields->addFieldToTab('Root.Images', $uploadField);

// 		return $fields;
// 	}

// }
// class GalleryPage_Controller extends Page_Controller {
	
// 	public function init() {
// 		parent::init();

// 		Requirements::javascript('gallery/javascript/jquery-1.7.1.min.js');
// 		Requirements::javascript('gallery/javascript/jquery.fancybox.js');
// 		Requirements::javascript('gallery/javascript/GalleryPage.js');

// 		Requirements::css('gallery/css/jquery.fancybox.css');
// 	}
// }

// class GalleryPage_ImageExtension extends DataExtension {

// 	public static $belongs_many_many = array(
// 		'Pages' => 'Page'
// 	);

// 	public function getUploadFields() {

// 		$fields = $this->owner->getCMSFields();

// 		$fileAttributes = $fields->fieldByName('Root.Main.FilePreview')->fieldByName('FilePreviewData');
// 		$fileAttributes->push(TextareaField::create('Caption', 'Caption:')->setRows(4));

// 		$fields->removeFieldsFromTab('Root.Main', array(
// 			'Title',
// 			'Name',
// 			'OwnerID',
// 			'ParentID',
// 			'Created',
// 			'LastEdited',
// 			'BackLinkCount',
// 			'Dimensions'
// 		));
// 		return $fields;
// 	}
	
// 	public function Caption() {

// 		//TODO: Make this more generic and not require a db query each time
// 		$controller = Controller::curr();
// 		$page = $controller->data();

// 		$joinObj = GalleryPage_Images::get()
// 			->where("\"GalleryPageID\" = '{$page->ID}' AND \"ImageID\" = '{$this->owner->ID}'")
// 			->first();
			
// 		return $joinObj->Caption;
// 	}
	
// }

// class GalleryPage_Images extends DataObject {
	
// 	static $db = array (
// 		'GalleryPageID' => 'Int',
// 		'ImageID' => 'Int',
// 		'Caption' => 'Text',
// 		'SortOrder' => 'Int'
// 	);
// }

