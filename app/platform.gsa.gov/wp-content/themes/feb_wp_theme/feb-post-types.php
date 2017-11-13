<?php
/**
 * Custom Post Types
 *
 * @package FEB WordPress Theme Framework
 * @subpackage feb
 * @author CTAC - www.ctacorp.com
 */

function register_news_post_type() {
  $labels = array(
    'name'               => 'News',
    'singular_name'      => 'News story',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New News story',
    'edit_item'          => 'Edit News story',
    'new_item'           => 'New News story',
    'all_items'          => 'All News stories',
    'view_item'          => 'View News story',
    'search_items'       => 'Search News stories',
    'not_found'          => 'No News items found',
    'not_found_in_trash' => 'No News items found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'News'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'news' ),
    'taxonomies'         => array( 'category', 'post_tag' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => 25,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions')
  );

  register_post_type( 'news', $args );
}

function register_notes_post_type() {
  $labels = array(
    'name'               => 'Notes',
    'singular_name'      => 'Notes',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Notes',
    'edit_item'          => 'Edit Notes',
    'new_item'           => 'New Notes',
    'all_items'          => 'All Notes',
    'view_item'          => 'View Notes',
    'search_items'       => 'Search Notes',
    'not_found'          => 'No Notes found',
    'not_found_in_trash' => 'No Notes found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Notes'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'notes' ),
    'taxonomies'         => array( 'category', 'post_tag' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => 26,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions')
  );

  register_post_type( 'notes', $args );
}

function register_workforce_post_type() {
  $labels = array(
    'name'               => 'Workforce',
    'singular_name'      => 'Workforce Item',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Workforce Item',
    'edit_item'          => 'Edit Workforce Item',
    'new_item'           => 'New Workforce Item',
    'all_items'          => 'All Workforce Items',
    'view_item'          => 'View Workforce Item',
    'search_items'       => 'Search Workforce Items',
    'not_found'          => 'No Workforce Items found',
    'not_found_in_trash' => 'No Workforce Items found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Workforce'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'workforce' ),
    'taxonomies'         => array( 'category', 'post_tag' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => 26,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions')
  );

  register_post_type( 'workforce', $args );
}

function register_collaboration_post_type() {
  $labels = array(
    'name'               => 'Collaboration',
    'singular_name'      => 'Collaboration Item',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Collaboration Item',
    'edit_item'          => 'Edit Collaboration Item',
    'new_item'           => 'New Collaboration Item',
    'all_items'          => 'All Collaboration Items',
    'view_item'          => 'View Collaboration Item',
    'search_items'       => 'Search Collaboration Items',
    'not_found'          => 'No Collaboration Items found',
    'not_found_in_trash' => 'No Collaboration Items found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Collaboration'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'collaboration' ),
    'taxonomies'         => array( 'category', 'post_tag' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'menu_position'      => 27,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions')
  );

  register_post_type( 'collaboration', $args );
}

function register_em_contact_lists_post_type() {
  $labels = array(
    'name'               => 'Contact List',
    'singular_name'      => 'Contact List',
    'add_new'            => 'Add New',
    'add_new_item'       => 'Add New Contact List',
    'edit_item'          => 'Edit Contact List',
    'new_item'           => 'New Contact List',
    'all_items'          => 'All Contact Lists',
    'view_item'          => 'View Contact List',
    'search_items'       => 'Search Contact Lists',
    'not_found'          => 'No Contact Lists found',
    'not_found_in_trash' => 'No Contact Lists found in Trash',
    'parent_item_colon'  => '',
    'menu_name'          => 'Contact Lists'
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'contact-list' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => 26,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions')
  );

  register_post_type( 'contact_list', $args );
}

function register_em_contact_post_type() {
    $labels = array(
        'name'               => 'Emergency Contact',
        'singular_name'      => 'Emergency Contact',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Emergency Contact',
        'edit_item'          => 'Edit Emergency Contact',
        'new_item'           => 'New Emergency Contact',
        'all_items'          => 'All Emergency Contacts',
        'view_item'          => 'View Emergency Contact',
        'search_items'       => 'Search Emergency Contacts',
        'not_found'          => 'No Emergency Contacts found',
        'not_found_in_trash' => 'No Emergency Contacts found in Trash',
        'parent_item_colon'  => '',
        'menu_name'          => 'Emergency Contacts'
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'emergency-contact' ),
        'taxonomies'         => array(),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 12,
        'supports'           => array( 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions', 'page-attributes')
    );

register_post_type( 'emergency_contact', $args );
}

?>