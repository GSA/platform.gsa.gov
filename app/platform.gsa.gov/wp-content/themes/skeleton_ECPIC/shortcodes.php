<?php
/**
* @package Skeleton WordPress Theme Framework
* @subpackage skeleton
* @author Simple Themes - www.simplethemes.com
**/

function st_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'st_one_third');

function st_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'st_one_third_last');

function st_two_thirds( $atts, $content = null ) {
   return '<div class="two_thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'st_two_thirds');

function st_two_thirds_last( $atts, $content = null ) {
   return '<div class="two_thirds last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_thirds_last', 'st_two_thirds_last');

// 1-4 col 

function st_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'st_one_half');


function st_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'st_one_half_last');


function st_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'st_one_fourth');


function st_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'st_one_fourth_last');

function st_three_fourths( $atts, $content = null ) {
   return '<div class="three_fourths">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths', 'st_three_fourths');


function st_three_fourths_last( $atts, $content = null ) {
   return '<div class="three_fourths last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourths_last', 'st_three_fourths_last');


function st_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'st_one_fifth');

function st_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'st_two_fifth');

function st_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'st_three_fifth');

function st_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'st_four_fifth');

//

function st_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'st_one_fifth_last');

function st_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'st_two_fifth_last');

function st_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'st_three_fifth_last');

function st_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'st_four_fifth_last');

// 1-6 col 

// one_sixth
function st_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'st_one_sixth');

function st_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'st_one_sixth_last');

// five_sixth
function st_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'st_five_sixth');

function st_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'st_five_sixth_last');


// Callouts

function st_callout( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'width' => '',
		'align' => ''
    ), $atts));
	$style;
	if ($width || $align) {
	 $style .= 'style="';
	 if ($width) $style .= 'width:'.$width.'px;';
	 if ($align == 'left' || 'right') $style .= 'float:'.$align.';';
	 if ($align == 'center') $style .= 'margin:0px auto;';
	 $style .= '"';
	}
   return '<div class="cta" '.$style.'>' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('callout', 'st_callout');



// Buttons
function st_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'size' => 'medium',
		'color' => '',
		'target' => '_self',
		'caption' => '',
		'align' => 'right'
    ), $atts));	
	$button;
	$button .= '<div class="button '.$size.' '. $align.'">';
	$button .= '<a target="'.$target.'" class="button '.$color.'" href="'.$link.'">';
	$button .= $content;
	if ($caption != '') {
	$button .= '<br /><span class="btn_caption">'.$caption.'</span>';
	};
	$button .= '</a></div>';
	return $button;
}
add_shortcode('button', 'st_button');


// Tabs
add_shortcode( 'tabgroup', 'st_tabgroup' );

function st_tabgroup( $atts, $content ){
	
$GLOBALS['tab_count'] = 0;
do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
	
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
}
$return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
}
return $return;

}

add_shortcode( 'tab', 'st_tab' );
function st_tab( $atts, $content ){
extract(shortcode_atts(array(
	'title' => '%d',
	'id' => '%d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array(
	'title' => sprintf( $title, $GLOBALS['tab_count'] ),
	'content' =>  do_shortcode($content),
	'id' =>  $id );

$GLOBALS['tab_count']++;
}


// Toggle
function st_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
		 'title' => '',
		 'style' => 'list'
    ), $atts));
	output;
	$output .= '<div class="'.$style.'"><p class="trigger"><a href="#">' .$title. '</a></p>';
	$output .= '<div class="toggle_container"><div class="block">';
	$output .= do_shortcode($content);
	$output .= '</div></div></div>';

	return $output;
	}
add_shortcode('toggle', 'st_toggle');


/*-----------------------------------------------------------------------------------*/
// Latest Posts
// Example Use: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]
/*-----------------------------------------------------------------------------------*/


