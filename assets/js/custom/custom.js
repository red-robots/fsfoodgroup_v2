/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {

	/* Banner Mirror */
	display_banner_mirror();
	function display_banner_mirror() {
		if( $("#banner").length ) {
			var bannerHeight = $(".banner-image").outerHeight();
			var mirrorTop = bannerHeight + 5;
			$(".banner-mirror").css("top",mirrorTop + "px");
		}
	}
	
	$(window).resize(function() {
		display_banner_mirror();
	});

	$('a[href*="#"]')
	  // Remove links that don't actually link to anything
	  .not('[href="#"]')
	  .not('[href="#0"]')
	  .click(function(event) {
	    // On-page links
	    if (
	      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
	      && 
	      location.hostname == this.hostname
	    ) {
	      // Figure out element to scroll to
	      var target = $(this.hash);
	      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
	      // Does a scroll target exist?
	      if (target.length) {
	        // Only prevent default if animation is actually gonna happen
	        event.preventDefault();
	        $('html, body').animate({
	          scrollTop: target.offset().top
	        }, 1000, function() {
	          // Callback after animation
	          // Must change focus!
	          var $target = $(target);
	          $target.focus();
	          if ($target.is(":focus")) { // Checking if the target was focused
	            return false;
	          } else {
	            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
	            $target.focus(); // Set focus again
	          };
	        });
	      }
	    }
	  });

	
	
	/*
	*
	*	Flexslider
	*
	------------------------------------*/
	$('.flexslider').flexslider({
		animation: "slide",
	}); // end register flexslider
	
	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	
	$('.grid').masonry({
	  // options
	  itemSelector: '.grid-item',
	  columnWidth: 400,
	  gutter: 20
	});
	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();

	/* Press Pagination */
	$(document).on("click",".presspage #pagination a",function(e){
		e.preventDefault();
		var pageURL = $(this).attr("href");
		history.pushState({}, '', pageURL);
		$(".press-articles").load(pageURL + " #articles",function(){

		});
	});


	$(document).on("click",".menu-mobile",function(e){
		e.preventDefault();
		$(this).toggleClass('open');
		$('body').toggleClass('open-mobile-menu');
		$('.main-navigation').toggleClass("animated fadeIn open");
	});

	$(document).on("click",".menu-mobile.closemenubtn",function(e){
		e.preventDefault();
		$('.menu-mobile').removeClass('open');
		$('body').removeClass('open-mobile-menu');
		$('.main-navigation').removeClass("animated fadeIn open");
	});

	$(document).on("click","#VidPlay",function(e){
		e.preventDefault();
		$('#htmlVideo').trigger("click");
		$(this).fadeToggle("fast");
		$(".video-thumb").fadeToggle("fast");
		$(".videomp4").toggleClass("pause");
	});

	$('#htmlVideo').click(function(e) {
        this.paused ? this.play() : this.pause();
    });

});// END #####################################    END