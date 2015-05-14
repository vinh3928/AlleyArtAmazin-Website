( function($) {
	"use strict";
		
	var flickrdata = flickr_data;
	$('#basicuse').jflickrfeed({
			limit: flickrdata.numbers,
			qstrings: {
				id: flickrdata.flickrid
			},
			itemTemplate: '<li><a href="{{image_b}}" class="fancybox-effects-b"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
		});
	
})(jQuery);
