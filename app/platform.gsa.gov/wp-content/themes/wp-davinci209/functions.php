<?php
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

// Theme Settings Page
require_once(TEMPLATEPATH . "/theme-settings.php");

// Theme Styles
require_once(TEMPLATEPATH . "/theme-styles.php");

// Theme Widgets
require_once(TEMPLATEPATH . "/theme-widgets.php");

// Load Custom Post Options for Write Post and Write Page
require_once(TEMPLATEPATH . "/theme-metaboxes.php");

// Load Theme Javascript
require_once(TEMPLATEPATH . "/theme-js.php");

// Theme Image Functions
require_once(TEMPLATEPATH . "/theme-images.php");

// Register widgetized areas
function theme_widgets_init() {
	register_sidebar(array (
		'name'=>'Sidebar-Wide - Top',
		'id'=>'widget-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Sidebar-Wide - Bottom Left',
		'id'=>'widget-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Sidebar-Wide - Bottom Right',
		'id'=>'widget-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Sidebar-Narrow',
		'id'=>'widget-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Footer Widget 1',
		'id'=>'widget-5',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Footer Widget 2',
		'id'=>'widget-6',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Footer Widget 3',
		'id'=>'widget-7',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Footer Widget 4',
		'id'=>'widget-8',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Alt Home Page Widget 1',
		'id'=>'widget-9',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Alt Home Page Widget 2',
		'id'=>'widget-10',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
	register_sidebar(array (
		'name'=>'Alt Home Page Widget 3',
		'id'=>'widget-11',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widgettitle"><span>',
		'after_title' => '</span></h3>',
		));
}

add_action( 'init', 'theme_widgets_init' );

// Get image path for WP Network sites
function get_network_image_path ($img_src) {
	global $blog_id;
	if ( isset($blog_id) && $blog_id > 0 ) {
		$imageParts = explode('/files/', $img_src);
		if (isset($imageParts[1])) {
			$img_src = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
		}
	}
	return $img_src;
}

// Add thickbox to single post pages that use thickbox class
function solo_add_thickbox() {
	global $post;
	if ( is_singular() && strpos($post->post_content,'class="thickbox"') !== false ) {
		add_thickbox();
	}
}

add_action('wp_print_styles','solo_add_thickbox');

// Add Excerpt field to Pages
add_post_type_support( 'page', 'excerpt' );

// Add RSS Feed Links
add_theme_support( 'automatic-feed-links' );

// Add support for WP 3.0 Menu Management
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}

if (function_exists('register_nav_menus')) {
	function register_my_menus() {
		register_nav_menus(array(
			'topnav' => __( 'Top Navigation' ),
			'catnav' => __( 'Category Navigation' ),
			'footernav' => __( 'Footer Navigation' )
			)
		);
	}
add_action( 'init', 'register_my_menus' );
}

function nav_fallback() { ?>
	<?php wp_page_menu( array( 'show_home' => 'Home', 'sort_column' => 'menu_order' ) ); ?>
<?php }

function footnav_fallback() { ?>
	<ul><?php wp_list_pages( array( 'depth' => 1, 'title_li' => '', 'sort_column' => 'menu_order' ) ); ?></ul>
<?php }

function catnav_fallback() { ?>
	<ul class="clearfix"><?php wp_list_categories('title_li='); ?></ul>
<?php }

// Checks for active Page Template File
function is_pagetemplate_active($pagetemplate = '') {
	global $wpdb;
	$sql = "select meta_key from $wpdb->postmeta where meta_key like '_wp_page_template' and meta_value like '" . $pagetemplate . "'";
	$result = $wpdb->query($sql);
	if ($result) {
		return TRUE;
	} else {
		return FALSE;
	}
}

// Get custom field value.
function get_custom_field($key, $echo = FALSE) {
	global $post;
	$custom_field = get_post_meta($post->ID, $key, true);
	if ($echo == FALSE) return $custom_field;
	echo $custom_field;
}

// Ready the theme for translation
load_theme_textdomain("solostream");

// Add Twitter and other social media links to user profile
add_filter('user_contactmethods','add_twitter_contactmethod',10,1);
function add_twitter_contactmethod( $contactmethods ) {
	$contactmethods['twitter'] = 'Twitter Username';
	$contactmethods['facebook'] = 'Facebook Username';
	$contactmethods['googbuzz'] = 'Google Plus Username';
	$contactmethods['linkedin'] = 'LinkedIn Username';
	$contactmethods['flickr'] = 'Flickr Username';
	$contactmethods['youtube'] = 'Youtube Username';

	return $contactmethods;
}

// This function limits the number of words in the magazine home page excerpt.
function string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

// This function lists pings/trackbacks.
function list_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
        <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> | <?php comment_date(); ?>
<?php }