function st_latest($atts, $content = null) {
	extract(shortcode_atts(array(
	"offset" => '',
	"num" => '5',
	"thumbs" => 'false',
	"excerpt" => 'false',
	"length" => '50',
	"morelink" => '',
	"width" => '100',
	"height" => '100',
	"type" => 'post',
	"parent" => '',
	"cat" => '',
	"orderby" => 'date',
	"order" => 'ASC'
	), $atts));
	global $post;
	
	$do_not_duplicate[] = $post->ID;
	$args = array(
	  'post__not_in' => $do_not_duplicate,
		'cat' => $cat,
		'post_type' => $type,
		'post_parent'	=> $parent,
		'showposts' => $num,
		'orderby' => $orderby,
		'offset' => $offset,
		'order' => $order
		);
	// query
	$myposts = new WP_Query($args);
	
	// container
	$result='<div id="category-'.$cat.'" class="latestposts">';

	while($myposts->have_posts()) : $myposts->the_post();
		// item
		$result.='<div class="latest-item clearfix">';
		// title
		if ($excerpt == 'true') {
			$result.='<h4><a href="'.get_permalink().'">'.the_title("","",false).'</a></h4>';
		} else {
			$result.='<div class="latest-title"><a href="'.get_permalink().'">'.the_title("","",false).'</a></div>';			
		}
		
		
		// thumbnail
		if (has_post_thumbnail() && $thumbs == 'true') {
			$result.= '<img alt="'.get_the_title().'" class="alignleft latest-img" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$height.'&amp;w='.$width.'"/>';
		}

		// excerpt		
		if ($excerpt == 'true') {
			// allowed tags in excerpts
			$allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<blockquote>,<img>,<span>,<p>';
		 	// filter the content
			$text = preg_replace('/\[.*\]/', '', strip_tags(get_the_excerpt(), $allowed_tags));
			// remove the more-link
			$pattern = '/(<a.*?class="more-link"[^>]*>)(.*?)(<\/a>)/';
			// display the new excerpt
			$content = preg_replace($pattern,"", $text);
			$result.= '<div class="latest-excerpt">'.st_limit_words($content,$length).'</div>';
		}
		
		// excerpt		
		if ($morelink) {
			$result.= '<a class="more-link" href="'.get_permalink().'">'.$morelink.'</a>';
		}
		
		// item close
		$result.='</div>';
  
	endwhile;
		wp_reset_postdata();
	
	// container close
	$result.='</div>';
	return $result;
}
add_shortcode("latest", "st_latest");

// Example Use: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]

/*-----------------------------------------------------------------------------------*/
// Creates an additional hook to limit the excerpt
/*-----------------------------------------------------------------------------------*/

function st_limit_words($string, $word_limit) {
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
	$words = explode(' ', $string);
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
	return implode(' ', array_slice($words, 0, $word_limit));
}


// Related Posts - [related_posts]
add_shortcode('related_posts', 'skeleton_related_posts');
function skeleton_related_posts( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<div class="st_relatedposts">';
		$retval .= '<h4>Related Posts</h4>';
		$retval .= '<ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		$retval .= '</div>';
		return $retval;
	}
	return;
}

// Break
function st_break( $atts, $content = null ) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'st_break');


// Line Break
function st_linebreak( $atts, $content = null ) {
	return '<hr /><div class="clear"></div>';
}
add_shortcode('clearline', 'st_linebreak');

function download_page_func($atts, $content = null) {
	
	global $post;
	$return_page = "";

		$ecpic_files = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) ); 
	        if ( $ecpic_files ) 
	        { 
	                foreach ( $ecpic_files as $attachment_id => $attachment )
	                {
	                    $return_page .= "<a href=\"".get_attachment_link($attachment_id)."\">".$attachment->post_title."</a><br/><br/>";
	                }
	        }
		wp_reset_postdata();

	return $return_page;
}
add_shortcode('download_page', 'download_page_func');

function highlight_this($atts, $content = null)
{
	extract(shortcode_atts(array(
	"color" => ''), $atts));

	$return_text = "<span class=\"highlight";

	$return_text .= $color != '' ? $color : "";
	
	$return_text .= "\">".$content."</span>";
	
	return $return_text;
}
add_shortcode('hlt', 'highlight_this');

