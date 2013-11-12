<?php

class Gallery_PageExtension extends DataExtension {

	public static $many_many = array(
		'Images' => 'Image'	
	);
	
	public function updateCMSFields(FieldList $fields) {

		$fields->addFieldToTab('Root.Gallery', GalleryUploadField::create(
			'Images',
			'',
			$this->owner->OrderedImages()
		));
	}
	
	public function OrderedImages() {
		return $this->owner->getManyManyComponents(
			'Images',
			'',
			"\"Page_Images\".\"SortOrder\" ASC"
		);
	}
}

class Gallery_ImageExtension extends DataExtension {

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
	
	public function Caption() {

		//TODO: Make this more generic and not require a db query each time
		$controller = Controller::curr();
		$page = $controller->data();

		$joinObj = Page_Images::get()
			->where("\"PageID\" = '{$page->ID}' AND \"ImageID\" = '{$this->owner->ID}'")
			->first();
			
		return $joinObj->Caption;
	}
}
