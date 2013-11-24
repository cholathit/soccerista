jQuery(window).load(function() {
/*global jQuery:false */
"use strict";
	
  jQuery('.widgetflexslider').flexslider({
    animation: "slide",
    animationLoop: true,
    itemWidth: 243,        
	slideshowSpeed: 10000, 
	useCSS: false,
    itemMargin: 0,
    minItems: 2,
    maxItems: 3
  });
  
});