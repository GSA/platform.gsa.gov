/**
 * Portfolio functions
 */


(function ($) {
 "use strict";
 
	$( window ).load( function() {
	
	// Portfolio filtering
	var $container = $( '.portfolio' );
	
	$container.isotope( {
		filter: '*',
		layoutMode: 'fitRows',
		resizable: true, 
	  } );
	
	// filter items when filter link is clicked
	$( '.portfolio-filter li' ).click( function(){
		var selector = $( this ).attr( 'data-filter' );
			$container.isotope( { 
				filter: selector,
			} );
			$('.portfolio-filter li').removeClass('active');
			$(this).addClass('active');
			return false;
			} );
	} );

	$(document).ready(function(){
		//=================================== FADE EFFECT ===================================//
		if (jQuery.browser.msie && jQuery.browser.version < 7) return; // Don't execute code if it's IE6 or below cause it doesn't support it.
		
		$('.portfolio-img').hover(
			function() {
				$(this).find('.rollover').stop().fadeTo(500, 0.6);
			},
			function() {
				$(this).find('.rollover').stop().fadeTo(500, 0);
			}
		
		);
	});
	
})(jQuery);