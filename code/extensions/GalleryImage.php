<?php

class GalleryImage extends DataExtension {
    public static $db = array(
        'Sort'  => 'Int'
    );

    public static $belogs_many_many = array(
        'Gallery'   => 'GalleryPage'
    );
    
    public function updateCMSFields(FieldList $fields) {
        $fields->addFieldToTab('Root.Main', TextField::create('Sort', 'Prioritise (Higher numbers first)'));
    }
}
