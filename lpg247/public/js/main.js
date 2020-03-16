/*-----------------------------------------------------------------------------------*/
/* 		SEBIAN MAIN JS FILE
/*-----------------------------------------------------------------------------------*/
$(document).ready(function($) {
"use strict"
/*-----------------------------------------------------------------------------------*/
/* 	LOADER
/*-----------------------------------------------------------------------------------*/
$(window).load(function() {
	$("#loader").delay(500).fadeOut("slow");
});
/*-----------------------------------------------------------------------------------*/
/*		STICKY NAVIGATION
/*-----------------------------------------------------------------------------------*/
$(".sticky").sticky({topSpacing:0});
/*-----------------------------------------------------------------------------------*/
/* 	ANIMATION
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/* 	PRODUCTS SLIDER
/*-----------------------------------------------------------------------------------*/
$(".product-slides").owlCarousel({ 
    items : 1,
	autoplay:false,
	autoplayHoverPause:true,
	singleItem	: true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	lazyLoad:true,
	nav: true,
	animateOut: 'fadeOut'	
});
/*-----------------------------------------------------------------------------------*/
/* 	ABOUT CLIENT SLIDER
/*-----------------------------------------------------------------------------------*/
$(".clients-about-slider").owlCarousel({ 
	autoplay:false,
	autoplayHoverPause:true,
	singleItem	: true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	lazyLoad:true,
	nav: true,
	margin:30,
	responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1200:{
            items:3,
			nav: false
        }}
});
/*-----------------------------------------------------------------------------------*/
/* 	PRODUCTS SLIDER
/*-----------------------------------------------------------------------------------*/
$(".testi-slides").owlCarousel({ 
    items : 1,
	autoplay:true,
	loop:true,
	autoplayHoverPause:true,
	singleItem	: true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	lazyLoad:true,
	nav: true,
	animateOut: 'fadeOut'	
});

/*-----------------------------------------------------------------------------------*/
/* 	ABOUT CLIENT SLIDER
/*-----------------------------------------------------------------------------------*/
$(".new-col-slide").owlCarousel({ 
	autoplay:false,
	autoplayHoverPause:true,
	singleItem	: true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	lazyLoad:true,
	nav: false,
	margin:30,
	responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1200:{
            items:3,
        }}
});
/*-----------------------------------------------------------------------------------*/
/* 		FEATURE SLIDER
/*-----------------------------------------------------------------------------------*/
$(".fur-slide").owlCarousel({ 
	autoplay:true,
	autoplayHoverPause:true,
	singleItem	: true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	lazyLoad:true,
	nav: false,
	margin:0,
	responsive:{
        0:{
            items:1
        },
        1000:{
            items:2,
        }}
});
/*-----------------------------------------------------------------------------------*/
/* 		CLIENTS LOGO SLIDE
/*-----------------------------------------------------------------------------------*/
$(".client-slide").owlCarousel({ 
	autoplay:true,
	autoplayHoverPause:true,
	singleItem	: true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	lazyLoad:true,
	nav: false,
	loop:true,
	margin:30,
	animateOut: 'fadeOut',	
	responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        800:{
            items:3
        },
        1200:{
            items:4
        }}	
});
/*-----------------------------------------------------------------------------------*/
/* 		BANNER ITEMS SLIDER
/*-----------------------------------------------------------------------------------*/
$(".bnr-items-slider").owlCarousel({ 
	autoplay:true,
	autoplayHoverPause:true,
	singleItem	: true,
	navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	lazyLoad:true,
	nav: false,
	loop:true,
	margin:0,
	animateOut: 'fadeOut',	
	responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        800:{
            items:2
        },
		1350:{
            items:3
        },
        1600:{
            items:4
        }}	
});

/*-----------------------------------------------------------------------------------*/
/*    POPUP VIDEO
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/* 	SLIDER REVOLUTION
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Go TO TOP
/*-----------------------------------------------------------------------------------*/
var offset = 300,
	//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
	offset_opacity = 1200,
	//duration of the top scrolling animation (in ms)
	scroll_top_duration = 700,
	//grab the "back to top" link
	$back_to_top = $('.cd-top');

//hide or show the "back to top" link
$(window).scroll(function(){
	( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
	if( $(this).scrollTop() > offset_opacity ) { 
		$back_to_top.addClass('cd-fade-out');
	}
});
//smooth scroll to top
$back_to_top.on('click', function(event){
	event.preventDefault();
	$('body,html').animate({
		scrollTop: 0 ,
	 	}, scroll_top_duration
);
});
});


