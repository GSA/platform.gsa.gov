<?php
/*
Template Name: Sales Letter Template 1
*/


error_reporting(E_ALL);
ini_set("display_errors", 1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title(' '); ?> <?php if(wp_title(' ', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/sales-letter.css" type="text/css" media="screen" />

</head>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<body class="sales-letter">

<div class="post clearfix">
	<?php /* <h1 class="page-title"><?php the_title(); ?></h1> */ ?>
	<?php the_content(); ?>
</div>

<div id="footer" class="clearfix">
	&copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. <?php _e("All rights reserved.", "solostream"); ?>
</div>

<?php endwhile; endif; ?>
SERVER TESTING 002
<?php

// Returns a trusted URL for a view on a server for the
// given user.  For example, if the URL of the view is:
//    http://tabserver/views/MyWorkbook/MyView
//
// Then:
//   $server = "tabserver";
//   $view_url = "views/MyWorkbook/MyView";
//
function get_trusted_url($user,$server,$view_url) {
  $params = ':embed=yes&:toolbar=yes';

  $ticket = get_trusted_ticket($server, $user, $_SERVER['REMOTE_ADDR']);
  if (strcmp($ticket, "-1") != 0) {
    return "https://$server/trusted/$ticket/$view_url?$params";
  }
  else 
    return 0;
}

// Note that this function requires the pecl_http extension. 
// See: http://pecl.php.net/package/pecl_http

// the client_ip parameter isn't necessary to send in the POST unless you have
// wgserver.extended_trusted_ip_checking enabled (it's disabled by default)
function get_trusted_ticket($wgserver, $user, $remote_addr) {
  $params = array(
    'username' => $user,
    'client_ip' => $_SERVER['HTTP_USER_AGENT']
  );

    $ch = curl_init();
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_VERBOSE, 1);
	curl_setopt ($ch, CURLOPT_HEADER,  1);
	curl_setopt ($ch, CURLINFO_HEADER_OUT, 1);
	curl_setopt ($ch, CURLOPT_URL, "https://$wgserver/trusted" );
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt ($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $params);
	$ticket_response = curl_exec    ($ch);
	$ticket_error    = curl_error   ($ch);
	$ticket_info     = curl_getinfo ($ch);
	$header_size     = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
	$ticket_headers  = explode("\r\n",substr($ticket_response, 0, $header_size));
	$ticket          = substr($ticket_response, $header_size);
    /*
    var_dump($ticket_error);
    var_dump($ticket_response);
    
    echo "[$ticket]";
    die;
    */
	//$ticket_headers = array();
	//$ticket = $ticket_response;
	curl_close ($ch);

    return $ticket;
}

?>

<p>An embedded view appears below:</p>

<iframe src="<?php echo get_trusted_url('web_user','tableau.benchmarks.gsa.gov','views/PMA_Acquisition_20141008_final/CompareAgencies')?>"
        width="400" height="400">
</iframe>

<p>
This was created using trusted authentication.
</p>

<?php wp_footer(); ?>

</body>

</html>