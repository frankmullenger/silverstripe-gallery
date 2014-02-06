<?php

class Fancybox2_ControllerExtension extends DataExtension {

	public function onAfterInit() {
		Requirements::javascript('gallery/javascript/fancybox2/jquery.fancybox.js');
		Requirements::javascript('gallery/javascript/fancybox2/GalleryPage.js');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js'); 

		Requirements::css('gallery/css/fancybox2/jquery.fancybox.css');

	}
	
}
