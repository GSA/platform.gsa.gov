<?php
/**
 * minibuzz Theme Customizer
 *
 * @package minibuzz
 * @since minibuzz 5.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function minibuzzts_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';			
}
add_action( 'customize_register', 'minibuzzts_customize_register' );

require get_template_directory() . '/includes/customizer/panels.php';
require get_template_directory() . '/includes/customizer/sections.php';
require get_template_directory() . '/includes/customizer/fields.php';

