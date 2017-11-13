<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Skeleton WordPress Theme Framework
 * @subpackage skeleton
 * @author Simple Themes - www.simplethemes.com
 */
?>
<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><meta http-equiv=”X-UA-Compatible” content=”IE=edge”><![endif]-->
<!--[if IE 8 ]><meta name=”viewport” content=”width=device-width, initial-scale=1″><![endif]-->



<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]-->

<head>
	<?php echo acf_form_head(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php
		// Detect Yoast SEO Plugin
		if (defined('WPSEO_VERSION')) {
			wp_title('');
		} else {
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'skeleton' ), max( $paged, $page ) );
		}
		?>
	</title>

<link rel="profile" href="http://gmpg.org/xfn/11" />

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Add CSS3 Rules here for IE 7-9
================================================== -->

<!--[if IE]>
<style type="text/css">
html.ie #navigation,
html.ie a.button,
html.ie .cta,
html.ie .wp-caption,
html.ie #breadcrumbs,
html.ie a.more-link,
html.ie .gallery .gallery-item img,
html.ie .gallery .gallery-item img.thumbnail,
html.ie .widget-container,
html.ie #author-info {behavior: url("<?php echo get_stylesheet_directory_uri();?>/PIE.php");position: relative;}</style>
<![endif]-->

<!-- Mobile Specific Metas
================================================== -->

<meta name="viewport" content="width=device-width, initial-scale=1" /> 

<!-- Favicons
================================================== -->

<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri();?>/images/favicon.ico">

<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon.png">

<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-72x72.png" />

<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_stylesheet_directory_uri();?>/images/apple-touch-icon-114x114.png" />

<link rel="pingback" href="<?php echo get_option('siteurl') .'/xmlrpc.php';?>" />
<!-- <link rel="stylesheet" id="custom" href="<?php echo home_url() .'/?get_styles=css';?>" type="text/css" media="all" /> !-->

