<?php
class OMBMAXAuthenticationOptionsPage {
	var $plugin;
	var $group;
	var $page;
	var $options;
	var $title;

	function OMBMAXAuthenticationOptionsPage($plugin, $group, $page, $options, $title = 'OMB Max') {
		$this->plugin = $plugin;
		$this->group = $group;
		$this->page = $page;
		$this->options = $options;
		$this->title = $title;

		add_action('admin_init', array($this, 'register_options'));
		add_action('admin_menu', array($this, 'add_options_page'));
	}

	/*
	 * Register the options for this plugin so they can be displayed and updated below.
	 */
	function register_options() {
		register_setting($this->group, $this->group, array($this, 'sanitize_settings'));

		$section = 'ombmax_authentication_main';
		add_settings_section($section, 'General Settings', array($this, '_display_options_section'), $this->page);
		add_settings_field('ombmax_authentication_allow_omb_auth', 'Allow OMB MAX authentication?', array($this, '_display_option_allow_omb_auth'), $this->page, $section, array('label_for' => 'ombmax_authentication_allow_omb_auth'));
		add_settings_field('ombmax_authentication_force_site_auth', 'Force Site Auth?', array($this, '_display_option_force_site_auth'), $this->page, $section, array('label_for' => 'ombmax_authentication_force_site_auth'));
		add_settings_field('ombmax_authentication_force_ombmax', 'Force OMB MAX?', array($this, '_display_option_force_ombmax_auth'), $this->page, $section, array('label_for' => 'ombmax_authentication_force_ombmax'));
		add_settings_field('ombmax_authentication_force_mfa', 'Force Multi Factor Auth?', array($this, '_display_option_force_mfa_auth'), $this->page, $section, array('label_for' => 'ombmax_authentication_force_mfa'));
		add_settings_field('ombmax_authentication_force_piv', 'Force PIV Card Auth?', array($this, '_display_option_force_piv_auth'), $this->page, $section, array('label_for' => 'ombmax_authentication_force_piv'));
		if(get_current_blog_id() != '81'){
			add_settings_field('ombmax_authentication_force_ombmax_roles', 'Force roles to use OMB MAX?', array($this, '_display_option_force_ombmax_roles_auth'), $this->page, $section, array('label_for' => 'ombmax_authentication_force_ombmax_roles'));
			add_settings_field('ombmax_authentication_override_lostpass_url', 'Override lostpass URL?', array($this, '_display_option_override_lostpass'), $this->page, $section, array('label_for' => 'ombmax_authentication_override_lostpass_url'));
		}
		add_settings_field('ombmax_authentication_auth_label', 'Authentication label', array($this, '_display_option_auth_label'), $this->page, $section, array('label_for' => 'ombmax_authentication_auth_label'));
		add_settings_field('ombmax_authentication_login_uri', 'Login URI', array($this, '_display_option_login_uri'), $this->page, $section, array('label_for' => 'ombmax_authentication_login_uri'));
		add_settings_field('ombmax_authentication_logout_uri', 'Logout URI', array($this, '_display_option_logout_uri'), $this->page, $section, array('label_for' => 'ombmax_authentication_logout_uri'));
		add_settings_field('ombmax_authentication_unauth_group_msg', 'Unauthorized Group Message', array($this, '_display_option_unauth_group_msg'), $this->page, $section, array('label_for' => 'ombmax_authentication_unauth_group_msg'));
        add_settings_field('ombmax_authentication_additional_login_header', 'Additional Login Header', array($this, '_display_option_additional_login_header'), $this->page, $section, array('label_for' => 'ombmax_authentication_additional_login_header'));
        add_settings_field('ombmax_authentication_additional_login_footer', 'Additional Login Footer', array($this, '_display_option_additional_login_footer'), $this->page, $section, array('label_for' => 'ombmax_authentication_additional_login_footer'));

		//add_settings_field('ombmax_authentication_additional_server_keys', '$_SERVER variables', array($this, '_display_option_additional_server_keys'), $this->page, $section, array('label_for' => 'ombmax_authentication_additional_server_keys'));
		//add_settings_field('ombmax_authentication_auto_create_user', 'Automatically create accounts?', array($this, '_display_option_auto_create_user'), $this->page, $section, array('label_for' => 'ombmax_authentication_auto_create_user'));
		//add_settings_field('ombmax_authentication_auto_create_email_domain', 'Email address domain', array($this, '_display_option_auto_create_email_domain'), $this->page, $section, array('label_for' => 'ombmax_authentication_auto_create_email_domain'));
	}