function new_registration($atts, $content = null)
{

	global $wp_roles, $user_ID, $user_identity; get_currentuserinfo(); 

	$return_this = "";

	$http_post = ('POST' == $_SERVER['REQUEST_METHOD']);
	$resetDisplay = false;
	$user_login = '';
	$user_email = '';
	if ( $http_post && (wp_verify_nonce($_POST['ecpic-registration'],'verify-nonce') !== false)) {
		$user_login = sanitize_text_field($_POST['user_login']);
		$user_email = sanitize_text_field($_POST['user_email']);
		$user_phonenum = sanitize_text_field($_POST['phone']);
		$user_organization = sanitize_text_field($_POST['orgname']);
		$users_name = sanitize_text_field($_POST['users-name']);

		if($user_login == "" || $user_email == "" || $user_phonenum == "" || $user_organization == "" || $users_name == "")
		{
			if($user_login == "")
				$return_this .= "<span style=\"color:red;\">Username field cannot be blank or contain html tags.</span><br>";
			if($users_name == "")
				$return_this .= "<span style=\"color:red;\">Name field cannot be blank or contain html tags.</span><br>";
			if($user_email == "")
				$return_this .= "<span style=\"color:red;\">E-mail field cannot be blank or contain html tags.</span><br>";
			if($user_phonenum == "")
				$return_this .= "<span style=\"color:red;\">Phone number field cannot be blank or contain html tags.</span><br>";
			if($user_organization == "")
				$return_this .= "<span style=\"color:red;\">Organization field cannot be blank or contain html tags.</span><br>";
		}
		else
		{

		$rand_char_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    	$rand_num_special_set = '0123456789!@#$%^&*';

    	$ecpic_pwd = substr(str_shuffle($rand_char_set), 0, 5).substr(str_shuffle($rand_num_special_set), 0, 5).substr(str_shuffle($rand_char_set), 0, 5);

		$new_user = wpmu_create_user($user_login, $ecpic_pwd, $user_email);
		if(intval($new_user) > 0)
		{
			$resetDisplay = true;
			add_user_to_blog(get_current_blog_id(), $new_user, 'subscriber'); //Add to network blog 31 (ECPIC)
			update_usermeta($new_user, 'phone',$user_phonenum);
			update_usermeta($new_user, 'orgname',$user_organization);
			$return_this .= "Account <strong>".$user_login."</strong> with the email <strong>".$user_email."</strong> has been created.<br/>Please check your email for login instructions.<br/>&nbsp;";
			//EMAIL MESSAGE

			$message_headers = "From: \"eCPIC\" <no-reply@ecpic.gov>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
	 		$message = get_option('notify_on_register_user_message',"Thank you for registering with eCPIC.\n\nUsername: ".$user_login."\nPassword: ".$ecpic_pwd."\n\nhttp://www.ecpic.gov");
			$message = str_replace('USERS-NAME', $users_name, $message);
			$message = str_replace('USERNAME', $user_login, $message);
			$message = str_replace('USERPASS', $ecpic_pwd, $message);
			$message = str_replace('USEREMAIL', $user_email, $message);
			wp_mail($user_email, get_option('notify_on_register_email_subject','Welcome to eCPIC'), $message , $message_headers);
			$all_roles = $wp_roles->roles;

			if(get_option('notify_on_register_enable','') == 1)
			{
				$email_new_users = get_option('notify_on_register_primary_email','');

				foreach($all_roles as $key => $value)
				{
					if(get_option('notify_on_register_'.$key.'_enable','') == 1)
					{
						$user_query = new WP_User_Query( array( 'role' => $key, 'blog_id' => get_current_blog_id(), 'fields' => 'all_with_meta' ) );
						$query_results = $user_query->get_results();
						if(count($query_results) > 0)
						{
							foreach($query_results as $this_user)
							{
								$email_new_users .= ",".$this_user->user_email;
							}
						}
					}
				}

				 $message_headers = "From: \"".get_option('notify_on_register_name_from','eCPIC.gov')."\"<".get_option('notify_on_register_email_from','no-reply@ecpic.gov').">\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
				 $message = get_option('notify_on_register_message', 'A new user has registered with eCPIC.\n\nUser: '.$user_login.'\nEmail: '.$user_email);
				$message = str_replace('USERS-NAME', $users_name, $message);
				$message = str_replace('USERNAME', $user_login, $message);
				$message = str_replace('USERPASS', $ecpic_pwd, $message);
				$message = str_replace('USEREMAIL', $user_email, $message);
				 if(isset($_POST['phone']) && $_POST['phone'] != "")
					$message.= "\nNew User's Phone Number: ".$_POST['phone'];
				 if(isset($_POST['orgname']) && $_POST['orgname'] != "")
					$message.= "\nNew User's Organization: ".$_POST['orgname'];
				
			     wp_mail($email_new_users,get_option('notify_on_register_admin_subject','New eCPIC User has Registered'), $message , $message_headers);
			}
		}
		else
		{
			if($user_login != "" && $user_email != "")
				$return_this .= "Account ".$user_login." with the email ".$user_email." could not be created.<br/>Please try again.<br/>&nbsp;";
			else
				$return_this .= "Registration could not be processed.  Please Try again.<br/>&nbsp;";
		}
		}
	}
	if(true) //formerly $formDisplay
	{
	
		if (!$user_ID)
		{
			if($resetDisplay)
			{
				$user_email = "";
				$user_login = "";
				$user_phonenum = "";
				$user_organization = "";
				$users_name = "";
			}
			$return_this .= '<div id="login-register-password">
			<div class="tab_container_login">
				<div id="tab2_login" class="tab_content_login" style="">
					<form method="post" action="'.site_url('registration').'" class="wp-user-form">
						<input id="signupblog" type="hidden" name="signup_for" value="user" />
						<div class="username">
							<label for="user_login" style="width:120px;margin-bottom:10px;">';
							$return_this.='<span style="color:red;">*</span>Username';
							$return_this.=': </label>
							<input type="text" name="user_login" value="'.esc_attr(stripslashes($user_login)).'" size="25" id="user_login" />
						</div>';
			$return_this .= '<div class="usersname">
							<label for="users-name" style="width:120px;margin-bottom:10px;">'.'<span style="color:red;">*</span>Name'.': </label>
							<input type="text" name="users-name" value="'.esc_attr(stripslashes($users_name)).'" size="25" id="users-name" />
						</div><div class="useremail">
							<label for="user_email" style="width:120px;margin-bottom:10px;">'.'<span style="color:red;">*</span>E-mail'.': </label>
							<input type="text" name="user_email" value="'.esc_attr(stripslashes($user_email)).'" size="25" id="user_email" />
						</div>
						<div class="phonenum">
							<label for="phone" style="width:120px;margin-bottom:10px;">'.'<span style="color:red;">*</span>Phone number'.': </label>
							<input type="text" name="phone" value="'.esc_attr(stripslashes($user_phonenum)).'" size="25" id="phone" />
						</div>
						<div class="orgname">
							<label for="orgname" style="width:120px;margin-bottom:10px;">'.'<span style="color:red;">*</span>Organization'.': </label>
							<input type="text" name="orgname" value="'.esc_attr(stripslashes($user_organization)).'" size="25" id="orgname" />
						</div>
						<div class="login_fields">
							<input type="submit" name="user-submit" value="';
				$return_this .= 'Sign up!';
				$return_this .= '" class="user-submit"/>';
							$register = $_GET['register']; 
							if($register == true) { $return_this .= '<p>Check your email for the password!</p>'; }
				$return_this .= wp_nonce_field('verify-nonce','ecpic-registration',false,false);
				$return_this .= '<input type="hidden" name="redirect_to" value="'.$_SERVER['REQUEST_URI'].'?register=true" />
							<input type="hidden" name="user-cookie" value="1" />
						</div>
					</form>
					<span style="font-size:12px;"><strong>Please Note: </strong> Fields marked with <span style="color:red;">*</span> are required.</span>
				</div>
			</div>';

			} else { // is logged in 

			$return_this = '<div class="sidebox">
				<h3>Welcome, '.$user_identity.'</h3>
				<div class="usericon">';
					global $userdata;
					get_currentuserinfo();
					$return_this.= get_avatar($userdata->ID, 60);

				$return_this.='</div>
				<div class="userinfo">
					<p>You&rsquo;re logged in as <strong>'.$user_identity.'</strong></p>
					<p>
						<a href="'.wp_logout_url(home_url()).'" title="Logout">Logout</a>';
						if (current_user_can('manage_options')) { 
							$return_this.= ' | <a href="' . admin_url() . '">' . __('Admin') . '</a>'; } else { 
							$return_this.= ' | <a href="' . admin_url() . 'profile.php">' . __('Profile') . '</a>'; }
						$return_this.='
					</p>
				</div>';
			 } 
		$return_this.="</div>";
	}
	return $return_this;
}
add_shortcode('new-registration', 'new_registration');