<?php
	/* 
	 * enqueue threaded comments support.
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	// Load head elements
	wp_head();
	$register_text = "Sign Up";
	$this_reg_page = get_page_by_title( "Registration" );
	$this_login_page = get_page_by_title( "Login" );
	$hardcoded_links = false;
    //var_dump($this_page);
    //echo $this_page->ID;
    if ( $this_page->post_type == "page" )
    {
    	//die();
    }

    $edit_value = $_GET['edit-challenge'];
    $edit_value2 = $_GET['edit-agency'];
	
	$using_ssl = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' || $_SERVER['SERVER_PORT'] == 443;
    // Page ID 2 must be https
    if ((is_page('Create New Challenge') || (isset($edit_value) && $edit_value == 'true') || (isset($edit_value2) && $edit_value2 == 'true')) && !$using_ssl)
    	$hardcoded_links = true;
        //$content = "Hello World!";
        //return $content;
    $link_text = !is_user_logged_in() ? "Login" : "Logout";
    $link_url = !is_user_logged_in() ? (!empty($this_login_page) ? get_page_link($this_login_page->ID) : get_site_url().'/login') : wp_logout_url(get_site_url());
?>
<!--[if IE 8 ]><script src="<?php print home_url(); ?>/wp-content/themes/challenge-gov-theme/javascripts/html5shiv.js"></script><![endif]-->
<!--[if IE 8 ]><script src="<?php print home_url(); ?>/wp-content/themes/challenge-gov-theme/javascripts/respond.min.js"></script><![endif]-->
<!--[if lte IE 9 ]><script src="<?php print home_url(); ?>/wp-content/themes/challenge-gov-theme/javascripts/jquery.dotdotdot.min.js"></script><![endif]-->
<!--[if lte IE 9 ]><script src="<?php print home_url(); ?>/wp-content/themes/challenge-gov-theme/javascripts/ie-stuff.js"></script><![endif]-->
<!--[if lte IE 9 ]><link rel="stylesheet" type="text/css" href="<?php print home_url(); ?>/wp-content/themes/challenge-gov-theme/css/ie-stuff.css" /><![endif]-->
<!--[if gte IE 10 ]><link rel="stylesheet" type="text/css" href="<?php print home_url(); ?>/wp-content/themes/challenge-gov-theme/css/ie-stuff2.css" /><![endif]-->

</head>

<body>
<!--[if lte IE 9 ]><div class="ie-cover"></div><![endif]-->
<!-- start challenge_gov_theme -->
<header>
	<div class="pull-right social-accounts">      
        <a href="https://www.facebook.com/ChallengeGov"><i id="social" class="fa fa-facebook-square fa-3x social-fb"></i><span class="sr-only">follow us on facebook</span></a>
        <a href="https://twitter.com/ChallengeGov"><i id="social" class="fa fa-twitter-square fa-3x social-tw"></i><span class="sr-only">follow us on twitter</span></a>
        <a href="mailto:challenge@gsa.gov"><i id="social" class="fa fa-envelope-square fa-3x social-em"></i><span class="sr-only">email us</span></a>
	</div>
	<div class="navBrand">
		<div><a href="<?php echo site_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri();?>/images/challenge_full_logo.png" alt="challenge gov logo"></a></div>
	</div>
	<nav class="navbar navbar-default">
	  <div class="container-fluid tabbable-panel">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" >
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse tabbable-line" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav nav-tabs">
				<li<?php if(is_page('list')||is_page('create-new-challenge')||is_page('my-challenges'))echo ' class="active"'; ?>>
					<?php if(is_user_logged_in() && (is_page('list')||is_page('create-new-challenge')||is_page('my-challenges'))) { ?>
					<a href="#tab_default_1" data-toggle="tab"><span style="z-index:1;">Challenges</span></a>
					<?php } else { ?>
					<a href="<?php echo site_url('list'); ?>"><span style="z-index:1;">Challenges</span></a>
					<?php } ?>
				</li>
				<li<?php if(is_page('about')||is_page('how-it-works'))echo ' class="active"'; ?>>
					<?php if (is_page('about')||is_page('how-it-works')) { ?>
					<a href="#tab_default_2" data-toggle="tab"><span style="z-index:1;">About</span></a>
					<?php } else { ?>
					<a href="<?php echo site_url('about'); ?>"><span style="z-index:1;">About</span></a>
					<?php } ?>
				</li>
				<li<?php if(is_page('contact'))echo ' class="active"'; ?>>
					<a href="<?php echo site_url();?>/contact"><span style="z-index:1;">Contact</span></a>
				</li>
				</ul>
			    <?php
			    	if(is_user_logged_in())
		          		$current_user = wp_get_current_user();
		        ?>
		      	<ul class="nav navbar-nav navbar-right">
		      		<li id = "first_dropdown" class="dropdown<?php echo is_user_logged_in() ? " challenge-logged-in" : " challenge-login"; ?>">
		      			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo is_user_logged_in() ? $current_user->user_login : " Log In"; ?> <span class="caret"></span></a>
		          		<ul class="dropdown-menu" role="menu">
		          		<?php
		          		if(is_user_logged_in()){
		          			?>
		              		<li class = "dropdown-submenu"><a href="<?php echo site_url('profile/'.$current_user->user_login); ?>">My Profile</a></li>
		              		<li class = "dropdown-submenu"><a style="font-weight:bold;" href="<?php echo wp_logout_url(site_url()); ?>">Log out</a></li>
		              		<?php
		          		}
		          		else
		          		{
		          			?>
		              		<li class = "dropdown-submenu" tabindex="-1"><a href="<?php echo site_url('registration'); ?>">Register Now</a></li>
		              		<li class = "dropdown-submenu" tabindex="-1"><a href="<?php echo site_url('login'); ?>">Log In</a></li>
		              	<?php
		              	}
		              	?>
		                </ul>
		      	</li>
		        <li id = "second_dropdown" class="dropdown">
		          	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">See How It Works<span class="caret"></span></a>
		          	<ul class="dropdown-menu" role="menu">
		              	<li>Agencies</li>
		                <li><a href="<?php echo site_url('program-overview'); ?>">Program Overview</a></li>
                        <li class="divider"></li>
		                <li>Guide</li>
		                <li><a href="<?php echo site_url('getting-started'); ?>">Getting Started</a></li>
		                 <li class="divider"></li>

					</ul>
				</li>
		        <?php
		        if(is_user_logged_in()){
        		?>
              		<li class = "mobile_options"><a href="<?php echo site_url('profile/'.$current_user->user_login); ?>">My Profile</a></li>
              		<li class = "mobile_options"><a style="font-weight:bold;" href="<?php echo wp_logout_url(site_url()); ?>">Log out</a></li>
              		<li class = "mobile_options"><a href="<?php echo site_url('program-overview'); ?>">Program Overview</a></li>
					<li class = "mobile_options"><a href="<?php echo site_url('getting-started'); ?>">Getting Started</a></li>
              	<?php
          			}
      			else
      			{
          		?>
              		<li class = "mobile_options"><a href="<?php echo site_url('registration'); ?>">Register Now</a></li>
          			<li class = "mobile_options"><a href="<?php echo site_url('login'); ?>">Log In</a></li>
          			<li class = "mobile_options"><a href="<?php echo site_url('program-overview'); ?>">Program Overview</a></li>
					<li class = "mobile_options"><a href="<?php echo site_url('getting-started'); ?>">Getting Started</a></li>
              	<?php
              	}
              	?>

				</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->

	 <script type="text/javascript" charset="utf-8">
	 	jQuery(document).ready(function($){
 			var width = $(window).width();
	 		if(width <= 767){
	 			$(".mobile_options").show();
	 			$("#first_dropdown").hide();
	 			$("#second_dropdown").hide();
	 		}
	 		else{
	 			$(".mobile_options").hide();
	 			$("#first_dropdown").show();
	 			$("#second_dropdown").show();
	 		}
	 		$(window).resize(function(){
	 			width = $(window).width();
		 		if(width <= 767){
		 			$(".mobile_options").show();
		 			$("#first_dropdown").hide();
		 			$("#second_dropdown").hide();
		 		}
		 		else{
		 			$(".mobile_options").hide();
		 			$("#first_dropdown").show();
		 			$("#second_dropdown").show();
		 		}
		 	});
	 	});
	 </script>


	<div class="tab-content">
        	<div class="tab-pane<?php if(is_page('list')||is_page('create-new-challenge')||is_page('my-challenges'))echo ' active'; ?>" id="tab_default_1">
          		<ul class="sub-nav">
              		<li<?php if(is_page('list'))echo ' class="active"'; ?>><a href="<?php echo site_url('list'); ?>">Newest Challenges</a></li>
			        <?php if(is_user_logged_in() && (current_user_can('create_users') || current_user_can('all_access_agency'))) { ?>
			        <li<?php if(is_page('create-new-challenge'))echo ' class="active"'; ?>><a href="<?php echo site_url('create-new-challenge'); ?>">Post a Challenge</a></li>
			        <li<?php if(is_page('my-challenges'))echo ' class="active"'; ?>><a href="<?php echo site_url('my-challenges'); ?>">My Challenges</a></li>
					<?php if(current_user_can('create_users')){
					?>
					<li<?php if(is_page('All charts'))echo ' class="active"'; ?>><a href="<?php echo site_url('all-charts'); ?>">Run an Agency Report</a></li>
					<?php } ?>
			        <?php } ?>
            	</ul>
        	</div>
        	<div class="tab-pane<?php if(is_page('about')||is_page('how-it-works'))echo ' active'; ?>" id="tab_default_2">
				<ul class="sub-nav">
              		<li<?php if(is_page('about')) echo ' class="active"'; ?>><a href="<?php echo site_url('about'); ?>">About Challenge.Gov</a></li>
              		<li<?php if(is_page('how-it-works')) echo ' class="active"'; ?>><a href="<?php echo site_url('how-it-works');?>">How it works</a></li>
            	</ul>
       		</div>
        	<div class="tab-pane" id="tab_default_3">
			</div>
		</div>
    </nav>      
</header>
<?php if(is_page('list'))
{
	?>
<!-- Page Content -->
<div id="site-wrapper column">
	<div id="site-menu">
		<div class="sort">
			<div class="for-btn col-lg-9 col-md-8 col-sm-6 col-xs-3"><button id="showLeftPush" class="sortbtn pull-left">Sort <i class="fa fa-arrow-circle-o-right"></i></button></div>
				
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-9">
					<form class="form-inline search-form" accept-charset="UTF-8" action="//search.usa.gov/search" id="search_form" method="get">
                        <div class="from-group"><input name="utf8" type="hidden" value="&#x2713;" /></div>
						<div class="form-group">
							<input id="affiliate" name="affiliate" type="hidden" value="challenge.gov" />
							<label class="sr-only" for="query">Search</label>
							<input autocomplete="off" class="usagov-search-autocomplete form-control" id="query" name="query" type="text" />
							<input name="commit" type="submit" class="btn btn-default" value="Search" />
                		</div>
              		</form>
            	</div>
          	</div>
        	</div>
			<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left column col-lg-2 col-md-3 col-sm-4 col-xs-12" id="cbp-spmenu-s1">
          		 <!--	<h3>Sort <i class="fa fa-arrow-circle-o-left"></i></h3>-->
			  <form name="challenge_search_form" id="challenge_search_form">
         <div class="btn_row"><input type="button" id="submit_button" name="submit_button" value="Submit" class="btn btn-default"></div>
         <h3>Agency Search</h3>
                <div class="form-group">
                  <label class="sr-only" for="searchcontent">Agency Search</label>
                  <input type="search" class="form-control" name="search1" id="agency_name" placeholder="Agency Search">
                </div>
             
             <div class="divider"></div>
            <h3>Prize Amount Range</h3>
	     <div class="layout-slider">
		
   <p> 
    <label for="amount" class="priceamount">Prize Start From:</label>
    <input type="text" class="amount" id="slider1_amount" name="challenge_price_start" />
   </p>
   <div class="slider" id="slider1" data-begin="0" data-end="1000000"></div>
<p>
    <label for="amount" class="priceamount">Prize End To:</label>
    <input type="text" class="amount" id="slider2_amount" name="challenge_price_end" />
</p>
<div class="slider" id="slider2" data-begin="0" data-end="10000001" ></div>
    </div>
    <script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function($){
	
	
    $(".slider").each(function () {
        var begin = $(this).data("begin"),
            end = $(this).data("end");

        $(this).slider({
            range: "min",
            value: ($(this).attr('id') == 'slider1' ? 0 : 10000001),
            min: begin,
            max: end,
            slide: function (event, ui) {
                //update text box quantity
                var slideramount = ("#" + $(this).attr("id") + "_amount");
                if(ui.value > 10000000)
                	$(slideramount).val("10000000+");
                else
                	$(slideramount).val(ui.value);
            }
        })

        //initialise text box quantity
        var slideramount = ("#" + $(this).attr("id") + "_amount");
        if($(this).slider("value") > 10000000)
        	$(slideramount).val("10000000+");
        else
        	$(slideramount).val($(this).slider("value"));
    })

    //When text box is changed, update slider
    $('.amount').change(function () {
	
        var value = this.value,
        selector = $(this).parent('p').next();
        selector.slider("value", value);
    })
});
	
	
      //jQuery("#Slider2").slider({ from: 0, to: 1000000, heterogeneity: ['50/50000'], step: 1000, dimension: '&nbsp;$' });
    </script>
    
            <div class="divider"></div>
            <h3>Challenge Type</h3>
             <?php
		$field = get_field_object('field_5293da669ef07');
		
		if (isset($field["choices"]))
		{
			
			
		    foreach ($field["choices"] as $key => $choice) {
			
			if(!empty($choice))
			{
			    $this_link = challenge_strip_page(add_query_arg( 'type', $key ));
			    ?>
			    <div class="checkbox">
			    <label>
			      <input type="checkbox" value="<?php echo $key; ?>" name="challenge_type" checked><?php echo $choice; ?>
			    </label>
			  </div>
			    <?php
			    $i++;
			    
			}
		    }
		}
	 ?>
	


		
             
            <div class="divider"></div>
            <h3>Sort By</h3>
	   <span class="sort-selector">
	<select id="agency-sort" name="sort-agency" class="challenge-filter">
	<option value="<?php echo challenge_strip_page(remove_query_arg( 'sort' )); ?>">Newest Challenge</option>
	<option value="ending-date-desc">Submission Date - Latest</option>
	<option value="ending-date-asc">Submission Date - Oldest</option>
	<option value="ending-soon">Open - Ending Soonest</option>
	<option value="ending-latest">Open - Ending Latest</option>
	<option value="prize-desc">Prize - High to Low</option>
	<option value="prize-asc">Prize - Low to High</option>
	</select>
    </span>
             <div class="btn_row"><input type="button" id="submit_button1" name="submit_button1" value="Submit" class="btn btn-default"></div>
             </form>


        	</nav>
    </div>
<?php
}
?>
<!-- end challenge_gov_theme -->

	<!-- commented for now
	<div id="wrap" class="container">
	<div class="resize"></div>
	 -->

	<!--<header id="challenge-masthead" role="banner">
	<p id="masthead" class="challenge-row">-->


	    <?php
	    /*
	    if(current_user_can('create_users'))
	    {
	    	?>
	    	<span class="header-login-links">Logged In As:<a href="<?php echo site_url();?>/wp-admin">GSA Administrator </a> [<a href="<?php echo wp_logout_url(get_site_url().'/login'); ?>">Logout</a>]</span>
	    	<?php
	    }
	    else
	    {
	    	//$session_code = '009';  //testing code
			if(is_user_logged_in() && current_user_can('publish_posts'))
			{
				$session_code = get_max_agency_codes();
				$this_loggedin_link = get_permalink(max_agency_match_codes($session_code,'post-id'));
				if($hardcoded_links)
					$this_loggedin_link = challenge_permalink(max_agency_match_codes($session_code,'post-id'));
	    		?>
	    		<span class="header-login-links">Logged In As:<a href="<?php echo $this_loggedin_link; ?>"><?php echo max_agency_match_codes($session_code,'nice-name');?></a>User [<a href="<?php echo wp_logout_url(get_site_url().'/login'); ?>">Logout</a>]</span>
	    		<?php
	    	}
	    }
	    if(is_user_logged_in() && current_user_can('publish_posts'))
		  {
		  	?>
		  		<!--<center><span class="header-login-links login-links-left">-->
		  			<?php
		  				if($hardcoded_links)
		  				{
		  					?>
		  					<!-- <a href="<?php echo site_url();?>/create-new-challenge">Create New Challenge</a> | <a href="<?php echo site_url();?>/your-challenges">Your Challenges</a> | <a href="<?php echo site_url();?>/all-agencies">All Agencies</a> -->
		  					<?php
		  				}
		  				else
		  				{
		  					?>
		  					<!-- <a href="<?php echo site_url('','http');?>/create-new-challenge">Create New Challenge</a> | <a href="<?php echo site_url('','http');?>/your-challenges">Your Challenges</a> | <a href="<?php echo site_url('','http');?>/all-agencies">All Agencies</a> -->
		  					<?php
		  				}
		  			?>
		  		<!--</span></center>-->
		  	<?php
		  }*/
		  ?>
	<!--</p>
	</header>-->

	
	<?php
	// Check if this is a post or page, if it has a thumbnail, and if it exceeds defined HEADER_IMAGE_WIDTH
	if ( is_singular() && current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID ) 
	&& ( /* $src, $width, $height */
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ))
	&&
	$image[1] >= HEADER_IMAGE_WIDTH ) :
	// Houston, we have a new header image!
	$image_attr = array(
				'class'	=> "scale-with-grid",
				'alt'	=> trim(strip_tags( $attachment->post_excerpt )),
				'title'	=> trim(strip_tags( $attachment->post_title ))
				);
	echo '<div id="header_image" class="row sixteen columns">'.get_the_post_thumbnail( $post->ID, array("HEADER_IMAGE_WIDTH","HEADER_IMAGE_HEIGHT"), $image_attr ).'</div>';
	elseif ( get_header_image() ) : ?>
		<div id="header_image" class="row sixteen columns"><img class="scale-with-grid round" src="<?php header_image(); ?>" alt="" /></div>
	<?php endif; ?>	