	/*
	 * Set the database version on saving the options.
	 */
	function sanitize_settings($input) {
		$output = $input;
		$output['db_version'] = $this->plugin->db_version;
		$output['allow_omb_auth'] = isset($input['allow_omb_auth']) ? (bool) $input['allow_omb_auth'] : false;
		$output['force_site_auth'] = isset($input['force_site_auth']) ? (bool) $input['force_site_auth'] : false;
		$output['force_ombmax'] = isset($input['force_ombmax']) ? (bool) $input['force_ombmax'] : false;
		$output['force_ombmax_mfa'] = isset($input['force_ombmax_mfa']) ? (bool) $input['force_ombmax_mfa'] : false;
		$output['force_ombmax_piv'] = isset($input['force_ombmax_piv']) ? (bool) $input['force_ombmax_piv'] : false;

		return $output;
	}

	/*
	 * Add an options page for this plugin.
	 */
	function add_options_page() {
		add_options_page($this->title, $this->title, 'manage_options', $this->page, array($this, '_display_options_page'));
	}

	/*
	 * Display the options for this plugin.
	 */
	function _display_options_page() {
		if (! current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
?>
<div class="wrap">
  <h2>OMB MAX Authentication Options</h2>
  <?php /*
  <p>For the Login URI and Logout URI options, you can use the following variables to support your installation:</p>
  <ul>
    <li><code>%host%</code> - The current value of <code>$_SERVER['HTTP_HOST']</code></li>
    <li><code>%base%</code> - The base domain URL (everything before the path)</li>
    <li><code>%site%</code> - The WordPress home URI</li>
    <li><code>%redirect%</code> - The return URI provided by WordPress</li>
  </ul>
  <p>You can also use <code>%host_encoded%</code>, <code>%site_encoded%</code>, and <code>%redirect_encoded%</code> for URL-encoded values.</p>
  */
  ?>
  <form action="options.php" method="post">
    <?php settings_errors(); ?>
    <?php settings_fields($this->group); ?>
    <?php do_settings_sections($this->page); ?>
    <p class="submit">
      <input type="submit" name="Submit" value="<?php esc_attr_e('Save Changes'); ?>" class="button-primary" />
    </p>
  </form>
</div>
<?php
	}

	/*
	 * Display explanatory text for the main options section.
	 */
	function _display_options_section() {
	}

	/*
	 * Display the WordPress authentication checkbox.
	 */
	function _display_option_allow_omb_auth() {
		$allow_omb_auth = $this->options['allow_omb_auth'];
		$this->_display_checkbox_field('allow_omb_auth', $allow_omb_auth);
?>
Display OMB MAX Login button on login page.
<?php
}

	/*
	 * Display the authentication label field, describing the authentication system
	 * in use.
	 */
	function _display_option_auth_label() {
		$auth_label = $this->options['auth_label'];
		$this->_display_input_text_field('auth_label', $auth_label);
?>
Default is <code>OMB Max</code>; override to use the name of your single sign-on system.
<?php
    }

    /*
     * Display the additional login header field, describing the authentication system
     * in use.
     */
    function _display_option_additional_login_header() {
        $additional_login_header = $this->options['additional_login_header'];
        $this->_display_textarea_field('additional_login_header', $additional_login_header);
        ?>
        Default is <code>OMB Max</code>; override to login page header.
<?php
    }
    /*
     * Display the additional login header field, describing the authentication system
     * in use.
     */
    function _display_option_additional_login_footer() {
        $additional_login_header = $this->options['additional_login_footer'];
        $this->_display_textarea_field('additional_login_footer', $additional_login_header);
        ?>
        Default is <code>OMB Max</code>; override to login page footer.
    <?php
    }

	/*
	 * Display the login URI field.
	 */
	function _display_option_login_uri() {
		$login_uri = $this->options['login_uri'];
		$this->_display_input_text_field('login_uri', $login_uri);
?>
Default is <code><?php echo wp_login_url(); ?></code>; override to direct users to a single sign-on system. See above for available variables.<br />
Example: <code>%base%/Shibboleth.sso/Login?target=%redirect_encoded%</code>
<?php
	}

	/*
	 * Display the logout URI field.
	 */
	function _display_option_logout_uri() {
		$logout_uri = $this->options['logout_uri'];
		$this->_display_input_text_field('logout_uri', $logout_uri);
?>
Default is <code><?php echo htmlspecialchars(remove_query_arg('_wpnonce', htmlspecialchars_decode(wp_logout_url()))); ?></code>; override to e.g. remove a cookie. See above for available variables.<br />
Example: <code>%base%/Shibboleth.sso/Logout?return=%redirect_encoded%</code>
<?php
	}

	/*
	 * Display the logout URI field.
	 */
	function _display_option_unauth_group_msg() {
		$unauth_group_msg = $this->options['unauth_group_msg'];
		$this->_display_input_text_field('unauth_group_msg', $unauth_group_msg);
?>
Default is <code>Your account is not part of an authorized OMB-Max Group.</code>; override to change the login error message. One variable %maxuser% will display the Max Username.<br />
Example: <code>Nope, your group isn't good enough, %maxuser%.</code>
<?php
	}

	function _display_option_force_site_auth() {
		$force_siteauth = $this->options['force_site_auth'];
		$this->_display_checkbox_field('force_site_auth', $force_siteauth);
?>
Force users to Authenticate to view site.
<?php
	}

		function _display_option_force_ombmax_auth() {
		$force_maxauth = $this->options['force_ombmax'];
		$this->_display_checkbox_field('force_ombmax', $force_maxauth);
?>
Force users to Authenticate with OMBMAX only.
<?php
	}
	function _display_option_force_mfa_auth() {
		$force_mfa = $this->options['force_ombmax_mfa'];
		$this->_display_checkbox_field('force_ombmax_mfa', $force_mfa);
?>
Force OMB MAX authentication to use SMS 2-factor.
<?php
	}

	function _display_option_force_piv_auth() {
		$force_piv = $this->options['force_ombmax_piv'];
		$this->_display_checkbox_field('force_ombmax_piv', $force_piv);
?>
Force OMB MAX authentication to use PIV card only.
<?php
	}
	function _display_option_force_ombmax_roles_auth() {
		global $wp_roles;
		$all_roles = $wp_roles->roles;
		foreach($all_roles as $role_key => $this_role)
		{
			//echo $role_key.'<br/>';
			//print_r($this_role);
			//echo '<br/><br/>';
			$force_maxauth_role = $this->options['force_ombmax_role_'.$role_key];
			$this->_display_checkbox_field('force_ombmax_role_'.$role_key, $force_maxauth_role, true);
			echo ' '.$this_role['name'].'<br/>';
		}
	}
	function _display_option_override_lostpass() {
		$override_lostpass = $this->options['override_lostpass'];
		$this->_display_checkbox_field('override_lostpass', $override_lostpass);
		?>
		Force users to stay on this site when clicking lost password from wp-login.php
		<?php
	}
	/*
	 * Display a text input field.
	 */
	function _display_input_text_field($name, $value, $size = 75) {
?>
<input type="text" name="<?php echo htmlspecialchars($this->group); ?>[<?php echo htmlspecialchars($name); ?>]" id="ombmax_authentication_<?php echo htmlspecialchars($name); ?>" value="<?php echo htmlspecialchars($value) ?>" size="<?php echo htmlspecialchars($size); ?>" /><br />
<?php

	}

	/*
	 * Display a checkbox field.
	 */
	function _display_checkbox_field($name, $value, $no_br = false) {
?>
<input type="checkbox" name="<?php echo htmlspecialchars($this->group); ?>[<?php echo htmlspecialchars($name); ?>]" id="ombmax_authentication_<?php echo htmlspecialchars($name); ?>"<?php if ($value) echo ' checked="checked"' ?> value="1" /><?php echo $no_br ? '' : '<br />';?>
<?php
	}
/*
 * Display a textarea field.
 */
function _display_textarea_field($name, $value, $row = 5, $col = 50) {
    ?>
    <textarea name="<?php echo htmlspecialchars($this->group); ?>[<?php echo htmlspecialchars($name); ?>]" id="ombmax_authentication_<?php echo htmlspecialchars($name); ?>" rows="<?php echo htmlspecialchars($row); ?>" cols="<?php echo htmlspecialchars($col); ?>" > <?php echo $value; ?>
    </textarea><br />
<?php
}
}
?>
