<?php


/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() .  '/includes/plugin-activation/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'minibuzzts_register_required_plugins' );

function minibuzzts_register_required_plugins() {

    $plugins = array(
        array(
            'name'      => esc_html__('Jetpack', 'minibuzzts' ),
            'slug'      => 'jetpack',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('Kirki', 'minibuzzts' ),
            'slug'      => 'kirki',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('WP PageNavi', 'minibuzzts' ),
            'slug'      => 'wp-pagenavi',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('Contact Form 7', 'minibuzzts' ),
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('Yoast Breadcrumbs', 'minibuzzts' ),
            'slug'      => 'breadcrumbs',
            'required'  => false,
        ),
        array(
            'name'      => esc_html__('WordPress Importer', 'minibuzzts' ),
            'slug'      => 'wordpress-importer',
            'required'  => false,
        ),

    );

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'minibuzzts',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
