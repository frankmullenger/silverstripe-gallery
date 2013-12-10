;(function($) {
	$.entwine('gallery', function($){

		$('.galleryfield-files').entwine({
			onmatch : function() {
				var self = this;

				this.sortable({
					opacity: 0.5,
					axis: 'y',
					update: function(event, ui) {

						if(event.type == "sortupdate") {
							ids = [];
							config = $.parseJSON($('div.galleryupload input#Form_EditForm_Images').attr('data-config').replace(/'/g,'"'));
						}
						else {
							ids =[];
							config = fileInput.data('config');
						}

						$('.galleryfield-files .ss-uploadfield-item').each(function(){
							ids.push($(this).attr('data-fileid'));
						});

						$.post(
							config['urlSort'],
							{'ids' : ids}
						);
					}
				});
				
				this._super();
			},
			onunmatch: function() {
				this._super();
			},
		});

	});
}(jQuery));
