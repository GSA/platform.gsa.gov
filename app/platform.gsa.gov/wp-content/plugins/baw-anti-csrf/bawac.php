<?php
/*
Plugin Name: BAW Anti CSRF
Plugin URI: http://www.boiteaweb.fr/
Description: Avoid CSRF attacks from bad crafted plugin's page
Version: 1.5.2
Author: juliobox
Author URI: http://boiteaweb.fr/plugin-anti-csrf-wordpress-faille-3556.html
License: GPLv2
*/

define( 'BAWAC_VERSION', '1.5.2' );

if( is_admin() ):

add_action( 'admin_init', 'bawac_force_nonce_init', 1 );
function bawac_force_nonce_init()
{
	if( ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) && isset( $_GET['page'] ) && !isset( $_GET['bawac_force_nonce'] ) ):
		$nonce = wp_create_nonce( '__BAW__' ) ;
		$url = add_query_arg( 'bawac_force_nonce', $nonce );
		$html = '<p>' . __( 'You are attempting to visit this page:', 'bawac' ) . '</p>' . esc_url( $_SERVER['REQUEST_URI'] ) . '<p>' . __( 'Do you really want to visit this page ?<br />', 'bawac' );
		$html .= sprintf( __( '<a href="%s"><img src="%s" alt="Yes" title="Yes" /> Yes</a><br /><a href="%s"><img src="%s" alt="No" title="No" /> No</a>', 'bawac' ), esc_url_raw( $url ), admin_url( '/images/yes.png' ), admin_url(), admin_url( '/images/no.png' ) ) . '</p>';
		wp_die( $html, 'BAW Anti-CSRF Protection' );
	endif;
	
	if( $GLOBALS['pagenow'] == 'update.php' ) return;
	if( defined( 'DOING_AJAX' ) && DOING_AJAX && isset( $_REQUEST['action'] ) ) :
		$core_actions = array(
			'fetch-list', 'ajax-tag-search', 'wp-compression-test', 'imgedit-preview', 'oembed-cache',
			'autocomplete-user', 'dashboard-widgets', 'logged-in',
			'oembed-cache', 'image-editor', 'delete-comment', 'delete-tag', 'delete-link',
			'delete-meta', 'delete-post', 'trash-post', 'untrash-post', 'delete-page', 'dim-comment',
			'add-link-category', 'add-tag', 'get-tagcloud', 'get-comments', 'replyto-comment',
			'edit-comment', 'add-menu-item', 'add-meta', 'add-user', 'autosave', 'closed-postboxes',
			'hidden-columns', 'update-welcome-panel', 'menu-get-metabox', 'wp-link-ajax',
			'menu-locations-save', 'menu-quick-search', 'meta-box-order', 'get-permalink',
			'sample-permalink', 'inline-save', 'inline-save-tax', 'find_posts', 'widgets-order',
			'save-widget', 'set-post-thumbnail', 'date_format', 'time_format', 'wp-fullscreen-save-post',
			'wp-remove-post-lock', 'dismiss-wp-pointer', 'upload-attachment',
		);
		if( in_array( $_REQUEST['action'], $core_actions ) ) return;
	endif;
	load_plugin_textdomain( 'bawac', '', dirname( plugin_basename( __FILE__ ) ) . '/lang' );
	
	$plugin_page = isset( $_REQUEST['page'] ) ? plugin_basename( stripslashes( $_REQUEST['page'] ) ) : null;

	if( !empty( $plugin_page ) ):
		if(	count( $_REQUEST ) && ( !isset( $_REQUEST['bawac_force_nonce'] ) || !wp_verify_nonce( $_REQUEST['bawac_force_nonce'], '__BAW__' ) ) )
			if( defined( 'DOING_AJAX' ) && DOING_AJAX ):
				die( -1 );
			else:
				bawac_die();
			endif;
	endif;

	ob_start();
}

