<?php
class GalleryPage extends Page {
	
	public static $many_many = array(
  	'Images' => 'Image'	
  );
  
  public function Images() {

  	$all = new ArrayList();
  	
  	$images = Image::get()
  		->innerJoin(
  			'GalleryPage_Images', 
  			"\"GalleryPage_Images\".\"ImageID\" = \"File\".\"ID\""
  		)
  		->where("\"GalleryPage_Images\".\"GalleryPageID\" = '{$this->ID}'")
  		->sort("\"GalleryPage_Images\".\"SortOrder\" ASC");

  	$captions = GalleryPage_Images::get()
  			->where("\"GalleryPageID\" = '{$this->ID}'")
  			->map('ImageID', 'Caption')
  			->toArray();

  	foreach ($images as $image) {
  		$image->Caption = $captions[$image->ID];
  		$all->push($image);
  	}
  		
  	return $all;
  }

  public function getCMSFields() {

  	$fields = parent::getCMSFields();

  	$uploadField = new GalleryUploadField('Images', '');
  	$fields->addFieldToTab('Root.Images', $uploadField);

  	return $fields;
  }

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

class GalleryPage_ImageExtension extends DataExtension {

	public static $belongs_many_many = array(
    'Pages' => 'Page'
  );

  public function getUploadFields() {

  	$fields = $this->owner->getCMSFields();

  	$fileAttributes = $fields->fieldByName('Root.Main.FilePreview')->fieldByName('FilePreviewData');
  	$fileAttributes->push(TextareaField::create('Caption', 'Caption:')->setRows(4));

  	$fields->removeFieldsFromTab('Root.Main', array(
  		'Title',
  		'Name',
  		'OwnerID',
  		'ParentID',
  		'Created',
  		'LastEdited',
  		'BackLinkCount',
  		'Dimensions'
  	));
  	return $fields;
  }
  
}

class GalleryPage_Images extends DataObject {
	
	static $db = array (
		'GalleryPageID' => 'Int',
		'ImageID' => 'Int',
    'Caption' => 'Text',
    'SortOrder' => 'Int'
  );
}

