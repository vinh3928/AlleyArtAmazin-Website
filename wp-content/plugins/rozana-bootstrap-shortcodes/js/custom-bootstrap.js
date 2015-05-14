( function($) {
	"use strict";

	$("[data-thumb=tooltip]").tooltip();
	//Tabs
	$('#myTab a, .nav-tabs a, .nav-tabs2 a').click(function (e) {
	  e.preventDefault() 
	  $(this).tab('show');
	});
	//Toggles
	$('#myCollapsible').collapse({ 
	  toggle: false
	});
	//Carousal
	$('.carousel').carousel();
	//Alert
	$(".alert").alert();
	//Popovers
	$("[data-thumb=popover]").popover();
	//Dropdown Toggle
	$('.dropdown-toggle').dropdown();
	//Modal
	$('#myModal').modal('hide');
	$('.panel-group .panel').on('show.bs.collapse hidden.bs.collapse', function () {
		$(this).find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
	})
})(jQuery);