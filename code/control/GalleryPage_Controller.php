<?php
class GalleryPage_Controller extends Page_Controller {
    public function init() {
        parent::init();

        $width = GalleryConfig::getWidth();
        $height = GalleryConfig::getHeight();

        $vars = array(
            'Width'  => $width,
            'Height'  => $height
        );
        Requirements::javascriptTemplate("gallery/javascript/gallery.js", $vars);
    }

    public function Gallery() {

        $vars = array(
            'HideDescription' => $this->HideDescription,
            'Images' => $this->Images()->sort('Sort','DESC')
        );

        return $this->renderWith('Gallery',$vars);
    }
}
