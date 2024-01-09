$(document).ready(function(){ 
"use strict";
	var touch 	= $('#resp-menu');
	var menu 	= $('.menu');
 
	$(touch).on('click', function(e) {
		e.preventDefault();
		menu.slideToggle();
	});
	
	$(window).resize(function(){
		var w = $(window).width();
		if(w >900 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});
	
});

//Main Background Slider
jQuery(function($){
$.supersized({
	// Functionality
	slideshow               :   1,			// Slideshow on/off
	autoplay				:	1,			// Slideshow starts playing automatically
	start_slide             :   1,			// Start slide (0 is random)
	stop_loop				:	0,			// Pauses slideshow on last slide
	random					: 	0,			// Randomize slide order (Ignores start slide)
	slide_interval          :   5000,		// Length between transitions
	transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
	transition_speed		:	1000,		// Speed of transition
	new_window				:	1,			// Image links open in new window/tab
	pause_hover             :   0,			// Pause slideshow on hover
	keyboard_nav            :   1,			// Keyboard navigation on/off
	performance				:	1,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
	image_protect			:	1,			// Disables image dragging and right click with Javascript
											   
	// Size & Position						   
	min_width		        :   0,			// Min width allowed (in pixels)
	min_height		        :   0,			// Min height allowed (in pixels)
	vertical_center         :   1,			// Vertically center background
	horizontal_center       :   1,			// Horizontally center background
	fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
	fit_portrait         	:   1,			// Portrait images will not exceed browser height
	fit_landscape			:   0,			// Landscape images will not exceed browser width
											   
	// Components							
	slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
	thumb_links				:	1,			// Individual thumb links for each slide
	thumbnail_navigation    :   0,			// Thumbnail navigation
	slides 					:  	[			// Slideshow Images
										{image : 'images/slider_img_1.jpg', title : '<h1><span>Become a</span> Model</h1><h4>Pellentesque ut ipsum et erat ultrices vulputate</h4>',},
										{image : 'images/slider_img_2.jpg', title : '<h1><span>Wealth Of</span> Talent</h1><h4>Mattis ut ipsum et erat ultrices lectus</h4>',},
										{image : 'images/slider_img_3.jpg', title : '<h1><span>New</span> Faces</h1><h4>Lobortis ut ipsum et erat ultrices urna</h4>',}
										//{video : 'videos/file.mp4', title : '<h1><span>Wealth Of</span> Talent</h1><h4>Mattis ut ipsum et erat ultrices lectus</h4>',},
								],
								
	// Theme Options			   
	progress_bar			:	1,			// Timer for each slide							
	mouse_scrub				:	0
	
});   
});


//Image Hover
$(function() {
$("span.roll").css("opacity","0");
$("span.roll").hover(function () {
$(this).stop().animate({
opacity: .8
}, "fast");
},
function () {
$(this).stop().animate({
opacity: 0
}, "slow");
});
});


//PAGE LOAD
function WIN_LOAD(){  
	$('#dvLoading').fadeOut(2000);
	var all_li = $('#ulcontent > li');
	all_li.css({'display':'none', left:'-950px'});

	if(location.hash=="" || location.hash.length==0) {
     //spalsh page
	 $("#splash_page").stop(true,true).animate({top:'60px'}, 850, 'easeOutCubic');
	 
	 //animate slide caption
	 $("#slidecaption_wrapper").css("position","absolute").stop(true,true).animate({marginRight:'500px'}, 750, 'easeOutCubic');
	 
	} else {
		$("#bgOverlay ").css("display", "block").stop(true,true).animate({opacity:.9}, 850, 'easeOutCubic');
		api.playToggle();		
		$("li#"+location.hash).css({display:'block'}).stop(true,true).delay(450).animate({left:'0px'}, 750, 'easeOutCubic', function(){   
		     $('#sidebarmenu li a').removeClass("active");	        
			 $("a[href='"+location.hash+"']").addClass("active");
																														 
         });
		 
	}
		

}

//REGISTER LOAD EVENT
function listen(evnt, elem, func) {
    if (elem.addEventListener)  
        elem.addEventListener(evnt,func,false);
    else if (elem.attachEvent) { 
        var r = elem.attachEvent("on"+evnt, func);
    return r;
    }
}

listen("load", window, WIN_LOAD);

$('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
	dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
});

$('.owl-carousel-2').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
	dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