function login_always_func( $atts ){
 global $user_identity;
 if ( is_user_logged_in())
 {
 	$return_string = "Logged in as:".$user_identity."<br /><a href=\"".wp_logout_url(home_url())."\">Click here to logout</a>";

 	if (current_user_can('manage_options')) { 
		$return_string .= ' | <a href="' . admin_url() . '">' . __('Admin') . '</a>'; } else { 
		$return_string .= ' | <a href="' . admin_url() . 'profile.php">' . __('Profile') . '</a>'; }
 }
	 $args = array('echo' => false,
	 	'label_username' => __( 'Name:' ),
	        'label_password' => __( 'Password:' ),
	        'remember' => false,
		'redirect' => site_url(),);
	$return_string = wp_login_form($args);
	$return_string .= "<div class=\"login-links\"><a href=\"/registration\">Register</a> | <a href=\"/forgot-password\">Forgot Password</a></div>";	 return $return_string;
}
add_shortcode( 'login-box-always-show', 'login_always_func' );

function reset_pass_func($atts){

	$return_string = "<form method=\"post\" action=\"".$_SERVER['REQUEST_URI']."\" class=\"wp-user-form\">
    <div class=\"reset_by_email\">
        <label for=\"reset_user_email\">Email: </label>
        <input type=\"text\" name=\"reset_user_email\" value=\"\" size=\"30\" class=\"input\" id=\"reset_user_email\" />
    </div>
    <div class=\"login_fields\">";
        $return_string .= do_action('login_form', 'resetpass');
        $return_string .= "<input type=\"submit\" name=\"user-submit\" value=\"Reset my password\" class=\"user-submit\" />";

	if (isset($_POST['reset_pass'])){
		global $wpdb;
	$username = trim($_POST['reset_user_email']);
	$user_exists = false;

	if( email_exists($username) ){
	        $user_exists = true;
	        $user = get_user_by_email($username);
	}else{
	    $error[] = '<p>'.__('Email was not found, try again!'). "<br />\n" . __('Please check that you have entered in your email address correctly.') . '</p>';
	}
	if ($user_exists){
	    $user_login = $user->user_login;
	    $user_email = $user->user_email;

	    /*
	    $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
	    if ( empty($key) ) {
	        // Generate something random for a key...
	        $key = wp_generate_password(20, false);
	        do_action('retrieve_password_key', $user_login, $key);
	        // Now insert the new md5 key into the db
	        $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
	    }
	    //$key = wp_hash_password( $key );
	    if ( empty($wp_hasher) ) {
			require_once( ABSPATH . 'wp-includes/class-phpass.php');
			// By default, use the portable hash from phpass

		}
	   	$wp_hasher = new PasswordHash(8, true);
		$hash = $wp_hasher->HashPassword($key);
		*/

	  //$key = wp_generate_password( 20, false );
	  $key = get_password_reset_key( $user );

		// Now insert the key, hashed, into the DB.
	  /*
		if ( empty( $wp_hasher ) ) {
			require_once ABSPATH . 'wp-includes/class-phpass.php';
			$wp_hasher = new PasswordHash( 8, true );
		}
		$hashed = $wp_hasher->HashPassword( $key );
		$wpdb->update( $wpdb->users, array( 'user_activation_key' => $hashed ), array( 'user_login' => $user_login ) );
		*/
	    //create email message
	    $message = __('Someone has asked to reset the password for the following site and username.') . "\r\n\r\n";
	    $message .= get_option('siteurl') . "\r\n\r\n";
		$message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
		$message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
		$message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
		$message .= '<' . site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "&redirect_to=".urlencode(get_option('siteurl')) . ">\r\n";
	    //send email meassage
	    $message_headers = "From: \"eCPIC Forgot Password\" <no-reply@ecpic.gov>\n" . "Content-Type: text/plain; charset=\"" . get_option('blog_charset') . "\"\n";
	    if (FALSE == wp_mail($user_email, sprintf(__('[%s] Password Reset'), get_option('blogname')), $message, $message_headers))
	    $error[] = '<p>' . __('The e-mail could not be sent.') . "<br />\n" . __('Please check that you have entered in your email address correctly.') . '</p>';
	}
	if (count($error) > 0 ){
	    foreach($error as $e){
	                $return_string .= $e . "<br/>";
	            }
	}else{
	  $return_string = '<p style="font-weight:bold;color:green;font-size:18px;">'.__('A message has been sent to your email address with instructions on how to reset your password.').'</p><br/>'.$return_string; 
	}
	}
	
    $return_string .= "<input type=\"hidden\" name=\"reset_pass\" value=\"1\" />
    </div>
</form>";
	return $return_string;
}
add_shortcode('reset-pass', 'reset_pass_func');


