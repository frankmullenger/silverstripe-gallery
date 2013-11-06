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
							config = $.parseJSON($('div.galleryupload input').data('config').replace(/'/g,'"'));
						}
						else {
							ids =[];
							config = $.parseJSON(fileInput.data('config').replace(/'/g,'"'));
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
