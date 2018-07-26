(function ($) {
 "use strict";

$(window).load(function() {
	$('#slideritems').camera({
		height: '36.2%', /* to set the slider height */
		fx: 'random', /* to set the slider effect */
		autoAdvance: true,
		pagination: false,
		navigation:true,
		navigationHover: true,
		mobileNavHover: true,
		playPause: false,
		thumbnails: false,
		loader: 'none',
		imagePath: '../images/'
	});
});


})(jQuery);