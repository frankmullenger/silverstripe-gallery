<?php
class GalleryPage_Controller extends Page_Controller {
    public function init() {
        parent::init();

        $vars = array();
        Requirements::javascriptTemplate("gallery/javascript/gallery.js", $vars);
    }

    public function Gallery() {
        $vars = array(
            'HideDescription' => $this->HideDescription,
            'Images' => $this->Images()->sort('Sort','DESC'),
            'Width' => GalleryConfig::getWidth(),
            'Height' => GalleryConfig::getHeight()
        );

        return $this->renderWith('Gallery',$vars);
    }
}
