<?php

Kirki::add_config( 'minibuzzts', array(
	'capability'  => 'edit_theme_options',
	'option_type' => 'theme_mod',
) );


/*========== Site Background Sections ==========*/
Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_site_background_color',
	'description' 	=>  esc_html__( 'Background Color', 'minibuzzts' ),
	'section'      	=> 'site_bg',
	'default'  		=> '#ebeceb',
	'priority' 		=> 1,
	'output'   		=> array(
		array(
			'element'  => 'body',
			'property' => 'background',
		),
	),

) );


Kirki::add_field( 'minibuzzts', array(
	'type'         => 'background',
	'settings'     => 'minibuzzts_site_background',
	'section'      => 'site_bg',
	'default'      => array(
		'image'    => '',
		'repeat'   => 'repeat',
		'size'     => 'inherit',
		'position' => 'center-center',
		'opacity'  => 100,
	),
	'priority'     => 1,
	'output'       => 'body',
) );


/*=============================================== Header Sections ===============================================*/

Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_header_top_bar_color',
	'label'  		=> esc_html__(  'Top Bar Color', 'minibuzzts' ),
	'section'      	=> 'header',
	'default'  		=> '#2d84b6',
	'priority' 		=> 1,
	'output'   		=> array(
        array(
            'element'  => '#top',
            'property' => 'border-top-color',
        ),
	),

) );

Kirki::add_field( 'minibuzzts', array(
	'type'     => 'color',
	'settings' => 'minibuzzts_header_primary_menu_color',
	'label'    => esc_html__(  'Primany Menu Color', 'minibuzzts' ),
	'section'      => 'header',
	'default'  => '#000000',
	'priority' => 1,
      'output'      => array(
        array(
          'element'  => '
		  		.sf-menu a, #logo .site-description,
				#top-nav-wrap .sf-menu .current_page_item ul li a,
				#top-nav-wrap .sf-menu .current-menu-item ul li a,
				#top-nav-wrap .sf-menu .current-menu-ancestor ul li a,
				#top-nav-wrap .sf-menu .current_page_ancestor ul li a,
				#top-nav-wrap .sf-menu .current-cat ul li a,
				#top-nav-wrap .sf-menu .page_item_has_children.current_page_item ul li a,
				#top-nav-wrap .sf-menu .current_page_item.menu-item-has-children ul li a,
				#top-nav-wrap .sf-menu .current-menu-item.menu-item-has-children ul li a
		  ',
          'property' => 'color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'     => 'color',
	'settings' => 'minibuzzts_header_primary_menu_hover_color',
	'label'    => esc_html__(  'Primary Menu Hover Color', 'minibuzzts' ),
	'section'  => 'header',
	'default'  => '#9fa1a2',
	'priority' => 1,
	'output'   => array(
		array(
			'element'  => '#top-nav-wrap .sf-menu a:hover,  
						#top-nav-wrap .sf-menu li.current-menu-ancestor a,
						#top-nav-wrap .sf-menu li.current_page_ancestor a,
						#top-nav-wrap .sf-menu .current_page_item a,
						#top-nav-wrap .sf-menu .current_page_ancestor a,
						#top-nav-wrap .sf-menu .current-menu-item a,
						#top-nav-wrap .sf-menu .current-cat a,
						#top-nav-wrap .sf-menu li .current_page_item a, 
						#top-nav-wrap .sf-menu li .current_page_item a:hover,
						#top-nav-wrap .sf-menu li .current-menu-item a, 
						#top-nav-wrap .sf-menu li .current-menu-item a:hover,
						#top-nav-wrap .sf-menu li .current-cat a, 
						#top-nav-wrap .sf-menu li .current-cat a:hover,
						
						#top-nav-wrap .sf-menu li li a:hover,
						#top-nav-wrap .sf-menu .current_page_item ul li a:hover,
						#top-nav-wrap .sf-menu .current-menu-item ul li a:hover,
						#top-nav-wrap .sf-menu .current-menu-ancestor ul li a:hover,
						#top-nav-wrap .sf-menu .current_page_ancestor ul li a:hover,
						#top-nav-wrap .sf-menu .current-menu-ancestor ul .current_page_item > a,
						#top-nav-wrap .sf-menu .current_page_ancestor ul .current-menu-item > a,
						#top-nav-wrap .sf-menu .current-menu-ancestor ul .current-menu-item > a,
						#top-nav-wrap .sf-menu .current_page_ancestor ul .current_page_item > a,
					
						#top-nav-wrap .sf-menu li .current_page_parent > a, 
						#top-nav-wrap .sf-menu li .current_page_parent > a:hover, 
						#top-nav-wrap .sf-menu li .current-menu-parent > a, 
						#top-nav-wrap .sf-menu li .current-menu-parent > a:hover, 
						
						#top-nav-wrap .sf-menu li .current_page_ancestor.current_page_parent > a, 
						#top-nav-wrap .sf-menu li .current_page_ancestor.current_page_parent > a:hover, 
						#top-nav-wrap .sf-menu li .current-menu-ancestor.current-menu-parent > a, 
						#top-nav-wrap .sf-menu li .current-menu-ancestor.current-menu-parent > a:hover, 
						
						#top-nav-wrap .sf-menu .current-cat ul li a:hover					
						
			 ',
			'property' => 'color',
		),
		
	),

) );


Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_header_active_bar_color',
	'label'  		=> esc_html__(  'Active Menu Bar Color', 'minibuzzts' ),
	'section'      	=> 'header',
	'default'  		=> '#2d84b6',
	'priority' 		=> 1,
	'output'   		=> array(
        array(
            'element'  => '.sf-menu li.current-menu-ancestor > a,
							.sf-menu li.current_page_ancestor > a,
							.sf-menu .current_page_item > a,
							.sf-menu .current_page_ancestor > a,
							.sf-menu .current-menu-item > a,
							.sf-menu .current-cat > a',
            'property' => 'border-top-color',
        ),
	),

) );

Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_header_separator_color',
	'label'  		=> esc_html__(  'Separator Color', 'minibuzzts' ),
	'section'      	=> 'header',
	'default'  		=> '#ebeceb',
	'priority' 		=> 1,
	'output'   		=> array(
        array(
          'element'  => '.sf-menu > li:before	',
          'property' => 'color'
        ),
		
	),

) );

