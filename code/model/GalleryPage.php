<?php

class GalleryPage extends Page
{
    private static $icon = "gallery/images/gallery.png";

    private static $db = array(
        "HideDescription"   => 'Boolean'
    );

    private static $many_many = array(
        'Images' => 'Image'
    );

    private static $many_many_extraFields = array(
        'Images' => array('SortOrder' => 'Int')
    );

    /**
     * Return sorted images
     *
     * @return ArrayList
     */
    public function SortedImages()
    {
        return $this->Images()->Sort('SortOrder');
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('HideDescription');

        $upload_folder = Controller::join_links(
            "gallery",
            $this->ID
        );

        $sortable_field = SortableUploadField::create('Images', 'Images to associate with this page')
            ->setFolderName($upload_folder);

        $fields->addFieldToTab("Root.Gallery", $sortable_field);

        return $fields;
    }

    public function getSettingsFields()
    {
        $fields = parent::getSettingsFields();

        $gallery = FieldGroup::create(
            CheckboxField::create('HideDescription', 'Hide the description of each image?')
        )->setTitle('Gallery');

        $fields->addFieldToTab('Root.Settings', $gallery);

        return $fields;
    }
}
