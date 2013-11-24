jQuery(document).ready(function(){
/*global jQuery:false */
/*jshint devel:true, laxcomma:true, smarttabs:true */
"use strict";

	// hide .scrollTo_top first
		jQuery(".scrollTo_top").hide();
	// fade in .scrollTo_top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 100) {
				jQuery('.scrollTo_top').fadeIn();
			} else {
				jQuery('.scrollTo_top').fadeOut();
			}
		});

		// scroll body to 0px on click
	jQuery('.scrollTo_top a').click(function(){
		jQuery('html, body').animate({scrollTop:0}, 500 );
		return false;
	});
	});

		/* ticker */
		
	    jQuery(function(){jQuery("ul.ticker").liScroll();}); 



	  /* default hovers */

		jQuery('.seccol,.widgetflexslider li,.widgetcol_big,.widgetcol_small,.tab-post,.fblock').hover(function() {
			jQuery(this).find('img')
				.animate({opacity:'0.8'}, 300); 
		
			} , function() {
		
			jQuery(this).find('img')
				.animate({opacity:'1'}, 400); 
		});
		  
	  jQuery('.gallery-item img,li.format-image img').hover(function() {
		  jQuery(this).animate({opacity: 0.1}, "normal");
		  }, function() {
		  jQuery(this).animate({opacity: 1}, "normal");
		  });
		  
		  
 
		

	/* sticky navigation */
	
		jQuery(function() {
		
			// grab the initial top offset of the navigation 
			var sticky_navigation_offset_top = jQuery('#navigation').offset().top;
			
			// our function that decides weather the navigation bar should have "fixed" css position or not.
			var sticky_navigation = function(){
				var scroll_top = jQuery(window).scrollTop(); // our current vertical position from the top
				
				// if we've scrolled more than the navigation, change its position to fixed to stick to top, otherwise change it back to relative
				if (scroll_top > sticky_navigation_offset_top) { 
					jQuery('#navigation').css({ 'position': 'fixed', 'top':0, 'width':1078, 'z-index':99 });
					jQuery('#navigation').addClass('disres');
				} else {
					jQuery('#navigation').css({ 'position': 'relative' ,'width':'100%', 'top':0});
					jQuery('#navigation').removeClass('disres'); 
				}   
			};
	
			// run our function on load
			sticky_navigation();
			
			// and run it again every time you scroll
			jQuery(window).scroll(function() {
				 sticky_navigation();
			});
			
			// NOT required:
			// for this demo disable all links that point to "#"
			jQuery('a[href="#"]').click(function(event){ 
				event.preventDefault(); 
			});
			
		});


	/* Tooltips */
		jQuery("body").prepend('<div class="tooltip"><p></p></div>');
		var tt = jQuery("div.tooltip");
		
		jQuery(".flickr_badge_image a img,ul.social-menu li a,.rating img,.post-ratings img").hover(function() {								
			var btn = jQuery(this);
			
			tt.children("p").text(btn.attr("title"));								
						
			var t = Math.floor(tt.outerWidth(true)/2),
				b = Math.floor(btn.outerWidth(true)/2),							
				y = btn.offset().top - 35,
				x = btn.offset().left - (t-b);
						
			tt.css({"top" : y+"px", "left" : x+"px", "display" : "block"});			
			   
		}, function() {		
			tt.hide();			
		});


	function lightbox() {
		// Apply PrettyPhoto to find the relation with our portfolio item
		jQuery("a[rel^='prettyPhoto']").prettyPhoto({
			// Parameters for PrettyPhoto styling
			animationSpeed:'fast',
			slideshow:5000,
			theme:'pp_default',
			show_title:false,
			overlay_gallery: false,
			social_tools: false
		});
	}
	
	if(jQuery().prettyPhoto) {
		lightbox();
	}

});