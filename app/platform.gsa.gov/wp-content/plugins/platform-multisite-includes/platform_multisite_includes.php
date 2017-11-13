<?php
/*
    Plugin Name: Platform Multsite Includes
    Plugin URI: http://platform.gsa.gov
    Description: Includes necessary functions, Javascript and CSS files for Wordpress sites running on  <a href="http://www.platform.gsa.gov" title="Platform.GSA.Gov">Platform.GSA.Gov</a>.
    Author: CTAC
    Version: 1.0.1
    Author URI: http://www.ctacorp.com

    FedCMS DAP is released under GPL:
    http://www.opensource.org/licenses/gpl-license.php
*/

//* Password reset activation E-mail -> Body
add_filter( 'retrieve_password_message', 'plc_retrieve_password_message', 10, 2 );
function plc_retrieve_password_message( $message, $key ){
    $user_data = '';
    // If no value is posted, return false
    if( ! isset( $_POST['user_login'] )  ){
            return '';
    }
    // Fetch user information from user_login
    if ( strpos( $_POST['user_login'], '@' ) ) {

        $user_data = get_user_by( 'email', trim( $_POST['user_login'] ) );
    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }
    if( ! $user_data  ){
        return '';
    }
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    // Setting up message for retrieve password
    $message = "A request has been made to reset the password for the following account:\n\n";
    $message .= "USERNAME: ".$user_login."\n\n";
    $message .= "If this was a mistake, ignore this email and nothing will happen.\n\n";
    $message .= "To reset your password, visit the following address:\n\n";
    $message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login');
  
    // Return completed message for retrieve password
    return $message;
}

function forgotpass_message() {
 $action = $_REQUEST['action'];
 if( $action == 'lostpassword' ) {
 $message = '<p class="message">Please enter your username or email address. You will receive a link to create a new password via email which will include your USERNAME in case you have forgotten it.</p>';
 return $message;
 }
}
add_filter('login_message', 'forgotpass_message');

add_action('admin_head', 'admin_menu_fix');

function admin_menu_fix() {
  echo '<style>
    #adminmenu {
  		transform: translateZ(0);
		}
	.update-nag{display:none !important;}
  </style>';
}

function nounconfirmedemails(){
    ?>
    <style type="text/css">
	  #wpbody-content .listUsersWithUncofirmedEmail,
	  #wpbody-content .subsubsub span#separatorID{display:none;}
	</style>
    <?php
}
add_action('admin_head', 'nounconfirmedemails');


function show_site_users(){
	
	$users = get_users(array('orderby' => 'registered'));
	$unique_users = array();
	foreach($users as $user)
	{
		$unique_users[$user->ID] = $user->user_login;
	}
	foreach($unique_users as $id => $this_user)
	{
		echo $id.'<br/>';
	}
}
add_shortcode('show-site-users','show_site_users');

function platform_mc_admin_users_caps( $caps, $cap, $user_id, $args ){
 
    foreach( $caps as $key => $capability ){
 
        if( $capability != 'do_not_allow' )
            continue;
 
        switch( $cap ) {
            case 'edit_user':
            case 'edit_users':
                $caps[$key] = 'edit_users';
                break;
            case 'delete_user':
            case 'delete_users':
                $caps[$key] = 'delete_users';
                break;
            case 'create_users':
                $caps[$key] = $cap;
                break;
        }
    }
 
    return $caps;
}

/**
 * Checks that both the editing user and the user being edited are
 * members of the blog and prevents the super admin being edited.
 */
function platform_mc_edit_permission_check() {
    global $current_user, $profileuser;
 
    $screen = get_current_screen();
 
    get_currentuserinfo();
 
    if( ! is_super_admin( $current_user->ID ) && in_array( $screen->base, array( 'user-edit', 'user-edit-network' ) ) ) { // editing a user profile
        if ( is_super_admin( $profileuser->ID ) ) { // trying to edit a superadmin while less than a superadmin
            wp_die( __( 'You do not have permission to edit this user.' ) );
        } elseif ( ! ( is_user_member_of_blog( $profileuser->ID, get_current_blog_id() ) && is_user_member_of_blog( $current_user->ID, get_current_blog_id() ) )) { // editing user and edited user aren't members of the same blog
            wp_die( __( 'You do not have permission to edit this user.' ) );
        }
    }
 
}