<script language="javascript" type="text/javascript">
	
	
jQuery(document).ready(function($){
	
	$(".agency-name").mouseenter(function() {
		
		var postid;
		postid=$(this).attr('id');
		$("#agencyInfo_"+postid).show();
		$("#partneragency_"+postid).hide();
	});
	$(".challenge-thumbnail").mouseleave(function() {
		var postid;
		postid=$(this).find(".agency-name").attr('id');
		
		$("#agencyInfo_"+postid).hide();
		$("#partneragency_"+postid).hide();
	});
	
	$(".partner-icon").mouseenter(function() {
		
		var postid;
		postid=$(this).attr('id');
		$("#agencyInfo_"+postid).hide();
		$("#partneragency_"+postid).show();		
	});
	
function preparedata(link) {

if (link == null){
	
	link=1;
}
   
       var challenge_type = [];
       var challengedata=[];
            $.each($("input[name='challenge_type']:checked"), function(){            
                challenge_type.push($(this).val());
            });
	    var challengetype;
	    challengetype = challenge_type.join("||");
	   
	  
	     challengedata[0] = challengetype;
	    
	    var challengeprice;
	//challengeprice=$("input[name=challenge_price]").val();
	challengepricestart=$("input[name=challenge_price_start]").val();
	//challengepriceend=$("input[name=challenge_price_end]").val();
	challengepriceend= ($("input[name=challenge_price_end]").val() == "10000000+" ? "99999999" : $("input[name=challenge_price_end]").val());
	
	challengeprice=challengepricestart+";"+challengepriceend;
	
		//challengedata.push(challengeprice);
		challengedata[1] = challengeprice;
		
		sort=$("#agency-sort").val();
		
		challengedata[2]=sort;
		challengedata[3] =link;
		
		agency_name=$("#agency_name").val();
		
		challengedata[4] =agency_name;
		
		send_data(challengedata);
    
    
        return false; 
}
$('#challenge_show').on('click', '#pagination a', function(e){
        e.preventDefault();
	var link = $(this).attr('href');
	var pagenumber;
	
	pagenumber=link.match(/paged=(\d*)/);
	
	
	 preparedata(pagenumber[1]);
      
       
    });
$("#submit_button").click(function(e){
		e.preventDefault();
		preparedata(null);

});
$("#submit_button1").click(function(e){
		e.preventDefault();
		preparedata(null);

});
});