function reset_password_func($atts)
{
	global $wpdb;
	$errors = new WP_Error();
	nocache_headers();
	header('Content-Type: '.get_bloginfo('html_type').'; charset='.get_bloginfo('charset'));
	do_action( 'login_init' );
	do_action( 'login_form_' . $action );

	$key = $_GET['key'];
	$login = $_GET['login'];
	
	$key = preg_replace('/[^a-z0-9]/i', '', $key);

	if ( empty( $key ) || !is_string( $key ) )
		$user = new WP_Error('invalid_key', __('Invalid key'));

	if ( empty($login) || !is_string($login) )
		$user = new WP_Error('invalid_key', __('Invalid key'));

	$user = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $key, $login));

	if ( empty( $user ) )
		$user = new WP_Error('invalid_key', __('Invalid key'));
	//$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'error';
	
	//$user = check_password_reset_key($_GET['key'], $_GET['login']);

	/*if ( is_wp_error($user) ) {
		wp_redirect( site_url('wp-login.php?action=lostpassword&error=invalidkey') );
		exit;
	}*/
	$errors = '';

	if ( isset($_POST['pass1']) && $_POST['pass1'] != $_POST['pass2'] ) {
		$errors = new WP_Error('password_reset_mismatch', __('The passwords do not match.'));
	} elseif ( isset($_POST['pass1']) && !empty($_POST['pass1']) ) {
		reset_password($user, $_POST['pass1']);
		login_header( __( 'Password Reset' ), '<p class="message reset-pass">' . __( 'Your password has been reset.' ) . ' <a href="' . esc_url( wp_login_url() ) . '">' . __( 'Log in' ) . '</a></p>' );
		login_footer();
		exit;
	}
	wp_enqueue_script('utils');
	wp_enqueue_script('user-profile');
	//login_header(__('Reset Password'), '<p class="message reset-pass">' . __('Enter your new password below.') . '</p>', $errors );
