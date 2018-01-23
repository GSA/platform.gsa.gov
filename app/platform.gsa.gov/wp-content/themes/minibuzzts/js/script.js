jQuery(document).ready(function($) {

	setTimeout(function(){
		var myDiv2Para = $('div#metaslider_69 > ol.flex-control-nav');
		var myDiv2ParaDetached = myDiv2Para.detach();
  		myDiv2ParaDetached.appendTo('div#metaslider_69 > ul.slides');
  	},100);

	$('.media-body .more').on('click',function(){
		if($(this).text() == 'More')
			$(this).text('Less');
		else
			$(this).text('More');
	});
});