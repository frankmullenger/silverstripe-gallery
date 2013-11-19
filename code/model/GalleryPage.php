<?php

class GalleryPage extends Page {
    private static $icon = "gallery/images/gallery.png";

    private static $db = array(
        "HideDescription"   => 'Boolean'
    );

    private static $many_many = array(
        'Images'     => 'Image'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        // Determine if you need to show gallery fields
        $fields->addFieldToTab("Root.Gallery", UploadField::create("Images", "Images to appear in gallery"));

        $fields->removeByName('HideDescription');

        return $fields;
    }

    public function getSettingsFields() {
        $fields = parent::getSettingsFields();

        $gallery = FieldGroup::create(
            CheckboxField::create('HideDescription', 'Hide the description of each image?')
        )->setTitle('Gallery');

        $fields->addFieldToTab('Root.Settings', $gallery);

        return $fields;
    }

}