/*
$return_string = "";
$return_string .= '<form name="resetpassform" id="resetpassform" action="'.esc_url( site_url( 'wp-login.php?action=resetpass&key=' . urlencode( $_GET['key'] ) . '&login=' . urlencode( $_GET['login'] ), 'login_post' ) ). '" method="post">
	<input type="hidden" id="user_login" value="'.esc_attr( $_GET['login'] ).'" autocomplete="off" />
	<p>
		<label for="pass1">'. _e('New password') .'<br />
		<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" /></label>
	</p>
	<p>
		<label for="pass2">'. _e('Confirm new password') .'<br />
		<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" /></label>
	</p>

	<div id="pass-strength-result" class="hide-if-no-js">' . _e('Strength indicator') .'</div>
	<p class="description indicator-hint">' . _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ') . '</p>

	<br class="clear" />
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="' . esc_attr_e('Reset Password') . '" tabindex="100" /></p>
</form>

<p id="nav">
<a href="' . esc_url( wp_login_url() ) . '">'. _e( 'Log in' ) .'</a>';
if ( get_option( 'users_can_register' ) ) :
 $return_string .= '| <a href="'. esc_url( site_url( 'wp-login.php?action=register', 'login' ) ) . '">' . _e( 'Register' ) . '</a>';
endif;
$return_string .= '</p>';

login_footer('user_pass');
echo $return_string;*/