if ( !function_exists( 'mc_admin_users_caps' ) || !function_exists( 'mc_edit_permission_check' ) ) {
    add_filter( 'map_meta_cap', 'platform_mc_admin_users_caps', 1, 4 );
    remove_all_filters( 'enable_edit_any_user_configuration' );
    add_filter( 'enable_edit_any_user_configuration', '__return_true');
    add_filter( 'admin_head', 'platform_mc_edit_permission_check', 1, 4 );
}

function stoppingbacks( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}

add_filter( 'xmlrpc_methods','stoppingbacks' );

function platform_mime_types($mime_types){
    $mime_types['pro'] = 'text/plain'; //Adding pro extension
    return $mime_types;
}
add_filter('upload_mimes', 'platform_mime_types', 1, 1);

function platform_show_site_users($atts){
	global $wpdb;

	$count = 0;
    $del_count = 0;
	$del_id = 0;
    $temp_del_id = 0;
    $sup_admin = 0;
    $skip = $_GET['skip'];
    $skip = !empty($skip) ? intval($skip) : 0;
    $foreground = $_GET['foreground'];
    if(empty($foreground)){
        echo 'Script running in background at '.date('Y-m-d H:i:s').'. Please allow 5 minutes until completion.';
        session_write_close();
        fastcgi_finish_request();
    }
    $querystr = "
    SELECT ID
    FROM $wpdb->users
    LIMIT 500
    OFFSET ".$skip."
 ";

    $user_query = $wpdb->get_results($querystr, OBJECT);
    if ( ! empty( $user_query) ) {
        foreach($user_query as $user)
        {
            $count++;
            if(is_super_admin( $user->ID )){
                $sup_admin++;
            }
            //User is not a super admin or member of parent site or FEB sites
            if(!is_super_admin( $user->ID ) && !is_user_member_of_blog( $user->ID, '1' ) && !is_user_member_of_blog( $user->ID, '21' ) && !is_user_member_of_blog( $user->ID, '31' ) && !is_user_member_of_blog( $user->ID, '41' ) && $count < 500){
                //Delete user, reassign content to super admin 'rmorris'
                $del_count++;
                $temp_del_id = $user->ID;
                wp_delete_user($user->ID, '61');
                if(wpmu_delete_user($user->ID)){
                    $del_id = $temp_del_id;
                }
            }
        }
    }
	echo 'Processed '.$count.' entries <br/>Users Deleted: '.$del_count.'<br/>Last ID deleted: '.$del_id.'<br/>Super Admins skipped: '.$sup_admin;
    echo '<br/>Query string: </br>'.$querystr;
}
add_shortcode('platform-show-site-users','platform_show_site_users');

add_action('admin_menu', 'platform_show_site_users_menu');
function platform_show_site_users_menu(){
    if(get_current_blog_id() == '1' && is_super_admin()){
        add_options_page('Show Site Users', 'Platform Show Site Users', 'manage_options','show_site_users', 'platform_show_site_users_admin_page');
    }
}

function platform_show_site_users_admin_page(){
	?>
	<div class="wrap" style="width:820px;"><div id="icon-options-general" class="icon32"><br /></div>
        <h2><?php _e("Platform Show Site Users"); ?></h2>

        <div class="metabox-holder" style="width: 800px;">
            <div class="postbox">
                <div id="general" class="inside" style="padding: 10px;">
                	<?php 
                    if(get_current_blog_id() == '1' && is_super_admin()){
                        if(isset($_GET['role']))
                            echo do_shortcode('[platform-show-site-users role="'.trim($_GET['role']).'"]');
                        else
                            echo do_shortcode('[platform-show-site-users]');
                    }
                	?>
                </div>
            </div>
        </div>
    </div>
    <?php
}


/* Disable WP-JSON */
add_action('init', function(){
    wp_deregister_script('wp-embed');
    add_filter('rest_enabled', '_return_false');
    add_filter('rest_jsonp_enabled', '_return_false');
    remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
});

/* Disable X-Frame-Options header since this is now being set by NGINX */
remove_action( 'login_init', 'send_frame_options_header', 10, 0 );
remove_action( 'admin_init', 'send_frame_options_header', 10, 0 );

?>