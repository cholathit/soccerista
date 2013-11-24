jQuery(document).ready(function($) {

	// Mobi nav menu  
	
  	$("#nav-mobi select").change(function() {
	 window.location = $(this).find("option:selected").val();
	});
	
  
	// Tabs

	//When page loads...
	$('.tabber-container').each(function() {
		$(this).find(".tabber-content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(this).find(".tabber-content:first").show(); //Show first tab content
	});
	
	//On Click Event
	$("ul.tabs li").click(function(e) {
		$(this).parents('.tabber-container').find("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(this).parents('.tabber-container').find(".tabber-content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(this).parents('.tabber-container').find(activeTab).fadeIn(); //Fade in the active ID content
		
		e.preventDefault();
	});
	
	$("ul.tabs li a").click(function(e) {
		e.preventDefault();
	})
	
	
	// Isotope
	
	var $container = $('#home-widget-wrapper');
	$container.imagesLoaded( function(){
	$container.isotope({
	  // options
	  itemSelector : '.widget-container',
	  transformsEnabled: false,
	  layoutMode : 'masonry'
	});
	});
	
	var $container1 = $('#home-blog-wrapper');
	$container1.imagesLoaded( function(){
	$container1.isotope({
	  // options
	  itemSelector : '.blog-container',
	  transformsEnabled: false,
	  layoutMode : 'masonry'
	});
	});
	
	var $container2 = $('#cat-blog-wrapper');
	$container2.imagesLoaded( function(){
	$container2.isotope({
	  // options
	  itemSelector : '.cat-blog-container',
	  transformsEnabled: false,
	  layoutMode : 'masonry'
	});
	});
	
	var $container3 = $('#sidebar-wrapper');
	$container3.imagesLoaded( function(){
	$container3.isotope({
	  // options
	  itemSelector : '.widget-container',
	  transformsEnabled: false,
	  layoutMode : 'masonry'
	});
	});


});