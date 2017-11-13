var $j = jQuery.noConflict();

$j(function(){
    $j('#anchor-link').click(function(e) {
        e.preventDefault();
        $j('body').scrollTo( $j('.bottomHero'), 800 );
    })
	resizeQuote();
	$j(window).resize(function() {
		resizeQuote();
	});
	$j('.updates button').click(function(){
		var email = $j('.visibleForm').val();
		$j('.updates form .your-email input').val(email);
		$j('.updates form #submit').click();
	});
	$j('.issues > div').click(function(){
		$j(this).children('.card').show();
	});
	//fancybox
	$j(".iframe").click(function() {
		$j.fancybox({
			'padding'		: 0,
			'autoScale'		: false,
			'transitionIn'	: 'none',
			'transitionOut'	: 'none',
			'overlayColor'	:	'#333333',
			'overlayOpacity' :  0.9,
			'title'			: this.title,
			'width'		: 680,
			'height'		: 495,
			'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			'type'			: 'swf',
			'swf'			: {
			   	 'wmode'		: 'transparent',
				'allowfullscreen'	: 'true'
			}
		});
		return false;
	});
	
	
	
	
});
function resizeQuote(){
	if ($j(window).width() > 767){
		if($j('.executiveOrder').height() > $j('.quote').height()){
			var orderHeight = $j('.executiveOrder').height();
			$j('.quote').css('height',orderHeight+'px');
		}
		else{
			var orderHeight = $j('.quote').height();
			$j('.executiveOrder').css('height',orderHeight+'px');
		}
	}
	else{
		$j('.quote,.executiveOrder').removeAttr('style');
	}
}