</script>	
 <script language="javascript" type="text/javascript">

send_data = function(challengedata) {

var dataarray;
 
challengetype=challengedata[0];
price=challengedata[1];
sortby=challengedata[2];
page=challengedata[3];
ag=challengedata[4];

jQuery.ajax({
	type : 'post',
	//dataType:"json",
        url: "<?php echo admin_url('admin-ajax.php');?>",
	
        data: {
	    
            'action':'challenge_display_posts',
            'type' : challengetype,
	    'price' : price,
	    'sort' : sort,
	    'page' : page,
	    'ag' : ag,
	    'loadthrough' : 'ajaxcall',
        },
	beforeSend: function($){
	jQuery('#loadingDiv').empty();
	jQuery('#loadingDiv').prepend('<img id="loading" src="<?php echo get_bloginfo('template_directory');?>/images/ajax-loader.gif" />')
	jQuery('#default_challenge').fadeOut(500);
	jQuery('#challenge_show').fadeOut(500);
	jQuery('#loadingDiv').fadeIn(600);
      },
         success : function( response ) {

		jQuery('#loadingDiv').hide();
		jQuery("#challenge_show").fadeIn(500);
		jQuery("#challenge_show").show().html(response);
		jQuery(".agency-name").mouseenter(function($) {
		
		var postid;
		postid=jQuery(this).attr('id');
		
		jQuery("#partneragency_"+postid).hide();
		jQuery("#agencyInfo_"+postid).show();
	});
	jQuery(".challenge-thumbnail").mouseleave(function($) {
		var postid;
		postid=jQuery(this).find(".agency-name").attr('id');
		
		jQuery("#agencyInfo_"+postid).hide();
		jQuery("#partneragency_"+postid).hide();
	});
	jQuery(".partner-icon").mouseenter(function() {
		
		var postid;
		postid=jQuery(this).attr('id');
		jQuery("#agencyInfo_"+postid).hide();
		jQuery("#partneragency_"+postid).show();		
	});
		
	 },
	  error : function(  ) {
		jQuery("#challenge_show").addClass('alert-danger');
		jQuery("#challenge_show").show().html('Sorry!, An error occur while procesing your input.');
	 }
	 
	 
    });

   
       

}

</script>
