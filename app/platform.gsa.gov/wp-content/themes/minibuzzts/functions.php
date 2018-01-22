<?php

/**
 * Additional function.
 *
 * @since minibuzz 5.0
 */
require get_template_directory() . '/includes/theme-function.php';


/**
 * Sidebar Widgtes.
 *
 * @since minibuzz 5.0
 */
require get_template_directory() . '/includes/theme-sidebar.php';


/**
 * Loading jQuery and css.
 *
 * @since minibuzz 5.0
 */
require get_template_directory() . '/includes/theme-scripts.php';


/**
 * Customizer additions.
 *
 * @since minibuzz 5.0
 */
if ( class_exists( 'Kirki' ) ) {
require get_template_directory() . '/includes/customizer.php';
}



/**
 * Plugin Activation.
 *
 * @since minibuzz 5.0
 */
require get_template_directory() . '/includes/theme-plugins.php';


