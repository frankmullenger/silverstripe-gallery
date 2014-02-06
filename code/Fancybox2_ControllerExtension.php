<?php

class Fancybox2_ControllerExtension extends DataExtension {

	public function onAfterInit() {
		Requirements::javascript('gallery/javascript/fancybox2/jquery-1.7.1.min.js');
		Requirements::javascript('gallery/javascript/fancybox2/jquery.fancybox.js');
		Requirements::javascript('gallery/javascript/fancybox2/GalleryPage.js');

		Requirements::css('gallery/css/fancybox2/jquery.fancybox.css');

	}
	
}
