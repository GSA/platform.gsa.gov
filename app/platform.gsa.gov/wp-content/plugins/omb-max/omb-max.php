<?php
/*
Plugin Name: OMB Max Auth - DO NOT ACTIVATE
Version: 1.0.1
Plugin URI: http://max.gov
Description: Allow Wordpress to have the option of authenticating users via <a href="http://max.gov">OMB MAX</a>.
Author: Sites.USA.Gov
Author URI: http://sites.usa.gov
*/

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'options-page.php');
require_once 'OMBMax.class.php';
require_once( ABSPATH . "wp-includes/pluggable.php" );

register_deactivation_hook( __FILE__, 'ombmax_plugin_uninstall');

function ombmax_plugin_uninstall() {
    delete_option('omb_max_options');
}

class OMBMAXAuthenticationPlugin {
	var $db_version = 2;
	var $option_name = 'omb_max_options';
	var $options;

	function OMBMAXAuthenticationPlugin() {
		//$this->checkOMB();
		$this->options = get_option($this->option_name);

		if (is_admin()) {
			$options_page = new OMBMAXAuthenticationOptionsPage($this, $this->option_name, __FILE__, $this->options);
			add_action('admin_init', array($this, 'check_options'));
		}
		add_action('init', array($this, 'add_init_omb_max'),1);
		add_action('init', array($this, 'add_login_omb_max'),1);
		add_action('login_head', array($this, 'add_login_ombmax_head'));
        add_action('wp_logout', array($this, 'omb_clean_logout'),1);
        if(get_current_blog_id() != '81'){
        	//Not Benchmarks Site on Platform.gsa.gov
        	add_filter('allow_password_reset', array($this, 'ombmax_allow_password_reset_func'), 10, 2 );
			add_filter('wp_authenticate_user', array($this,'ombmax_check_auth_login'),10,2);
		}
		
		if ($this->allow_omb_auth())
			add_action('login_footer', array($this, 'add_login_link'));
        
		if(in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' )))
		{
			$options = get_option('omb_max_options','');

			if(get_current_blog_id() != '81'){
				if(isset($options['override_lostpass']) && $options['override_lostpass'] == '1'){
					// fixes URLs in email that goes out.
					add_filter("retrieve_password_message", function ($message, $key) {
					  	return str_replace(get_site_url(1), get_site_url(), $message);
					}, 10, 2);
					// fixes email title
					add_filter("retrieve_password_title", function($title) {
						return "[" . wp_specialchars_decode(get_option('blogname'), ENT_QUOTES) . "] Password Reset";
					});
				}
			}

			if($options['force_ombmax']) {
				add_action('login_head', array($this,'hide_wp_login'));
                remove_action('authenticate', 'wp_authenticate_username_password', 20);
            }

			if($options['force_site_auth'] && !is_user_logged_in())
				add_action('login_head', array($this,'hide_wp_back_link'));

			if(get_current_blog_id() == 432) // check whether it is benchmark or not
				add_action('login_head', array($this,'hide_wp_back_link'));
		}
        if( !current_user_can('activate_plugins') ) {
        	function mytheme_admin_bar_render() {
        		global $wp_admin_bar;
        		$wp_admin_bar->remove_menu('edit-profile', 'user-actions');
        	}
        	add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
        
        	function stop_access_profile() {
        		if(IS_PROFILE_PAGE === true) {
        			wp_die( 'Please contact your administrator to have your profile information changed.' );
        		}
        		if(get_current_blog_id() == '81'){
			  		remove_menu_page( 'profile.php' );
			  	}
        		remove_submenu_page( 'users.php', 'profile.php' );
        	}
        	add_action( 'admin_init', 'stop_access_profile' );
        }
	}

	/*
	 * Check the options currently in the database and upgrade if necessary.
	 */
	function check_options() {
		if ($this->options === false || ! isset($this->options['db_version']) || $this->options['db_version'] < $this->db_version) {
			if (! is_array($this->options)) {
				$this->options = array();
			}

			$current_db_version = isset($this->options['db_version']) ? $this->options['db_version'] : 0;
			$this->upgrade($current_db_version);
			$this->options['db_version'] = $this->db_version;
			update_option($this->option_name, $this->options);
		}
	}

	/*
	 * Upgrade options as needed depending on the current database version.
	 */
	function upgrade($current_db_version) {
		$default_options = array(
			'allow_omb_auth' => false,
			'force_site_auth' => false,
			'force_ombmax' => false,
			'auth_label' => 'OMB MAX',
			'login_uri' => htmlspecialchars_decode(wp_login_url()),
			'logout_uri' => htmlspecialchars_decode(wp_logout_url()),
			'unauth_group_msg' => 'Your account is not part of an authorized OMB-Max Group.<br />%maxuser%',
		);

		if ($current_db_version < 1) {
			foreach ($default_options as $key => $value) {
				// Handle migrating existing options from before we stored a db_version
				if (! isset($this->options[$key])) {
					$this->options[$key] = $value;
				}
			}
		}
	}

	function ombmax_check_auth_login ($user, $password) {
	    if(isset($user->roles) && !empty($user->roles))
	    {
	        $options = get_option('omb_max_options','');
	        foreach($user->roles as $this_role)
	        {
	            if(isset($options['force_ombmax_role_'.$this_role]) && $options['force_ombmax_role_'.$this_role] == '1'){
	                $error = new WP_Error();
	                $error->add('omb_auth_wp_error', 'This user must login with OMB MAX. <a href="'.site_url().'/wp-login.php?ombAuth=1&redirect_to='.site_url().'">Click here to be redirected to OMB MAX login</a>');
	                return $error;
	            }
	        }
	    }
	    return $user;
	}

function ombmax_allow_password_reset_func( $allow, $user_id ) {
    
    if ( is_numeric( $user_id ) )
        $user = get_userdata( $user_id );
    else
        $user = wp_get_current_user();

    if ( empty( $user ) )
        return true;
    
    $options = get_option('omb_max_options','');

    foreach($user->roles as $this_role)
    {
        if(isset($options['force_ombmax_role_'.$this_role]) && $options['force_ombmax_role_'.$this_role] == '1'){
            //user has a role that OMB plugin says has to login via OMB. No Wordpress password reset
            $error = new WP_Error();
            $error->add('omb_auth_wp_error', 'Wordpress password resets have been disabled for this user. Please manage your account and password via <a href="https://max.omb.gov" target="_blank">OMB MAX</a>');
            return $error;
        }
    }

    return $allow;
}

function add_login_ombmax_head() {
	// fixes "Lost Password?" URLs on login page
	//if override lost password link
	if(get_current_blog_id() != '81'){
		$options = get_option('omb_max_options','');

		if(isset($options['override_lostpass']) && $options['override_lostpass'] == '1'){
			add_filter("lostpassword_url", function ($url, $redirect) {	
				
				$args = array( 'action' => 'lostpassword' );
				
				if ( !empty($redirect) )
					$args['redirect_to'] = $redirect;
				return add_query_arg( $args, site_url('wp-login.php') );
			}, 10, 2);
		}
		// fixes other password reset related urls
		add_filter( 'network_site_url', function($url, $path, $scheme) {
		  
		  	if (stripos($url, "action=lostpassword") !== false)
				return site_url('wp-login.php?action=lostpassword', $scheme);
		  
		   	if (stripos($url, "action=resetpass") !== false)
				return site_url('wp-login.php?action=resetpass', $scheme);
		  
			return $url;
		}, 10, 3 );
	}
	?>
	<style type="text/css">
	.omb-max-login
	{
	   margin-top: 2em;
	   text-align: center;
	}
	p#omb-max-link {
	  width: 100%;
	  height: 4em;
	  text-align: center;
      margin-top: 2em;
	}
	p#omb-max-link a {
	  margin: 0 auto;
	  float: none;
	}
	.omb-max-login #login_error
	{
		position: relative;
		width: 292px;
		left: 50%; 
		margin-left: -160px;
	}
	</style>
		<?php
		//Next 3 Lines Used For Displaying Auth Info On Login Page
		/*
		?>
		User : <?php echo OMBMax::get('user'); ?><br />
		Auth : <?php echo OMBMax::isAuthenticated() ? '<span style="color:green">YES</span>' : '<span style="color:red">FAIL</span>'; 
		*/
		/*echo '<div style="display:none;">';
		print_r($_SESSION);
		echo '</div>';*/
}

