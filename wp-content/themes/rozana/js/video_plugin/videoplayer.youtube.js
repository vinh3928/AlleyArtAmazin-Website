(function(){
  "use strict";
$(function ($) {
   		if( !device.tablet() && !device.mobile() ) {
			$(".player").mb_YTPlayer();

		} else {
			$('.player').addClass('hide');
			$('.fullwidth-slider_5').addClass('videobg');
		}
});
})();