// Add rel="nofollow" to the read more link.
function add_nofollow_to_more_links($content) {
	return preg_replace("@class=\"more-link\"@", "class=\"more-link\" rel=\"nofollow\"", $content);
}

add_filter('the_content', 'add_nofollow_to_more_links');

// Remove the default border from gallery thumbnails.
add_filter( 'gallery_style', 'remove_gallery_border' );

function remove_gallery_border( $galleryStyles ) {

	// Set the string we want to remove from the default style declaration.
	$remove = "border: 2px solid #cfcfcf;";

	// Remove it.
	$galleryStyles = str_replace( $remove, '', $galleryStyles );

	return $galleryStyles ;
}


function omb_login_msg($msg)
{
  global $omb_max_plugin;
  if ( empty($msg) && !empty($omb_max_plugin->options['unauth_group_msg']) ) 
  {
	$msg = $omb_max_plugin->options['unauth_group_msg'];
  } else {
  	$msg = 'Your account is not part of an authorized OMB-Max Group.';
  }
  $msg = str_replace('%maxuser%',OMBMax::get('user'),$msg);
  $msg = str_replace('%maxgroups%',OMBMax::get('GroupList'),$msg);
  return $msg;
}

function check_omb_on_login()
{

  if($GLOBALS['pagenow'] != 'wp-login.php')
    return;

  phpCAS::setFixedServiceURL(get_site_url().'/wp-login.php?ombAuth=1&t=1');
  if( OMBMax::isAuthenticated() && isset($_GET['ombAuth']) && @$_GET['ombAuth'] == '1')
  {
    $allowed_groups = array(
      'AGY-GSA-BENCHMARKS-APPS.APPADMINS' => array( 'rank'=>10, 'role'=>'administrator' ),
      'AGY-GSA-BENCHMARKS-APPS.USERS'     => array( 'rank'=>2,  'role'=>'subscriber'    ),
      'EXECUTIVE_BRANCH'                  => array( 'rank'=>1, 'role'=>'subscriber' )
    );
    $max_groups = explode(',',OMBMax::get('GroupList'));

    if ( empty($max_groups) )
    {
    	/// maybe: continue on with matching email to existing user, and remove the user from wp all-together
		unset($_GET['ombAuth']);
    	$_SESSION['otp_login_message'] = omb_login_msg();
	    wp_redirect(get_site_url().'/wp-login.php?'.http_build_query($_GET));
	    exit;
    }
    $set_role = array('rank'=>0,'role'=>'');
    foreach ( $max_groups as $max_group )
    {
    	$g = strtoupper(trim($max_group));
    	if ( !empty( $allowed_groups[$g] ) )
    	{
    		if ( $allowed_groups[$g]['rank'] > $set_role['rank'] )
    		{
    			$set_role = $allowed_groups[$g];
    		}
    	}
    }
	if ( empty($set_role['role']) )
	{
    	/// maybe: continue on with matching email to existing user, and remove the user from wp all-together
		unset($_GET['ombAuth']);
    	$_SESSION['otp_login_message'] = omb_login_msg();
	    wp_redirect(get_site_url().'/wp-login.php?'.http_build_query($_GET));
    	exit;
	}
	$user_email = OMBMax::get('Email-Address');
    $email_exists = email_exists($user_email);
    if(!$email_exists)
    {
      $user_login = strtolower(substr(OMBMax::get('First-Name'),0,1).OMBMax::get('Last-Name'));
      $user_exists = username_exists($user_login);
      $user_login_original = $user_login;
      $user_counter = 1;
      $max_counter = 30;
      if($user_exists)
      {
        while(username_exists($user_login))
        {
          $user_login = $user_login_original.$user_counter;
          $user_counter++;
          if($user_counter > $max_counter)
            break;
        }
      }

      $user_email = OMBMax::get('Email-Address');
      //validation on user login / email / any other req fields
      $rand_char_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$rand_num_special_set = '0123456789!@#$%^&*';
	$new_pwd = substr(str_shuffle($rand_char_set), 0, 10).substr(str_shuffle($rand_num_special_set), 0, 10).substr(str_shuffle($rand_char_set), 0, 10);
      $new_user = wpmu_create_user($user_login, $new_pwd, $user_email);
      if(intval($new_user) > 1)
      {
        add_user_to_blog(get_current_blog_id(), $new_user, $set_role['role']);
        //wpmu_welcome_user_notification($new_user, $new_pwd, $meta = ''); // send email
        //confirm_user_signup($user_login, $user_email); //Display user confirmation after post
        wp_set_auth_cookie($new_user);
        wp_set_current_user($new_user);
        if(isset($_GET['redirect_to']) && @$_GET['redirect_to'] != '')
        {
          wp_redirect($_GET['redirect_to']);
          exit;
        }
        else
        {
          wp_redirect(get_site_url());
          exit;
        }
      }
      else
      {
        //echo 'User could not be created.  Please Contact the system administrator.';
		unset($_GET['ombAuth']);
		$_SESSION['otp_login_message'] = omb_login_msg('User could not be created.  Please Contact the system administrator.');
        wp_redirect(get_site_url().'/wp-login.php?'.http_build_query($_GET));
	    exit;
      }
    }
    else //email exists already
    {
      // if(!is_user_member_of_blog($email_exists,get_current_blog_id()))
      // {//user is NOT a member of this blog, add them and login.
      add_user_to_blog(get_current_blog_id(), $email_exists, $set_role['role']);
      // }

      wp_set_auth_cookie($email_exists);
      wp_set_current_user($email_exists);
      if(isset($_GET['redirect_to']) && @$_GET['redirect_to'] != '')
      {
        wp_redirect($_GET['redirect_to']);
        exit;
      }
      else
      {
        wp_redirect(get_site_url());
        exit;
      }

    }
  }
}

