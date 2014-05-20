<?php
class GalleryPage_Controller extends Page_Controller {
    public function init() {
        parent::init();
    }

    /**
     * Generate an image gallery from the Gallery template, if no images are
     * available, then return an empty string.
     *
     * @return String
     */
    public function Gallery() {
        if($this->Images()->exists()) {
            $vars = array(
                'HideDescription' => $this->HideDescription,
                'Images' => $this->Images()->sort('SortOrder'),
                'Width' => GalleryConfig::config()->width,
                'Height' => GalleryConfig::config()->height
            );

            return $this->renderWith('Gallery',$vars);
        } else
            return "";
    }
}
