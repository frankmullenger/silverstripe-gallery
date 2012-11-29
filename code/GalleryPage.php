<?php
class GalleryPage extends Page {

	public static $has_many = array(
    'Images' => 'GalleryPage_Image'
  );

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
	}
}

class GalleryPage_Image extends Image {

	static $db = array (
    'Caption' => 'Text',
    'SortOrder' => 'Int'
  );

	static $has_one = array (
    'GalleryPage' => 'GalleryPage'
  );

  public static $default_sort = 'SortOrder';

  public function getCMSFields() {

  	$fields = parent::getCMSFields();

  	$fileAttributes = $fields->fieldByName('Root.Main.FilePreview')->fieldByName('FilePreviewData');
  	$fileAttributes->push(TextareaField::create('Caption', 'Caption:')->setRows(4));

  	//$fields->addFieldToTab('Root.Main', HiddenField::create('SortOrder'));
  	$fields->removeFieldsFromTab('Root.Main', array(
  		'Title',
  		'Name',
  		'OwnerID',
  		'ParentID',
  		'Created',
  		'LastEdited',
  		'BackLinkCount',
  		'Di'
  	));
  	return $fields;
  }
}
