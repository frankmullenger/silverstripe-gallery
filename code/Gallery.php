<?php

class Gallery_PageExtension extends DataExtension {
	
	private static $has_one = array(
		'ImageFolder' => 'Folder',
	);
	
	private static $many_many = array(
		'Images' => 'Image'	
	);
	
	public function updateCMSFields(FieldList $fields) {

		$fields->addFieldToTab(
			'Root.Gallery', 
			GalleryUploadField::create(
				'Images',
				'',
				$this->owner->OrderedImages()
			)->setFolderName($this->owner->getFolderPath())
		);
	}
	
	public function OrderedImages() {

		list($parentClass, $componentClass, $parentField, $componentField, $table) = $this->owner->many_many('Images');

		return $this->owner->getManyManyComponents(
			'Images',
			'',
			"\"{$table}\".\"SortOrder\" ASC"
		);
	}
	
	function onBeforeWrite() {
		parent::onBeforeWrite();
		
		if (!$this->owner->ImageFolder() || !$this->owner->ImageFolder()->exists()) {
			$folderpath = $this->owner->getFolderPath();
			$folder = Folder::find_or_make($folderpath);
			$this->owner->ImageFolderID = $folder->ID;
		} else if($this->owner->isChanged('URLSegment', 2)) {
			$folder = $this->owner->getComponent('ImageFolder');
			$folder->setTitle($this->owner->URLSegment);
			$folder->write();
		}
		
	}
	
	public function getFolderPath() {
		if (!$this->owner->URLSegment) {
			$this->owner->URLSegment = 'new-gallery';
		}
		$folderpath = 'galleries/'.$this->owner->URLSegment;
		if ($this->owner->ImageFolder() && $this->owner->ImageFolder()->exists()) {
			$folderpath = str_replace('assets/', '', $this->owner->ImageFolder()->getFilename());
		}
		return $folderpath;
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
	
	public function Caption() {

		//TODO: Refactor so doesn't query database each time
		$controller = Controller::curr();
		$page = $controller->data();
		list($parentClass, $componentClass, $parentField, $componentField, $table) = $page->many_many('Images');

		$joinObj = $table::get()
			->where("\"{$parentField}\" = '{$page->ID}' AND \"ImageID\" = '{$this->owner->ID}'")
			->first();
			
		return $joinObj->Caption;
	}
}