function bawac_die()
{
	include( ABSPATH . '/wp-includes/version.php' );
	wp_die( sprintf( __( 	'<b>%s</b><br /><br />If you read this, maybe something goes wrong with the plugin "BAW Anti CSRF".<br /><br />'.
							'Please, copy/paste this into a new support post here : %s<br />'.
							'<textarea rows="5" cols="85">%s</textarea><br /><em>Feel free to add or remove informations.</em><br /><br />'.
							'You can deactivate the plugin with this link if you need to: %s<br /><br />'.
							'Thank you!', 'bawac' ), 
						__( 'Are you sure you want to do this?' ),
						'<a href="http://wordpress.org/support/plugin/baw-anti-csrf">' . __( 'BAW Anti CSRF Free Support', 'bawac' ) .'</a>',
						esc_textarea(	'WordPress Version: ' . $wp_version . "\n" .
										'PHP Version: ' . PHP_VERSION . "\n" .
										'This Version: ' . BAWAC_VERSION . "\n" .
										'Referer: ' . esc_html( str_replace( site_url(), '', wp_get_referer() ) ) . "\n" . 
										'Actual page: ' . esc_html( $_SERVER['REQUEST_URI'] )
									),
						'<a href="' . wp_nonce_url( admin_url( 'plugins.php?action=deactivate&plugin=baw-anti-csrf%2Fbawac.php&plugin_status=all&paged=1' ), 'deactivate-plugin_baw-anti-csrf/bawac.php' ) . '">' . __( 'Deactivate' ) . ' BAW Anti CSRF :(</a>'
					),
			__( 'BAW Anti CSRF &rsaquo; Error', 'bawac' ), 
			array( 'back_link' => true ) 
	);
}

add_action( 'admin_footer', 'bawac_force_nonce_foot', 999 );
function bawac_force_nonce_foot()
{
	if( $GLOBALS['pagenow'] != 'update.php' ):
		$plugin_page = isset( $_REQUEST['page'] ) ? plugin_basename( stripslashes( $_REQUEST['page'] ) ) : '';
		$nonce = wp_create_nonce( '__BAW__' );
		$content = ob_get_contents();
		$baw_force_token = wp_generate_password( 10, false );
		$new_fields = wp_nonce_field( '__BAW__' . date( 'a' ), 'bawac_force_nonce', false, false ) . '<input type="hidden" name="page" value="' . $plugin_page . '" />';
		if( !empty( $plugin_page ) )
			$content = preg_replace( '/(<form(.+)>)/', '$1' . $new_fields, $content );
		$content = preg_replace( '/(\&|\?)page=/i', '$1bawac_force_nonce=' . $nonce . '&page=', $content );
		ob_end_clean();
		echo $content;
		if( !empty( $plugin_page ) ):
			?>
			<script>
			jQuery( 'body' ).on( 'ajaxSend' , function( elm, xhr, s ){
				if( s.data!=null && s.data.indexOf( 'bawac_force_nonce=' ) === -1 ){
					if( s.data.indexOf( '&page=' ) === -1 && s.data.indexOf( '?page=' ) === -1 )
						s.data = s.data + '&page=<?php echo $plugin_page; ?>&bawac_force_nonce=<?php echo $nonce ?>';
				}
			});
			</script>
			<?php
		endif;
	endif;
}

add_action( 'plugins_loaded', 'bawac_plugins_loaded', 0 );
function bawac_plugins_loaded()
{
	add_filter( 'admin_url', 'bawac_correct_url' );
	add_filter( 'network_admin_url', 'bawac_correct_url' );
	add_filter( 'wp_redirect', 'bawac_correct_url' );
}

function bawac_correct_url( $location )
{
	if( strstr( $location, 'bawac_force_nonce' ) == '' ):
		$nonce = wp_create_nonce( '__BAW__' );
		$location = preg_replace( '/(\&|\?)page=/i', '$1bawac_force_nonce=' . $nonce . '&page=', $location );
	endif;
	return $location;
}

function bawac_dashboard_rightnow()
{
	echo '<p>' . __( 'Site protected by <a href="http://boiteaweb.fr/plugin-anti-csrf-wordpress-faille-3556.html"><b>BAW Anti-CSRF</b></a>', 'bawac' ) . '</p>';
}
add_action( 'rightnow_end', 'bawac_dashboard_rightnow' );

endif;