/*=============================================== Slider Sections ===============================================*/

Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_slider_bg_color',
	'label'       => esc_html__(  'Text Background Color', 'minibuzzts' ),
	'section'     => 'slider',
	'default'     => 'rgba(0,0,0,0.7)',
	'alpha'	 	  => true,
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '#slider .camera_caption > div ',
          'property' => 'background'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_slider_text_color',
	'section'     => 'slider',
	'default'     => '#ffffff',
	'label' 	  => esc_html__(  'Title & Text Color', 'minibuzzts' ),
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '#slider .slider-title,	#slider .slider-title a, #slider .slider-desc	',
          'property' => 'color'
        ),
	),
) );


Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_slider_btn_txt_color',
	'section'     => 'slider',
	'default'     => '#ffffff',
	'label'       => esc_html__(  'Button', 'minibuzzts' ),
	'description' 	=> esc_html__(  'Text Color', 'minibuzzts' ),
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '#slider .slider-button, #slider .slider-button:hover	',
          'property' => 'color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_slider_btn_bg_color',
	'description' 	=> esc_html__(  'Background Color', 'minibuzzts' ),
	'section'     => 'slider',
	'default'     => '#444444',
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '#slider .slider-button ',
          'property' => 'background-color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_slider_btn_bg_hover_color',
	'description'       => esc_html__(  'Background Hover Color', 'minibuzzts' ),
	'section'     => 'slider',
	'default'     => '#5b5b5b',
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '#slider .slider-button:hover ',
          'property' => 'background-color'
        ),
	),
) );

