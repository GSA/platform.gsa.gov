<?php

/**
 * Register widget area.
 *
 * @since minibuzz 5.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function minibuzzts_widgets_init() {
	register_sidebar( array(
		'name'          =>  esc_html__( 'Primary Sidebar', 'minibuzzts' ),
		'id'            => 'primary-sidebar',
		'description'   =>  esc_html__( 'Add widgets here to appear in your sidebar.', 'minibuzzts' ),
		'before_widget' => '<aside id="%1$s" class="widget-container %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
		
}
add_action( 'widgets_init', 'minibuzzts_widgets_init' );