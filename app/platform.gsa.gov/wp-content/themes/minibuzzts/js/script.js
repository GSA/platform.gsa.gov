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

    //caches a jQuery object containing the header element
    var header = $(".feb-header-inner");
    var headerlogo = $(".feb-header-inner div#logo");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();

        if (scroll >= 200) {
            header.addClass("feb-fixed");
            headerlogo.addClass("feb-logo-small");
        } else {
            header.removeClass("feb-fixed");
            headerlogo.removeClass("feb-logo-small");
        }
    });
});