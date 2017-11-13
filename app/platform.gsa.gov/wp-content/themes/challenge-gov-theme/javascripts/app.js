/* 
* Skeleton V1.0.3
* Copyright 2011, Dave Gamache
* www.getskeleton.com
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
* 7/17/2011
*/	

jQuery(document).ready(function($) {

	/*
	// Style Tags
	
	$(function(){ // run after page loads
		$('p.tags a')
		.wrap('<span class="st_tag" />');
	});
	

	// Toggle Slides
	
	$(function(){ // run after page loads
			$(".toggle_container").hide(); 
			//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
			$("p.trigger").click(function(){
				$(this).toggleClass("active").next().slideToggle("normal");
				return false; //Prevent the browser jump to the link anchor
			});
	});
	*/

	// valid XHTML method of target_blank
	$(function(){ // run after page loads
		$('a[rel*=external]').click( function() {
			window.open(this.href);
			return false;
		});
	});



	/* Tabs Activiation
	================================================== */
	var tabs = $('ul.tabs');
	tabs.each(function(i) {
		//Get all tabs
		var tab = $(this).find('> li > a');
        if ($('.activate-challenge-tab').length > 0) {
            $("ul.tabs li:nth-child(3)").addClass("active").fadeIn('fast'); //Activate third tab
            $("ul.tabs li:nth-child(3) a").addClass("active").fadeIn('fast'); //Activate third tab
            $("ul.tabs-content li:nth-child(3)").addClass("active").fadeIn('fast'); //Activate third tab
        }
        else
        {
            $("ul.tabs li:first").addClass("active").fadeIn('fast'); //Activate first tab
            $("ul.tabs li:first a").addClass("active").fadeIn('fast'); //Activate first tab
            $("ul.tabs-content li:first").addClass("active").fadeIn('fast'); //Activate first tab
        }
	
		
		tab.click(function(e) {
			
			//Get Location of tab's content
			
			var contentLocation = $(this).attr('href') + "Tab";
			
			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {
			
				e.preventDefault();
			
				//Make Tab Active
				tab.removeClass('active');
				$(this).addClass('active');
				
				//Show Tab Content & add active class
				$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');
				
			} 
		});
	});


	$(".expand-comment").on('click', function() {
		//preventDefault();
		if($(this).text() == 'Show Replies [+]')
		{
			$(this).text('Hide Replies [-]');
   			$(this).closest("li[id^='comment']").find('.children').fadeIn();
   		}
   		else
   		{
   			$(this).text('Show Replies [+]');
   			$(this).closest("li[id^='comment']").find('.children').fadeOut();
   		}
	});

	if ($('.challenge-thumbnail').length > 0) {
        $('.edit-challenge-link>a').click(function(e) {
            e.stopPropagation();
        });
        $('.posted-by>.agency-name>a').click(function(e) {
            e.stopPropagation();
        });

      $('.challenge-thumbnail').click(function(e) {
        //if(e.toElement && !e.toElement.id.startsWith("rating_")){
        if(!e.target.id || (e.target.id && !e.target.id.startsWith("rating_"))){

          var a_anchor = $(this).find('.prize>a');
          var new_url = a_anchor.attr('href');
          var a_target = a_anchor.attr('target');

          if (a_target=="_blank") {
              window.open(new_url, '_blank');
          }
          else {
              window.location.href = new_url;
          }
        }
      });
    }
    $('.challenge-follower-thumbs').click(function(e) {
          var a_anchor = $(this).find('.prize>a');
          var new_url = a_anchor.attr('href');
          var a_target = a_anchor.attr('target');         
          window.location.href = new_url;
      });

	$(".comment .children").hide();
	var pathname = window.location.href;
     if(pathname.indexOf('#comment') > -1){
     	//pathname.match(//);
        $('.tabs li:first-child a').removeClass('active');
        $('.tabs li:nth-child(2) a').addClass('active');
        $('#t1Tab').hide();
        $('#t2Tab').show();
     }

    // collapsable tag and post listing
    if ($('.tag-list-archive').length > 0) {
        $('.im-tag-list').find('.tagged-posts').hide();
        $('.im-tag-list').find('.post-tag').addClass('collapsed');

        // to check if there is anything need to be expanded
        if ($('.expanded').length > 0) {
            $('.expanded').removeClass("collapsed");
            $('.expanded').next('ul').show();
            $('.expanded').next('ul').addClass('expanded-ul');
            $('.expanded').siblings("span").html("-");
            $('.expanded').siblings("span").addClass("minus");
        }

        $('.post-tag').click(function() {

            if ($(this).hasClass("collapsed")) {
                $(this).removeClass("collapsed");
                $(this).addClass("expanded");

                // remove if there is anything expanded
                $('ul.expanded-ul').hide();
                $(".minus").html("+");
                $(".minus").removeClass("minus");

                $(this).next('ul').fadeIn('slow');
                $(this).next('ul').addClass('expanded-ul');

                //span needs have "-"
                $(this).siblings("span").html("-");
                $(this).siblings("span").addClass("minus");
            }
            else {
                $(this).removeClass("expanded");
                $(this).addClass("collapsed");
                $(this).next('ul').fadeOut('slow');
                $(".minus").html("+");
                $(".minus").removeClass("minus");
            }

        });
    }
});