var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
		showLeftPush = document.getElementById( 'showLeftPush' ),
		
		body = document.body;


showLeftPush.onclick = function() {
	classie.toggle( this, 'active' );
	classie.toggle( body, 'cbp-spmenu-push-toright' );
	classie.toggle( menuLeft, 'cbp-spmenu-open' );
	disableOther( 'showLeftPush' );
};


function disableOther( button ) {
	
	if( button !== 'showLeftPush' ) {
		classie.toggle( showLeftPush, 'disabled' );
	}
	
}

jQuery(document).ready(function($){
 
	$('.agency-name').hover(
		function(){
			$(this).find('.agencyInfo').slideDown(250); //.fadeIn(250)
		},
		function(){
			$(this).find('.agencyInfo').slideUp(250); //.fadeOut(205)
		}
	);	
 
});		