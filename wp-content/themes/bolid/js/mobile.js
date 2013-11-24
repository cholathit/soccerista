jQuery(document).ready(function(){
/*global jQuery:false */
/*jshint devel:true, laxcomma:true, smarttabs:true */
"use strict";

	// trigger + show menu on fire
	  jQuery(window).resize(function() {
	  /*If browser resized, check width again */
		  if (jQuery(window).width() < 639) {
			   jQuery('#navigation').addClass('hidenav');
			   jQuery('a#triggernav').addClass('showtrig');
			  }
		  else {
			  jQuery('#navigation').removeClass('hidenav');
			  jQuery('a#triggernav').removeClass('showtrig');}
	  });
	  
        jQuery('a#triggernav').click(function(){ 
                jQuery('#navigation').toggleClass('shownav'); 
                jQuery(this).toggleClass('active'); 
                return false; 
        }); 
		
		
		
	// 2nd trigger + show menu on fire
	  jQuery(window).resize(function() {
	  /*If browser resized, check width again */
		  if (jQuery(window).width() < 639) {
			   jQuery('#sec-nav').addClass('hidenav');
			   jQuery('a#triggernav-sec').addClass('showtrig');
			  }
		  else {
			  jQuery('#sec-nav').removeClass('hidenav');
			  jQuery('a#triggernav-sec').removeClass('showtrig');}
	  });
	  
        jQuery('a#triggernav-sec').click(function(){ 
                jQuery('#sec-nav').toggleClass('shownav'); 
                jQuery(this).toggleClass('active'); 
                return false; 
        }); 
});