/* 
* Skeleton V1.0.3
* Copyright 2011, Dave Gamache
* www.getskeleton.com
* Free to use under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
* 7/17/2011
*/	

jQuery(document).ready(function($) {

	
		/* Superfish
	================================================== */
	$(function(){ // run after page loads
		$('#navigation ul.menu')
		.find('li.current_page_item,li.current_page_parent,li.current_page_ancestor,li.current-cat,li.current-cat-parent,li.current-menu-item')
			.addClass('active')
			.end()
			.superfish({autoArrows	: true});
	});
	
	// Forum Login
	
	$(function(){ // run after page loads
		$("#toggle").click(function() { 
	    // hides matched elements if shown, shows if hidden
	    $("#login-form").slideToggle();
	  });
	});

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
   			$(".children").fadeIn();
   		}
   		else
   		{
   			$(this).text('Show Replies [+]');
   			$(".children").fadeOut();
   		}
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
});