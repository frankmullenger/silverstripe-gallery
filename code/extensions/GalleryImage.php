<?php

class GalleryImage extends DataExtension {
    private static $belogs_many_many = array(
        'Gallery'   => 'GalleryPage'
    );

    public function __construct() {
        parent::__construct();
    }

    public function GalleryImage() {
        $resize_type = GalleryConfig::getResizeType();
        $width = GalleryConfig::config()->width;
        $height = GalleryConfig::config()->height;
        $img = false;

        switch ($resize_type) {
            case 'crop':
                $img = $this->owner->croppedImage($width,$height);
                break;
            case 'pad':
                $img = $this->owner->paddedImage($width,$height);
                break;
            case 'ratio':
                $img = $this->owner->SetRatioSize($width,$height);
                break;
        }

        return $img;
    }

    public function GalleryThumbnail() {
        $width = GalleryConfig::config()->thumb_width;
        $height = GalleryConfig::config()->thumb_height;

        return $this->owner->croppedImage($width,$height);

    }
}