/*=============================================== Main Body Sections ===============================================*/

Kirki::add_field( 'minibuzzts', array(
	'type'     => 'color',
	'settings' => 'minibuzzts_main_body_heading_color',
	'label'    => esc_html__(  'Heading Color', 'minibuzzts' ),
	'section'  => 'main_body',
	'default'  => '#2d84b6',
	'priority' => 1,
     'output'      => array(
        array(
          'element'  => ' h1, h2, h3, h4, h5, h6, .widget-title, .sidebar .widget-title, .portfolio-title a, .entry-title, .entry-title a, #logo .site-title, #logo .site-title a,
						 #featurescontent .features-header .entry-title, #featurescontent .features-header .entry-title a, .testimonial .testi-title,
						 #hometesti-container #testi-carousel .testi-title
						',
          'property' => 'color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'     => 'color',
	'settings' => 'minibuzzts_main_body_page_title_color',
	'label'    => esc_html__(  'Page Title Color', 'minibuzzts' ),
	'section'  => 'main_body',
	'default'  => '#444133',
	'priority' => 1,
     'output'      => array(
        array(
          'element'  => ' .page-title-header .page-title ',
          'property' => 'color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_main_body_blog_meta_date_background_color',
	'label'       	=> esc_html__(  'Blog Meta Color', 'minibuzzts' ),
	'section'      	=> 'main_body',
	'default'  		=> '#999999',
	'priority' 		=> 1,
	'output'   		=> array(
		array(
			'element'  => '.entry-utility, .recentpost-widget .recent-date',
			'property' => 'color'
		),

	),

) );


Kirki::add_field( 'minibuzzts', array(
	'type'     => 'color',
	'settings' => 'minibuzzts_main_body_text_color',
	'label'    => esc_html__(  'Text Color', 'minibuzzts' ),
	'section'  => 'main_body',
	'default'  => '#656253',
	'priority' => 1,
    'output'      => array(
        array(
          'element'  => 'body, .wp-pagenavi .pages, .comment-form label, .portfolio-filter ul li, 
		  				 .tagcloud a, 
						 .wp-caption .wp-caption-text, .sidebar li a, .recentpost-widget .recent-title a
						 ',
          'property' => 'color'
        ),

	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'     => 'color',
	'settings' => 'minibuzzts_main_body_link_color',
	'label'    =>  esc_html__( 'Link Color', 'minibuzzts' ),
	'section'  => 'main_body',
	'default'  => '#df7034',
	'priority' => 1,
     'output'      => array(
        array(
          'element'  => 'a, .pingback .comment-edit-link, .comment-reply-link, .portfolio-filter ul li:focus, .portfolio-title a:hover, .portfolio-title a:focus,
		      			.portfolio-filter ul li:hover, .portfolio-filter ul li.filter.active, h2.active span, .comment-reply-link, .more-link, .required, 
						.sidebar li.current-cat a, blockquote cite, #featurescontent .features-header .entry-title a:hover,
						blockquote small, 
						.comment-metadata a.date:hover, .recentpost-widget .recent-title a:hover, .recentpost-widget .recent-title a:focus,
						.sidebar li a:hover, .sidebar li li a:hover, .sidebar li li a.current,  .entry-title a:hover, .articlecontainer .entry-title a:hover, 
						.comment-reply-link:focus, 
						.comment-metadata a:hover,
						.comment-metadata a:hover,
						.comment-metadata a:focus,
						.pingback .comment-edit-link:hover,
						.pingback .comment-edit-link:focus
						',
		  'property' => 'color',
        ),
        array(
            'element'  => '.widget_calendar tbody a, mark, ins',
            'property' => 'background',
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'     => 'color',
	'settings' => 'minibuzzts_main_body_hover_color',
	'label'    => esc_html__(  'Links - Hover Color', 'minibuzzts' ),
	'section'  => 'main_body',
	'default'  => '#bfbfbf',
	'priority' => 1,
	'output'   => array(
		array(
			'element'  => 'a:hover, .posttitle a:hover, .entry-utility .datecont a:hover, .entry-utility a:hover, .entry-utility a:visited:hover, .more-link:hover,
							.pingback .comment-edit-link:hover, .pingback .comment-edit-link:focus, #breadcrumbs a:hover, .more:hover, .comment-reply-link:hover, 
							.pingback .comment-edit-link:hover,	.pingback .comment-edit-link:focus
						  ',
			'property' => 'color',
        ),
        array(
            'element'  => '.widget_calendar tbody a:hover, .widget_calendar tbody a:focus',
            'property' => 'background',
        ),
	),

) );


Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_main_body_separator_color',
	'label'  		=> esc_html__(  'Separator Color', 'minibuzzts' ),
	'section'      	=> 'main_body',
	'default'  		=> '#888888',
	'priority' 		=> 1,
	'output'   		=> array(
        array(
            'element'  => '.site-main > article, hr, .site-main > article .articlecontainer, .search .site-main > article, .sidebar .widget-container,
							.single .line, #beforecontent-wrap, .recentpost-widget, #slidercontainer, #top-nav-wrap, .sf-menu ul, .sf-menu li li
							
			',
            'property' => 'border-bottom-color',
        ),
        array(
            'element'  => '.comments-title, 
							.comment-list article, #top-nav-wrap, .sf-menu li li ul,
							.comment-list .pingback,
							.comment-list .trackback,
							.comment-list > li:first-child article,
							.comment-list > li:first-child .pingback,
							.comment-list > li:first-child .trackback
			',
            'property' => 'border-top-color',
        ),
        array(
            'element'  => ' .sidebar, .content-area.positionright, .sf-menu ul	 ',
            'property' => 'border-left-color',
        ),

        array(
            'element'  => ' .content-area, .sidebar.positionleft, .sf-menu li li, .sf-menu ul ',
            'property' => 'border-right-color',
        ),
				
	),

) );

Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_main_body_background_color',
	'label'       	=> esc_html__(  'Background', 'minibuzzts' ),
	'description' 	=> esc_html__(  'Background Color', 'minibuzzts' ),
	'section'      	=> 'main_body',
	'default'  		=> '#ffffff',
	'priority' 		=> 1,
	'output'   		=> array(
		array(
			'element'  => '#outercontainer, .sf-menu ul ',
			'property' => 'background',
		),

	),

) );

Kirki::add_field( 'minibuzzts', array(
	'type'         => 'background',
	'settings'     => 'minibuzzts_main_body_background',
	'section'      => 'main_body',
	'default'      => array(
		'image'    => '',
		'repeat'   => 'repeat',
		'size'     => 'inherit',
		'position' => 'center-center',
		'opacity'  => 100,
	),
	'priority'     => 1,
	'output'       => '#outercontainer',
) );


/*=============================================== Copyright Sections ===============================================*/

Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_copyright_text_color',
	'label'    		=> esc_html__(  'Copyright', 'minibuzzts' ),
	'description' 	=> esc_html__(  'Change the color of the text color.', 'minibuzzts' ),
	'section'      	=> 'footer',
	'default'  		=> '#999689',
	'priority' 		=> 1,
      'output'      => array(
        array(
          'element'  => '#footer .copyright',
          'property' => 'color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_copyright_link_color',
	'label'    		=> esc_html__(  'Copyright Link Color', 'minibuzzts' ),
	'description' 	=> esc_html__(  'Change the color of the link color.', 'minibuzzts' ),
	'section'      	=> 'footer',
	'default'  		=> '#999689',
	'priority' 		=> 1,
      'output'      => array(
        array(
          'element'  => ' #footer .copyright a',
          'property' => 'color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'    		=> 'color',
	'settings' 		=> 'minibuzzts_copyright_hover_color',
	'label'    		=> esc_html__(  'Copyright Link - Hover Color', 'minibuzzts' ),
	'description' 	=> esc_html__(  'Change the color of the link hover color.', 'minibuzzts' ),
	'section'      	=> 'footer',
	'default'  		=> '#df7034',
	'priority' 		=> 1,
	'output'  		=> array(
		array(
			'element'  => '#footer .copyright a:hover',
			'property' => 'color',
		),
	),

) );

Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_copyright_separator_first_color',
	'label'  		=> esc_html__(  'Copyright Separator Color', 'minibuzzts' ),
	'description' 	=> esc_html__(  'Change the first line color of the copyright color.', 'minibuzzts' ),
	'section'      	=> 'footer',
	'default'  		=> '#807a67',
	'priority' 		=> 1,
	'output'   		=> array(
        array(
            'element'  => '#footer .copyright',
            'property' => 'border-top-color',
        ),
				
	),

) );

Kirki::add_field( 'minibuzzts', array(
	'type'     		=> 'color',
	'settings' 		=> 'minibuzzts_copyright_separator_second_color',
	'description' 	=> esc_html__(  'Change the second line color of the copyright color.', 'minibuzzts' ),
	'section'      	=> 'footer',
	'default'  		=> '#c6c4ba',
	'priority' 		=> 1,
	'output'   		=> array(
        array(
            'element'  => '#footer .copyright:before',
            'property' => 'border-top-color',
        ),
				
	),

) );

/*=============================================== Other Sections ===============================================*/

//Blockquote
Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_blockquote_color',
	'label'       => esc_html__(  'Blockquote', 'minibuzzts' ),
	'section'     => 'other',
	'default'     => '#6b6b6b',
	'description' => esc_html__(  'Text Color', 'minibuzzts' ),
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => 'blockquote',
          'property' => 'color'
        ),
	),
) );

