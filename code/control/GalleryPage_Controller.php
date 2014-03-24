<?php
class GalleryPage_Controller extends Page_Controller {
    public function init() {
        parent::init();
    }

    public function Gallery() {
        $vars = array(
            'HideDescription' => $this->HideDescription,
            'Images' => $this->Images()->sort('SortOrder'),
            'Width' => GalleryConfig::getWidth(),
            'Height' => GalleryConfig::getHeight()
        );

        return $this->renderWith('Gallery',$vars);
    }
}
