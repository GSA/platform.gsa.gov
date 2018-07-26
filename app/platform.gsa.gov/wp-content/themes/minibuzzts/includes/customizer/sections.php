<?php

/**
 * Add sections
 */


Kirki::add_section( 'site_bg', array(
	'title'       =>  esc_html__( 'Site Background', 'minibuzzts' ),
	'priority'    => 10,
	'panel'       => 'styles',
) );


Kirki::add_section( 'header', array(
	'title'       =>  esc_html__( 'Header', 'minibuzzts' ),
	'priority'    => 11,
	'panel'       => 'styles',
) );

Kirki::add_section( 'slider', array(
	'title'       => esc_html__(  'Slider', 'minibuzzts' ),
	'priority'    => 12,
	'panel'       => 'styles',
) );

Kirki::add_section( 'main_body', array(
	'title'    =>  esc_html__( 'Main Body', 'minibuzzts' ),
	'priority' => 13,
	'panel'       => 'styles',
) );


Kirki::add_section( 'footer', array(
	'title'       =>  esc_html__( 'Footer', 'minibuzzts' ),
	'priority'    => 14,
	'panel'       => 'styles',
) );

Kirki::add_section( 'other', array(
	'title'       =>  esc_html__( 'Other', 'minibuzzts' ),
	'priority'    => 15,
	'panel'       => 'styles',
) );

Kirki::add_section( 'frontpage', array(
	'title'    => esc_html__(  'Frontpage ', 'minibuzzts' ),
	'priority' => 16,
) );

Kirki::add_section( 'homepage_template', array(
	'title'    =>  esc_html__( 'Homepage Template', 'minibuzzts' ),
	'priority' => 17,
) );