function hide_wp_login()
{
	?>
		<style type="text/css">
			#nav, #loginform, #login_error {display:none;}
		</style>
	<?php
}

function hide_wp_back_link()
{
	?>
		<style type="text/css">
			#backtoblog {display:none;}
		</style>
	<?php
}

function add_login_omb_max() {
	//global $redirect_to;
	/*if ( isset($_GET['action']) && @$_GET['action'] == 'logout')
	{
	  	OMBMax::logout(); //if session avail
	}*/
	//echo $GLOBALS['pagenow'];
	if($GLOBALS['pagenow'] == 'wp-login.php')
	{
		$redirect_to = $_GET['redirect_to'];
		$options = get_option('omb_max_options','');
		if($options != '' && $options['only_ombmax'])
		{
			//OMBMax::requireAuthentication();
			if($redirect_to != '')
				wp_redirect(wp_login_url($redirect_to).'&ombAuth=1');
			else
			{
				//wp_redirect(wp_login_url().'?ombAuth=1');
			}
		}
	}
	  //OMBMax::requireAuthentication(); 
}

function omb_clean_logout() {
    wp_clear_auth_cookie();
    wp_redirect( home_url() );
    unset($_SESSION[$_SERVER['SERVER_NAME']]);
    exit;
}

function add_init_omb_max() {

	if($GLOBALS['pagenow'] == 'wp-login.php')
	{
		$options = get_option('omb_max_options','');
		phpCAS::setFixedServiceURL(get_site_url().'/wp-login.php?ombAuth=1&p=1');
		if(isset($_GET['ombAuth']) && @$_GET['ombAuth'] == '1')
		{
			OMBMax::requireAuthentication();
			if( OMBMax::isAuthenticated())
			{
				$email_exists = email_exists(OMBMax::get('Email-Address'));
				//error_log('<!-- user id: '.$email_exists.' -->');
				if($email_exists !== false)
				{
					//is_blog_user( get_current_blog_id() );
					if(is_multisite())
					{
						//echo 'multisite blog id: '.get_current_blog_id();
						if(is_user_member_of_blog($email_exists,get_current_blog_id()))
						{
							//echo '<!-- OMB Results: User '.$email_exists.' is a member of this blog '.get_current_blog_id().' !-->';
							$mfa_pass = true;
							$piv_pass = true;
							$MFA_basic_grp = 'MobileTwoFactor';
							$PIV_grp = 'fips-201-pivcard';
							$ID_verified_grp = '';
							$auth_groups_string = OMBMax::get('samlAuthenticationStatementAuthMethod');
							$auth_groups = array_map('trim', explode(',', $auth_groups_string));
							//check for option on backend that it's set for forcing MFA
							if(isset($options['force_ombmax_mfa']) && $options['force_ombmax_mfa']) {
								$mfa_pass = false;
								foreach($auth_groups as $this_auth){
									if(strpos($this_auth, $MFA_basic_grp) !== false || strpos($this_auth, $PIV_grp) !== false){
										//this user has a 2FA group
										$mfa_pass = true;
									}
								}
							}
							if(isset($options['force_ombmax_piv']) && $options['force_ombmax_piv']) {
								if(in_array($PIV_grp, $auth_groups)){
									//user is piv auth'd
								}else{
									$piv_pass = false;
								}
							}
							if($piv_pass && $mfa_pass)
							{
								//echo '<!-- OMB Results: Log user in !-->';
								wp_set_auth_cookie($email_exists);
	                            wp_set_current_user($email_exists);
	                            
	                            $_SESSION[$_SERVER['SERVER_NAME']] = true;
	                            
								if(isset($_GET['redirect_to']) && @$_GET['redirect_to'] != '')
								{
									wp_redirect($_GET['redirect_to']);
									exit;
								}
								else
								{
									//echo '<!-- OMB Results: Redirect home !-->';
									wp_redirect(home_url());
									exit;
								}
								echo '<!-- OMB Results: User should\'ve been logged in !-->';
							}else{
								//echo '<!-- OMB Results: Do not log user in !-->';
								//one of both mfa/piv required has failed
								if(!$mfa_pass && !$piv_pass)
								{
									//neither set
									add_action('login_footer', function(){
										?>
										<script>
											jQuery(document).ready(function($)
											{ 
												$('#login_error.login_error_omb').insertBefore($('#loginform')); 
											});
										</script>
										<div id="login_error" class="login_error_omb">
											<span>MFA and PIV not set. Please logout of OMB MAX and try again.</span><br />
										</div><?php
									});
								}else{
									if(!$mfa_pass){
										//no mfa set
										add_action('login_footer', function(){
											?>
											<script>
												jQuery(document).ready(function($)
												{
													$('#login_error.login_error_omb').insertBefore($('#loginform'));
												});
											</script>
											<div id="login_error" class="login_error_omb">
												<span>No multifactor authentication set. Please logout of OMB MAX and try again.</span><br />
											</div><?php
										});
									}
									if(!$piv_pass){
										//no piv set
										add_action('login_footer', function(){
											?>
											<script>
												jQuery(document).ready(function($)
												{
													$('#login_error.login_error_omb').insertBefore($('#loginform'));
												});
											</script>
											<div id="login_error" class="login_error_omb">
												<span>No PIV card used. Please logout of OMB MAX and try again.</span><br />
											</div><?php
										});
									}
								}
							}
						}
						else{
							//echo 'user is NOT a member of this blog';
							add_action('login_footer', function(){
								?>
								<script>
										jQuery(document).ready(function($)
										{ 
											$('#login_error.login_error_omb').insertBefore($('#loginform')); 
										});
									</script>
									<div id="login_error" class="login_error_omb">
										<span>Sorry, this account is not a member of this site. If this is an error please contact the site administrator.</span><br />
									</div>
								<?php
							});
						}
					}
				}else{
					//echo 'can\'t find email : '. OMBMax::get('Email-Address');
					//email from omb exists in WP- login as this user
					add_action('login_footer', function(){
						?>
						<script>
								jQuery(document).ready(function($)
								{
									$('#login_error.login_error_omb').insertBefore($('#loginform'));
								});
							</script>
							<div id="login_error" class="login_error_omb">
								<span>Sorry, this account is not a member of this site. If this is an error please contact the site administrator.</span><br />
							</div>
						<?php
					});
				}
			}
		}
		else if(isset($_GET['ombAuth']) && @$_GET['ombAuth'] == 'logout')
		{
			OMBMax::logout();
			wp_redirect('https://login.max.gov/cas/logout');
			exit;
		}
	}
	else
	{
		$options = get_option('omb_max_options','');
		if(!empty($options) && $options['force_site_auth'] && !is_user_logged_in())
		{
			if(!empty($_SERVER['REQUEST_URI']))
				wp_redirect(wp_login_url((!empty($_SERVER['HTTPS'])?'https':'http').'://'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"]));
			else
				wp_redirect(wp_login_url());
			exit;
		}
	}
}

	/*
	 * Add a link to the login form to initiate external authentication.
	 */
	function add_login_link() {
		//global $redirect_to;
		$redirect_to = $_GET['redirect_to'];
		//$login_uri = $this->_generate_uri($this->options['login_uri'], wp_login_url($redirect_to));
		$login_uri = $this->_generate_uri($this->options['login_uri'], wp_login_url());

		$auth_label = $this->options['auth_label'];
        $header_label = $this->options['additional_login_header'];
        $footer_label = $this->options['additional_login_footer'];

        echo "\t" . $header_label;

		echo '<div class="omb-max-login">';
		if ( isset($_SESSION['otp_login_message']) ) 
		{
			if ( !empty($_SESSION['otp_login_message']) )
			{
				?>
				<script>
					jQuery(document).ready(function($)
					{ 
						$('#login_error.login_error_omb').insertBefore($('#loginform')); 
					});
				</script>
				<div id="login_error" class="login_error_omb">
					<span><?php echo __($_SESSION['otp_login_message']); ?></span> <br />
				</div><?php
			}
			unset($_SESSION['otp_login_message']);
		}
		echo "\t". '<p id="omb-max-link">' ."\n";
		//echo '<a class="button-primary" href="' . htmlspecialchars($login_uri) . '?ombAuth=1'.(!empty($redirect_to) ? '&redirect_to='.wp_specialchars($redirect_to,1) : '').'">Log In with ' . htmlspecialchars($auth_label) . '</a>' ."\n";
		echo '<a class="button-primary" href="' . htmlspecialchars($login_uri) . '?ombAuth=1">Log In with ' . htmlspecialchars($auth_label) . '</a>' ."\n";
		
		if( OMBMax::isAuthenticated())
		{
			echo "\t" . ' | <a class="button-primary" href="' . htmlspecialchars($logout_uri) .'?ombAuth=logout">Log out of ' . htmlspecialchars($auth_label) . '</a>' ."\n";
		}
		echo '</p>' . "\n";
		echo '</div>';
    		echo "\t" . $footer_label;

	}




	/*
	 * Logout the user by redirecting them to the logout URI.
	 */
	function logout() {
		$logout_uri = $this->_generate_uri($this->options['logout_uri'], home_url());

		wp_redirect($logout_uri);
		exit();
	}

	/*
	 * Remove the reauth=1 parameter from the login URL, if applicable. This allows
	 * us to transparently bypass the mucking about with cookies that happens in
	 * wp-login.php immediately after wp_signon when a user e.g. navigates directly
	 * to wp-admin.
	 */
	function bypass_reauth($login_url) {
		$login_url = remove_query_arg('reauth', $login_url);

		return $login_url;
	}

	/*
	 * Can we fallback to built-in WordPress authentication?
	 */
	function allow_omb_auth() {
		return (bool) $this->options['allow_omb_auth'];
	}


	/*
	 * Authenticate the user, first using the external authentication source.
	 * If allowed, fall back to WordPress password authentication.
	 */
	function authenticate($user, $username, $password) {
		//$user = $this->check_remote_user();

		if (! is_wp_error($user)) {
			// User was authenticated via REMOTE_USER
			$user = new WP_User($user->ID);
		}
		else {
			// REMOTE_USER is invalid; now what?

			if (! $this->allow_omb_auth()) {
				// Bail with the WP_Error when not falling back to WordPress authentication
				wp_die($user);
			}

			// Fallback to built-in hooks (see wp-includes/user.php)
		}

		return $user;
	}

		/*
	 * Fill the specified URI with the site URI and the specified return location.
	 */
	function _generate_uri($uri, $redirect_to) {
		// Support tags for staged deployments
		$base = $this->_get_base_url();

		$tags = array(
			'host' => $_SERVER['HTTP_HOST'],
			'base' => $base,
			'site' => home_url(),
			'redirect' => $redirect_to,
		);

		foreach ($tags as $tag => $value) {
			$uri = str_replace('%' . $tag . '%', $value, $uri);
			$uri = str_replace('%' . $tag . '_encoded%', urlencode($value), $uri);
		}

		// Support previous versions with only the %s tag
		if (strstr($uri, '%s') !== false) {
			$uri = sprintf($uri, urlencode($redirect_to));
		}

		return $uri;
	}

	/*
	 * Return the base domain URL based on the WordPress home URL.
	 */
	function _get_base_url() {
		$home = parse_url(home_url());

		$base = home_url();
		foreach (array('path', 'query', 'fragment') as $key) {
			if (! isset($home[$key])) continue;
			$base = str_replace($home[$key], '', $base);
		}

		return $base;
	}
}

// Load the plugin hooks, etc.
$omb_max_plugin = new OMBMAXAuthenticationPlugin();
?>
