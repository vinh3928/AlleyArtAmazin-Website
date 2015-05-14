( function($) {
	"use strict";
	
	$(window).load(function(){
		'use strict';
	
		/* ==  
			Loader Page
		==*/
		$("#loading").fadeOut("1000", function() {
		// Animation complete
			$('#loading img').css("display","none");
			$('#loading').css("display","none");
			$('#loading').css("background","none");
			$('#loading').css("width","0");
			$('#loading').css("height","0");
		});
	
		/* ==  
			Disable Animated on Devices 
		==*/
		if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
			$('.animated').addClass('visible');
		}
		else{
			$('.animated').appear(function() {
				var elem = $(this);
				var animation = elem.data('animation');
				if ( !elem.hasClass('visible') ) {
					var animationDelay = elem.data('animation-delay');
					if ( animationDelay ) {
						setTimeout(function(){
							elem.addClass( animation + " visible" );
						}, animationDelay);
					} else {
						elem.addClass( animation + " visible" );
					}
				}
			});
		}
		
		/* == 
			Post Share 
		==*/
		if($('.post-share').length > 0 ){
			$('.facebook-share , .twitter-share , .reddit-share , .google-share , .linkedin-share , .pinterest-share').on('click',function(){ 
				window.open( $(this).attr('href') , "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" ) 
				return false; 
				});

			$('.post-share').animate({opacity:1});
		}
	
		/* ==  
			Portfolio 
		==*/
		if($('.portfolioContainer').length > 0 ){
			var $container = $('.portfolioContainer');
			$container.isotope({
				filter: '*',
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
		}
		if($('.portfolioFilter a').length > 0 ){
			$('.portfolioFilter a').click(function(){
				$('.portfolioFilter .current').removeClass('current');
				$(this).addClass('current');
		 
				var selector = $(this).attr('data-filter');
				$container.isotope({
					filter: selector,
					animationOptions: {
						duration: 750,
						easing: 'linear',
						queue: false
					}
				 });
				 return false;
			});
		}
		/* ==  
			Animate 
		==*/
		$('.animated').appear(function() {
		    var elem = $(this);
		    var animation = elem.data('animation');
		    if ( !elem.hasClass('visible') ) {
		       	var animationDelay = elem.data('animation-delay');
		        if ( animationDelay ) {
		            setTimeout(function(){
		                elem.addClass( animation + " visible" );
		            }, animationDelay);
		        } else {
		            elem.addClass( animation + " visible" );
		        }
		    }
		});
		if ( $(".blog-masonry-style .isotope").length > 0 ){
			var $container = $('.blog-masonry-style .isotope').masonry();
			// layout Masonry again after all images have loaded
			$container.imagesLoaded( function() {
			  $container.masonry();
			});
		}
		
	});
	
	//$('#comments p.form-submit').wrap('<div class="" data-animation="fadeInUp">');
	$('#comments p.form-submit').addClass('col-md-12 animated');
	$('#comments p.form-submit').attr( "data-animation", "fadeInUp" );
	
	/* ==  
		Stellar Parallax
	==*/
	$(window).stellar({
		responsive: true,
		horizontalScrolling: false,
		parallaxBackgrounds: true,
		parallaxElements: true,
		hideDistantElements: true
    });
	
	// icon
	$('#overflow-icon').on('click', function(){
		$('#overflow-icon').toggleClass('active');
		$('#full-page').toggleClass('slide-right');
		$('#slidemenu').toggleClass('show-menu');
	});
	
	// full page
	$('#full-page').on('click', function(){
		$('#full-page').removeClass('slide-right');
		$('#slidemenu').removeClass('show-menu');
	});
	
	// Decect Viewport Screen
	var sH = $(window).height();
	$('.top-header-fullscreen').css('height',sH);
	// Centering Text for Home Header
	var parent_height = $('.center-content').parent().height();
	var image_height = $('.center-content').height();
	  
	var top_margin = (parent_height - image_height)/2; 
	$('.center-content').css( 'padding-top' , top_margin);
	
	/* == 
		top-menu Menu  
	==*/
	$("#top-menu a").click(function(){
		var link = $(this);
		var closest_ul = link.closest("ul");
		var parallel_active_links = closest_ul.find(".active")
		var closest_li = link.closest("li");
		var link_status = closest_li.hasClass("active");
		var count = 0;
		
		closest_ul.find("ul").slideUp(function(){
			//console.log('here');
			if(++count == closest_ul.find("ul").length)
				parallel_active_links.removeClass("active");
		});
		if(!link_status)
		{
			closest_li.children("ul").slideDown();
			closest_li.addClass("active");
		}
	});
	
	/* ==  
		OWL CAROUSAL  
	==*/
	if ( $(".owl-theme-style, .owl-theme-style2, .owl-theme-style3, .owl-testimonials, .owl-theme-style4").length > 0 ){
		$(".owl-theme-style, .owl-theme-style2").owlCarousel({
			autoPlay: 3000,
			pagination:true,
			items : 4,
			itemsDesktop : [1199,3],
			itemsDesktopSmall : [979,3]
		});

		$(".owl-theme-style3, .owl-testimonials").owlCarousel({
			autoPlay: 3000,
			items : 1,
			itemsDesktop : [1199,1],
			itemsDesktopSmall : [979,1]
		});

		$(".owl-theme-style4").owlCarousel({
			autoPlay: 3000,
			items : 1,
			itemsDesktop : [1199,1],
			itemsDesktopSmall : [979,1]
		});
	}
	
	/* ==  
		COUNTER   
	==*/
	if ($(".counter").length > 0){
		$('.counter').counterUp({
			delay: 10,
			time: 1500
		});
	}
	
	/* ==  
		Full Screen slider index5   
	==*/
	if ($(".cbp-bislideshow").length > 0){
		$(function() {
			cbpBGSlideshow.init();
		});
	}
	
	/* ==  
		Ticker   
	==*/
	$('#fade').list_ticker({
		speed:4000,
		effect:'fade'
	});
	
	/* ==  
		Video Scalable  
	==*/
	$(".video-fit").fitVids();
	$("#full-page").fitVids();
	
	/* ==  
		Scroll to top  
	==*/
	$("#back-top").hide();
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
	
	/* ==  
		Video Background   
	==*/
	if ($(".player").length > 0){
   		if( !device.tablet() && !device.mobile() ) {
			$(".player").mb_YTPlayer();
		} else {
			$('.player').addClass('hide');
			$('.video-bg').addClass('videobg');
		}
	}
	if ($(".video-wrapper").length > 0){
		var video_meta_data =  $('.video-wrapper').attr('data-vide-bg');
		var video_array = video_meta_data.split(',');
		var video_data = [];
		jQuery.each(video_array, function(index, value) {
		   var item = value.split(' ');
		   item[0] = item[0].slice(0,-1);
			if( item[0] == 'mp4' ) {
				var theitem = {"mp4": item[1] };
				video_data['mp4'] = item[1];
			}
			if( item[0] == 'webm' ) {
				var theitem = {"webm": item[1] };
				video_data['webm'] = item[1];
			}
			if( item[0] == 'ogv' ) {
				var theitem = {"ogv": item[1] };
				video_data['ogv'] = item[1];
			}
			if( item[0] == 'poster' ) {
				var theitem = {"poster": item[1] };
				video_data['poster'] = item[1];
			}
	   });
		$('.video-wrapper').prepend('<div class="video-background"></div>');
		$('.video-background').videobackground({
			videoSource: [[ video_data['mp4'], 'video/mp4'],
				[video_data['webm'], 'video/webm'], 
				[video_data['ogv'], 'video/ogg']], 
			controlPosition: '#main',
			poster: video_data['poster'],
			loadedCallback: function() {
				$(this).videobackground('mute');
			}
		});
	}
	
	/* ==  
		Placeholder for IE   
	==*/
	if(!Modernizr.input.placeholder){
		$('[placeholder]').focus(function() {
			var input = $(this);
			if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			}
		}).blur(function() {
			var input = $(this);
			if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			}
		}).blur();
		$('[placeholder]').parents('form').submit(function() {
			$(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
					input.val('');
				}
			});
		});
	}
	
	/* ==  
		Googler Map   
	==*/
	if ($(".custom-google-map").length > 0){
		$( ".custom-google-map" ).each(function() {
			var zoom = $(this).attr('data-map-zoom');
			var maptitle = $(this).attr('data-mape-title');
			var mapimage = $(this).attr('data-map-image');
			var latlang1 = $(this).attr('data-map-latlang');
			var LatLng = latlang1.split(',');
			var mapid = $(this).attr('id');
			var desc  = '';
			if ( $(this).parent().find('.custom-google-map-desc').length > 0){
				desc  = $(this).parent().find('.custom-google-map-desc').html();
			}
			google.maps.event.addDomListener(window, 'load', init);
			//custom-map
			function init() {
				var mapOptions = {
					zoom: parseInt(zoom),
					scrollwheel: false,
					center: new google.maps.LatLng(LatLng[0], LatLng[1]), // Your Address Here
					styles: [{stylers:[{hue:'#000000'},{saturation:-100}]},{featureType:'water',elementType:'geometry',stylers:[{lightness:50},{visibility:'simplified'}]},{featureType:'road',elementType:'labels',stylers:[{visibility:'off'}]}]
				};
				var mapElement = document.getElementById(mapid);
				var map = new google.maps.Map(mapElement, mapOptions);
				var image = mapimage;
				var myLatLng = new google.maps.LatLng(LatLng[0], LatLng[1]);
				var mapMarker = new google.maps.Marker({
					position: myLatLng,
					map: map,
					icon: image,
					title:  maptitle
			
				});
				if(  desc != 'undefined' && desc != '') {
					var contentString =  '<div id="content"><div id="bodyContent">' + desc + '</div></div>';
					var infowindow = new google.maps.InfoWindow({ content: contentString });
					google.maps.event.addListener(mapMarker, 'click', function() {
						infowindow.open(map, mapMarker);
					}); 
				}
			}
			google.maps.event.addDomListener(window, 'load', init);
		});
	}
	
	
	/* ==  
		Bootstrap Script
	==*/
	//tooltios
	$("[data-thumb=tooltip]").tooltip();
	
	//Tabs
	$('#myTab a, .nav-tabs a, .nav-tabs2 a').click(function (e) {
		e.preventDefault() 
		$(this).tab('show');
		  //$('.nav-tabs a:first-child').tab('show');
	});
	
	//Toggles
	$('#myCollapsible').collapse({ 
	  toggle: false
	});
	
	//Carousal
	$('.carousel').carousel('cycle');
	
	//Alert
	$(".alert").alert();
	
	//Popovers
	$("[data-thumb=popover]").popover();
	
	//Dropdown Toggle
	$('.dropdown-toggle').dropdown();
	
	//Modal
	$('#myModal').modal('hide');

	/* ==  
		Progress Bar  
	==*/
	// This line good for appear
	jQuery('.progress-bar').css("width", "0");
	jQuery('.progress-bar').appear(function(){
		jQuery(this).css({ "width" : "0"});
		var datavl = jQuery(this).attr('data-value');
		jQuery(this).animate({ "width" : datavl + "%"}, '300');
	});
	
	$('.panel-group .panel').on('show.bs.collapse hidden.bs.collapse', function () {
			$(this).find('.glyphicon').toggleClass('glyphicon-plus glyphicon-minus');
		})
		
	/* ==  
		Full Screen slider index5   
	==*/
	if ($(".cbp-bislideshow").length > 0){
		$(function() {
				//cbpBGSlideshow.init();
			});
	}
	
	/* ==  Fancy Box  ==*/
	$('.fancybox').fancybox();
	
		$(".fancybox-effects-a").fancybox({
			helpers: {
				title : {
					type : 'outside'
				},
				overlay : {
					speedOut : 0
				}
			}
		});
		// Disable opening and closing animations, change title type
		$(".fancybox-effects-b").fancybox({
			openEffect  : 'none',
			closeEffect	: 'none',
	
			helpers : {
				title : {
					type : 'over'
				}
			}
		});
	
		// Set custom style, close if clicked, change title type and overlay color
		$(".fancybox-effects-c").fancybox({
			wrapCSS    : 'fancybox-custom',
			closeClick : true,
	
			openEffect : 'none',
	
			helpers : {
				title : {
					type : 'inside'
				},
				overlay : {
					css : {
						'background' : 'rgba(238,238,238,0.85)'
					}
				}
			}
		});
	
		// Remove padding, set opening and closing animations, close if clicked and disable overlay
		$(".fancybox-effects-d").fancybox({
			padding: 0,
	
			openEffect : 'elastic',
			openSpeed  : 150,
	
			closeEffect : 'elastic',
			closeSpeed  : 150,
	
			closeClick : true,
	
			helpers : {
				overlay : null
			}
		});
	
		/*
		 *  Button helper. Disable animations, hide close button, change title type and content
		 */
		$('.fancybox-buttons').fancybox({
			openEffect  : 'none',
			closeEffect : 'none',
	
			prevEffect : 'none',
			nextEffect : 'none',
	
			closeBtn  : false,
	
			helpers : {
				title : {
					type : 'inside'
				},
				buttons	: {}
			},
	
			afterLoad : function() {
				this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
			}
		});
		/*
		 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
		 */
		$('.fancybox-thumbs').fancybox({
			prevEffect : 'none',
			nextEffect : 'none',
			closeBtn  : false,
			arrows    : false,
			nextClick : true,
			helpers : {
				thumbs : {
					width  : 50,
					height : 50
				}
			}
		});
		/*
		 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
		*/
		$('.fancybox-media')
			.attr('rel', 'media-gallery')
			.fancybox({
				openEffect : 'none',
				closeEffect : 'none',
				prevEffect : 'none',
				nextEffect : 'none',
	
				arrows : false,
				helpers : {
					media : {},
					buttons : {}
				}
			});
	/* Add arrow.png to image*/
	$('.main_nav ul.sub-menu li').has('ul').find('a:first').addClass('parent');
	
	/* Fixed header to be small when scroll */
	if ( $(".small-scroll-menu").length > 0 ){
		$(function(){
		 var shrinkHeader = 110;
		  $(window).scroll(function() {
			var scroll = getCurrentScroll();
			  if ( scroll >= shrinkHeader ) {
				   $('.main_nav').addClass('shrink');
				}
				else {
					$('.main_nav').removeClass('shrink');
				}
		  });
		 
		function getCurrentScroll() {
			return window.pageYOffset || document.documentElement.scrollTop;
			}
		});
	}
	
	/*
	* Used to scroll in page add active link
	*/
	function getRelatedContent(el){
	  return $($(el).attr('href'));
	}
	// Get link by section or article id
	function getRelatedNavigation(el){
	  return $('nav a[href=#'+$(el).attr('id')+']');
	}


	// ======================================
	// Smooth scroll to content
	// ======================================
	/* == 
		Nice Scroll  
	==*/
    $(".slidemeu-content").niceScroll({cursorborder:"",cursorcolor:"#757575"});
	
	$(".scroll").click(function(event){ // When a link with the .scroll class is clicked
		event.preventDefault(); // Prevent the default action from occurring
		$('html,body').animate({scrollTop:$(this.hash).offset().top -30}, 1500); // Animate the scroll to this link's href value
	});
	
	/*$('a.scroll').on('click',function(e){
		e.preventDefault();
		//$('html,body').animate({scrollTop:getRelatedContent(this).offset().top - 20})
		//event.preventDefault(); // Prevent the default action from occurring
		$('html,body').animate({scrollTop:getRelatedContent(this).offset().top - 50}, 1500); // Animate the scroll to this link's href value
	});*/


	// ======================================
	// Waypoints
	// ======================================
	// Default cwaypoint settings
	// - just showing
	var wpDefaults={
	  context: window,
	  continuous: true,
	  enabled: true,
	  horizontal: false,
	  offset: 0,
	  triggerOnce: false
	};

	$('#full-page div')
	   .waypoint(function(direction) {
		 // Highlight element when related content
		 // is 10% percent from the bottom... 
		 // remove if below
		 getRelatedNavigation(this).toggleClass('active', direction === 'down');
	   }, {
		 offset: '60%' // 
	   })
	   .waypoint(function(direction) {
		 // Highlight element when bottom of related content
		 // is 100px from the top - remove if less
		 // TODO - make function for this
		 getRelatedNavigation(this).toggleClass('active', direction === 'up');
	   }, {
		 offset: function() {  return -$(this).height() + 250; }
	   });
	   
})(jQuery);