<?php

class Gallery_PageExtension extends DataExtension {

	private static $many_many = array(
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

		list($parentClass, $componentClass, $parentField, $componentField, $table) = $this->owner->many_many('Images');
		
		$images = $this->owner->Images();
		$orderdedimages = ArrayList::create();
		$mergeTable = $table::get()->filter(array($parentField => $this->owner->ID));
		if($images->exists()) {
			
			foreach ($images as $image) {
				$mergeItem = $mergeTable->find($componentField, $image->ID);
				$image->SortOrder = $mergeItem->SortOrder;
				$image->Caption = $mergeItem->Caption;
				
				$orderdedimages->add($image);
			}
		}

		return $orderdedimages->sort('SortOrder');
	}
}

class Gallery_ImageExtension extends DataExtension {

	private static $belongs_many_many = array(
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