//Button 
Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_button_color',
	'label'       => esc_html__(  'Button', 'minibuzzts' ),
	'section'     => 'other',
	'default'     => '#ffffff',
	'description' => esc_html__(  'Text Color', 'minibuzzts' ),
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '	.button,
							button,
							input[type="submit"],
							input[type="reset"],
							input[type="button"],
							.button:hover, 
							button:hover,
							button:focus,
							input[type="button"]:hover,
							input[type="button"]:focus,
							input[type="reset"]:hover,
							input[type="reset"]:focus,
							input[type="submit"]:hover,
							input[type="submit"]:focus
							
						',
          'property' => 'color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_button_bg_color',
	'section'     => 'other',
	'default'     => '#000000',
	'description' => esc_html__(  'Background Color', 'minibuzzts' ),
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '	.button,
							button,
							input[type="submit"],
							input[type="reset"],
							input[type="button"]
							
						',
          'property' => 'background'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_button_bg_hover_color',
	'section'     => 'other',
	'default'     => '#DF7034',
	'description' => esc_html__(  'Background Hover Color', 'minibuzzts' ),
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '	.button:hover, 
							button:hover,
							button:focus,
							input[type="button"]:hover,
							input[type="button"]:focus,
							input[type="reset"]:hover,
							input[type="reset"]:focus,
							input[type="submit"]:hover,
							input[type="submit"]:focus
							
						',
          'property' => 'background'
        ),
	),
) );