function get_tableau_ticket()
{
	global $post;
	global $current_user;

    if ( !is_user_logged_in() ) { return; } // !is_page(1322) ||

	get_currentuserinfo();
	//if ( $current_user->user_login !== 'enarkiewicz' ) return;

	$landing_page_id     = 1912;
	$bench_parent_path   = 'benchmarks';
	$tableau_session_key = 'workgroup_session_id';
	$int_tabhost = 'https://app.benchmarks.gsa.gov'; //172.23.64.50';
	$ext_tabhost = 'https://tableau.benchmarks.gsa.gov';
	$benchhost   = 'https://benchmarks.gsa.gov';
	$post_params = 'username=web_user';
	/// need a valid resource to pass auth cookie onto user
	$workbook    = 'views/PMA_Acquisition_20141008_final/CompareAgencies';
	$get_params  = '';

	// if this is the landing page, kill a ticket
	// tableau's login/auth page redirects here, so if there is any error this will be
	// first step in resetting auth
/*
	if ( $post->ID == $landing_page_id && isset($_COOKIE[$tableau_session_key]) )
	{
		setcookie($tableau_session_key,'',1,'/',".gsa.gov",true,true);
		return;
	}
*/
	/*
	if ( $post->ID == $landing_page_id && isset($_COOKIE[$tableau_session_key]) )
	{
		setcookie($tableau_session_key,'',0,'/',".gsa.gov",true,true);
		return;
	}
	setcookie($tableau_session_key,'',0,'/',".gsa.gov",true,true);
	unset($_COOKIE[$tableau_session_key]);
	*/

	// if this is a benchmarks page, get a ticket
	$benchmarks_page = get_page_by_path($bench_parent_path);
	if ( empty($benchmarks_page) || empty($benchmarks_page->ID) ) { return; }
	if ( !in_array($benchmarks_page->ID,get_post_ancestors($post->ID)) && $post->ID!==$benchmarks_page->ID ) { return; }
	
	
	return;

	/// workgroup_session_id means we already went through tableau auth
	//if ( !empty($_COOKIE[$tableau_session_key]) ) { return; }
	//print "<pre> <!-- ";
	
	// ENHANCED LOGGING -- THIS SHOULD BE REMOVED AT SOME POINT!
	//$wpdb->query("break") or die(mysql_error());
	$sql = "
		DROP TABLE `tableau_logs`;
		CREATE TABLE IF NOT EXISTS `tableau_logs` (
			`id` bigint(20) unsigned NOT NULL,
			`created` datetime NOT NULL,
			`wp_user` varchar(255) NOT NULL,
			`request_url` varchar(255) NOT NULL,
			`user_agent` varchar(255) NOT NULL,
			`remote_ip` varchar(255) NOT NULL,
			`post_params` varchar(255) NOT NULL,
			`curl_error` mediumtext NOT NULL,
			`curl_info` mediumtext NOT NULL,
			`curl_headers` mediumtext NOT NULL,
			`curl_body` mediumtext NOT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		ALTER TABLE `tableau_logs`
			ADD PRIMARY KEY (`id`);
		ALTER TABLE `tableau_logs`
			MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
		";
	//require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	//dbDelta($sql);
	
	$current_user = wp_get_current_user();
	
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_VERBOSE, 1);
	curl_setopt ($ch, CURLOPT_HEADER,  1);
	curl_setopt ($ch, CURLINFO_HEADER_OUT, 1);
	curl_setopt ($ch, CURLOPT_URL, "{$int_tabhost}/trusted" );
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $post_params);
	$ticket_response = curl_exec    ($ch);
	$ticket_error    = curl_error   ($ch);
	$ticket_info     = curl_getinfo ($ch);
	$header_size     = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$ticket_headers  = explode("\r\n",substr($ticket_response, 0, $header_size));
	$ticket          = substr($ticket_response, $header_size);
	//$ticket_headers = array();
	//$ticket = $ticket_response;
	curl_close ($ch);
	//global $wpdb;
	$sql1 = "INSERT INTO tableau_logs (created, request_url, wp_user, user_agent, remote_ip, post_params, curl_error, curl_info, curl_headers, curl_body) VALUES
		(NOW(), '{$int_tabhost}/trusted', '{$current_user->user_login}', '{$_SERVER['HTTP_USER_AGENT']}', '{$_SERVER['REMOTE_ADDR']}', '{$post_params}', '".addslashes($ticket_error)."', '".addslashes(print_r($ticket_info, true))."', '".addslashes(print_r($ticket_headers, true))."', '".addslashes($ticket)."');";
	
	if ( empty($ticket) ) return;
	
	sleep(3);

    $url = "{$int_tabhost}/trusted/{$ticket}/{$workbook}/?{$get_params}";
    //print_r(array('returned ticket'=>$ticket,'next_request'=>$url,'ticket_info'=>$ticket_info,'ticket_err'=>$ticket_error,'response_headers'=>$ticket_headers));
    $ch = curl_init();
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch, CURLOPT_COOKIEFILE, '');
    curl_setopt ($ch, CURLOPT_VERBOSE, 1);
    curl_setopt ($ch, CURLOPT_HEADER,  1);
    curl_setopt ($ch, CURLINFO_HEADER_OUT, 1);
    curl_setopt ($ch, CURLOPT_URL, $url );
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $response = curl_exec    ($ch);
    $error    = curl_error   ($ch);
    $info     = curl_getinfo ($ch);
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headers     = explode("\r\n",substr($response, 0, $header_size));
    $body        = substr($response, $header_size);
    curl_close ($ch);
    //print_r(array('using ticket'=>$ticket,'requested_url'=>$url,'info'=>$info,'err'=>$error,'response_headers'=>$headers,'response_body'=>htmlentities($body)));
	
	$sql2 = "INSERT INTO tableau_logs (created, request_url, wp_user, user_agent, remote_ip, post_params, curl_error, curl_info, curl_headers, curl_body) VALUES
			(NOW(), '{$url}', '{$current_user->user_login}', '{$_SERVER['HTTP_USER_AGENT']}', '{$_SERVER['REMOTE_ADDR']}', '', '".addslashes($error)."', '".addslashes(print_r($info, true))."', '".addslashes(print_r($headers, true))."', '".addslashes($body)."');";
	
	//require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	//dbDelta("{$sql1} {$sql2}");
	
	echo "<!-- SessionStateTesting001: \n\n$sql1\n$sql2 -->";
	
	//echo "<!--\n";
	//$results = $wpdb->get_results( 'SELECT * FROM tableau_logs', OBJECT );
	//var_dump($results);
	//echo "-->\n";
	
    foreach ($headers as $h)
    {
        if ( preg_match("/^Set-Cookie: /i",$h) )
        {
			$added_domain = preg_replace("/;\s+domain=[^;]+/i","${1}, .gsa.gov",$h);
			if ( $added_domain===$h )
			{
				$h .= "; Domain=.gsa.gov";
			} else {
				$h = $added_domain;
			}
            header($h);
        }
	}
}

function benchmarks_force_ssl()
{
   if (!is_ssl())
   {
       header('HTTP/1.1 301 Moved Permanently');
       header('Location: https://' . $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
       exit;
    }
}

if ( get_current_blog_id()==81 )
{
    add_action('init','benchmarks_force_ssl');
	if ( class_exists('OMBMax') )
	{
	  add_action('init', 'check_omb_on_login');
	}
	add_action('wp', 'get_tableau_ticket');
}
