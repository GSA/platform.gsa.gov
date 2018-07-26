(function ($) {
 "use strict";
$(document).ready(function(){
	//Add Class Js to html
	$('html').addClass('js');	
	
	//=================================== MENU ===================================//
	$(".sf-menu").superfish({
			delay: 200,
			animation: {opacity:'show', height:'show'},
			speed: 'fast',
			cssArrows: true,
			autoArrows:  true,
			dropShadows: false
	});
	//=================================== MOBILE MENU DROPDOWN ===================================//
	$('.sf-menu').tinyNav({
		active: 'current-menu-item'
	});	


});

})(jQuery);