//Page Navigation
Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_page_nav_text_color',
	'label'       => esc_html__(  'Page Navigation', 'minibuzzts' ),
	'section'     => 'other',
	'default'     => '#656253',
	'description' => esc_html__(  'Text Color', 'minibuzzts' ),
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '.page-numbers a, .page-numbers span, div.wp-pagenavi a, div.wp-pagenavi a:visited ',
          'property' => 'color'
        ),
	),
) );

Kirki::add_field( 'minibuzzts', array(
	'type'        => 'color',
	'settings'    => 'minibuzzts_page_nav_hover_color',
	'section'     => 'other',
	'default'     => '#DF7034',
	'description' => esc_html__(  'Text - Hover Color', 'minibuzzts' ),
	'priority'    => 1,
     'output'      => array(
        array(
          'element'  => '	div.wp-pagenavi a:hover, div.wp-pagenavi span.current,
		  					ul.page-numbers li a:hover,
							.page-numbers.current,
							.page-numbers.current:hover
						',
          'property' => 'color'
        ),
	),
) );




/*=============================================== Frontpage Sections ===============================================*/
// Slider
Kirki::add_field( 'minibuzzts', array(
    'type'        => 'text',
    'settings'    => 'minibuzzts_slider_tag',
    'label'       =>  esc_html__( 'Slider Tag', 'minibuzzts' ),
	'section'     => 'frontpage',
    'description'     =>  esc_html__( 'Use a tag slug to slide your posts.', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );


/*========== Homepage Template Sections ==========*/


// Featured 1
Kirki::add_field( 'minibuzzts', array(
    'type'        => 'image',
    'settings'    => 'minibuzzts_featured1_img',
    'label'       => esc_html__(  'Featured Page 1', 'minibuzzts' ),
	'description' =>  esc_html__( 'Image', 'minibuzzts' ),
    'section'     => 'homepage_template',
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'text',
    'settings'    => 'minibuzzts_featured1_title',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Title', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'textarea',
    'settings'    => 'minibuzzts_featured1_desc',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Description', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'text',
    'settings'    => 'minibuzzts_featured1_url',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Link Url', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );



// Featured 2
Kirki::add_field( 'minibuzzts', array(
    'type'        => 'image',
    'settings'    => 'minibuzzts_featured2_img',
    'label'       => esc_html__(  'Featured Page 2', 'minibuzzts' ),
	'description' =>  esc_html__( 'Image', 'minibuzzts' ),
    'section'     => 'homepage_template',
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'text',
    'settings'    => 'minibuzzts_featured2_title',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Title', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'textarea',
    'settings'    => 'minibuzzts_featured2_desc',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Description', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'text',
    'settings'    => 'minibuzzts_featured2_url',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Link Url', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );

// Featured 3
Kirki::add_field( 'minibuzzts', array(
    'type'        => 'image',
    'settings'    => 'minibuzzts_featured3_img',
    'label'       => esc_html__(  'Featured Page 3', 'minibuzzts' ),
	'description' =>  esc_html__( 'Image', 'minibuzzts' ),
    'section'     => 'homepage_template',
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'text',
    'settings'    => 'minibuzzts_featured3_title',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Title', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'textarea',
    'settings'    => 'minibuzzts_featured3_desc',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Description', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );

Kirki::add_field( 'minibuzzts', array(
    'type'        => 'text',
    'settings'    => 'minibuzzts_featured3_url',
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Link Url', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );


//Category
Kirki::add_field( 'minibuzzts', array(
    'type'        => 'text',
    'settings'    => 'minibuzzts_slide_cat_title',
    'label'       =>  esc_html__( 'Sidebar Category', 'minibuzzts' ),
	'section'     => 'homepage_template',
    'description' =>  esc_html__( 'Title', 'minibuzzts' ),
    'default'     => '',
    'priority'    => 1,
) );

//Select Category
$categories = get_categories();
$cats = array();
$i = 0;
foreach($categories as $category){
	if($i==0){
		$default = $category->slug;
		$i++;
	}
	$cats[$category->slug] = $category->name;
}

Kirki::add_field( 'my_config', array(
	'type'        => 'select',
	'settings'    => 'minibuzzts_slide_cat',
	'description' => esc_html__( 'Select Category:', 'minibuzzts' ),
	'section'     => 'homepage_template',
	'default'     => '',
	'priority'    => 1,
	'multiple'    => 1,
	'choices' 	  => $cats,
) );