?>
<form name="resetpassform" id="resetpassform" action="<?php echo esc_url( site_url( 'wp-login.php?action=resetpass&key=' . urlencode( $_GET['key'] ) . '&login=' . urlencode( $_GET['login'] ), 'login_post' ) ); ?>" method="post">
	<input type="hidden" id="user_login" value="<?php echo esc_attr( $_GET['login'] ); ?>" autocomplete="off" />

	<p>
		<label for="pass1"><?php _e('New password') ?><br />
		<input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" /></label>
	</p>
	<p>
		<label for="pass2"><?php _e('Confirm new password') ?><br />
		<input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" /></label>
	</p>

	<div id="pass-strength-result" class="hide-if-no-js"><?php _e('Strength indicator'); ?></div>
	<p class="description indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).'); ?></p>

	<br class="clear" />
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="<?php esc_attr_e('Reset Password'); ?>" tabindex="100" /></p>
</form>

<p id="nav">
<a href="<?php echo esc_url( wp_login_url() ); ?>"><?php _e( 'Log in' ); ?></a>
<?php if ( get_option( 'users_can_register' ) ) : ?>
 | <a href="<?php echo esc_url( site_url( 'wp-login.php?action=register', 'login' ) ); ?>"><?php _e( 'Register' ); ?></a>
<?php endif; ?>
</p>

<?php
login_footer('user_pass');
}
add_shortcode('reset-password', 'reset_password_func');

function search_form_func()
{
	return get_search_form( false );
}
add_shortcode('search-form-here', 'search_form_func');

function sidebar_downloads_func()
{
	$return_string = "";
	if(is_user_logged_in())
	{
		if(current_user_can('administrator') || current_user_can('curator') || current_user_can('ecpicadmin') || current_user_can('ecpicuser') || current_user_can('grasshopper'))
		{
		$return_string = '<hr /><h1>Downloads:</h1>';
		if(current_user_can('administrator') || current_user_can('curator') || current_user_can('ecpicadmin'))
		{
			$return_string .= '<span class="sidebar_arrow">&gt;</span><a href="/materials-for-administrator">eCPIC Administrators</a><hr />';
		}
		if(current_user_can('administrator') || current_user_can('curator') || current_user_can('ecpicadmin') || current_user_can('ecpicuser'))
		{
			$return_string .= '<span class="sidebar_arrow">&gt;</span><a href="/materials-for-user">eCPIC Users</a><hr />';
		}
		if(current_user_can('administrator') || current_user_can('curator') || current_user_can('ecpicadmin') || current_user_can('ecpicuser') || current_user_can('grasshopper'))
		{
			$return_string .= '<span class="sidebar_arrow">&gt;</span><a href="/introductory-materials">Introductory Materials</a>';
		}
		}
	}
return $return_string;
}
add_shortcode('sidebar-downloads', 'sidebar_downloads_func');