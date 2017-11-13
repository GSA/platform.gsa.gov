<?php

	/*
	*
	*	Dante Child Functions
	*	------------------------------------------------
	*
	*
	*	VARIABLE DEFINITIONS
	*	PLUGIN INCLUDES
	*	THEME UPDATER
	*	THEME SUPPORT
	*	THUMBNAIL SIZES
	*	CONTENT WIDTH
	*	LOAD THEME LANGUAGE
	*	add_action - enqueue parent styles
	*
	*/
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

// Create Mentor Network Custom Post Type
function challenge_custom_posttypes() {
	$labels = array(
			'name'               => 'Mentors',
			'singular_name'      => 'Mentor',
			'menu_name'          => 'Mentors',
			'name_admin_bar'     => 'Mentor',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Mentor',
			'new_item'           => 'New Mentor',
			'edit_item'          => 'Edit Mentor',
			'view_item'          => 'View Mentor',
			'all_items'          => 'All Mentors',
			'search_items'       => 'Search Mentors',
			'parent_item_colon'  => 'Parent Mentors:',
			'not_found'          => 'No mentors found.',
			'not_found_in_trash' => 'No mentors found in Trash.',
	);

	$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'menu_icon'          => 'dashicons-id-alt',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'mentors' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 10,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'revisions' ),
			'taxonomies'				 => array( 'post_tag')
	);
    register_post_type( 'mentor', $args );
}
add_action( 'init', 'challenge_custom_posttypes' );

add_filter("manage_edit-mentor_columns", "mentor_edit_columns");

function mentor_edit_columns($columns){
				$columns = array(
						"cb" => "<input type=\"checkbox\" />",
						"thumbnail" => "",
						"title" => __("Mentor Name", "swift-framework-admin"),
						"description" => __("Description", "swift-framework-admin")
				);

				return $columns;
}

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry,
    // when you add a post of this CPT.
    challenge_custom_posttypes();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );


//Remove Extra Dante Custom Post Types
function custom_unregister_theme_post_types() {
    global $wp_post_types;
    foreach( array( 'jobs', 'testimonials', 'clients', 'team') as $post_type ) {
        if ( isset( $wp_post_types[ $post_type ] ) ) {
            unset( $wp_post_types[ $post_type ] );
        }
    }
}
add_action( 'init', 'custom_unregister_theme_post_types', 20 );



?>
