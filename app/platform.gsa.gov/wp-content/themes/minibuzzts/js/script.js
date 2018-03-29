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
    function setFEBheader(init){
      var width = jQuery(document).width();
      if(width > 480){
          headerHeight = $("div#headercontainer").height();
          console.log('headerheight: '+headerHeight);
          console.log('screenwidth: '+width);
          if($( "div#outerbeforecontent" ).length > 0)
            $( "div#outerbeforecontent" ).css({'margin-top' : headerHeight+'px'});
          else
            $( "div#maincontent" ).css({'margin-top' : headerHeight+'px'});
      }else{
          if($( "div#outerbeforecontent" ).length > 0)
            $( "div#outerbeforecontent" ).css({'margin-top' : 'auto'});
          else
            $( "div#maincontent" ).css({'margin-top' : 'auto'});
      }
      if(init && width > 480 && width < 768)
        $( "div#maincontent" ).css({'margin-top' : headerHeight+21+'px'});
    }
    setFEBheader(1);
    //caches a jQuery object containing the header element
    var header = $(".feb-header-inner");
    var headerlogo = $(".feb-header-inner div#logo");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 75) {
            header.addClass("feb-fixed");
            headerlogo.addClass("feb-logo-small");
        } else {
            header.removeClass("feb-fixed");
            headerlogo.removeClass("feb-logo-small");
        }
    });

    $( window ).resize(function() {
      setFEBheader(0);
    });
    
});