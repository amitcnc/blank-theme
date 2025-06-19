<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/** svg file uplode **/
add_filter(
	'upload_mimes',
	function ( $upload_mimes ) {	
		if ( ! current_user_can( 'administrator' ) ) {
			return $upload_mimes;
		}

		$upload_mimes['svg']  = 'image/svg+xml';
		$upload_mimes['svgz'] = 'image/svg+xml';

		return $upload_mimes;
	}
);
/**
 * Add SVG files mime check.
 */
add_filter(
	'wp_check_filetype_and_ext',
	function ( $wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime ) {

		if ( ! $wp_check_filetype_and_ext['type'] ) {

			$check_filetype  = wp_check_filetype( $filename, $mimes );
			$ext             = $check_filetype['ext'];
			$type            = $check_filetype['type'];
			$proper_filename = $filename;

			if ( $type && 0 === strpos( $type, 'image/' ) && 'svg' !== $ext ) {
				$ext  = false;
				$type = false;
			}

			$wp_check_filetype_and_ext = compact( 'ext', 'type', 'proper_filename' );
		}
		return $wp_check_filetype_and_ext;
	},
	10,
	5
);
/** Theme Support **/
add_action( 'after_setup_theme', 'wptheme_setup' );
function wptheme_setup() {	     
    load_theme_textdomain( 'CNC_Theme', CNC_THEME_DIR . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );    
    add_filter( 'jpeg_quality', fn() => 85 );
    //Disable big image scaling (WP 5.3+)
    //Disabled Big Image Scaling: Prevents WordPress from creating scaled-down versions of large uploads
    add_filter( 'big_image_size_threshold', '__return_false' );
}


/** Menu Register **/
add_action( 'init', 'wptheme_custom_menus' );
function wptheme_custom_menus() {
    register_nav_menus(
        array(           
            'header-menu'             => __( 'Header Menu' ,'CNC_Theme' ),  
            'footer-menu'             => __( 'Footer Menu' ,'CNC_Theme' ),          
        )
    );
	if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
	// Disable comments  using code end here
	remove_post_type_support( 'page', 'comments' );
}

/** Auto P tag Remove **/
remove_filter('the_excerpt', 'wpautop');

/** Remove Auto P tag from CF7 */
add_filter('wpcf7_autop_or_not', '__return_false');

/** Redirect CF7 To Thank You Page **/
add_action( 'wp_footer', 'wptheme_redirect_cf7' );
function wptheme_redirect_cf7() {
?>
<script>
    /*document.addEventListener( 'wpcf7mailsent', function( event ) {
        
        if ( '103' == event.detail.contactFormId ) { 
            location = '<?php //echo get_the_permalink(124) ?>';                   
        
        }
    }, false );*/
    </script>
<?php }

/**
 * Remove Unused Pages From WP Admin Side Bar
 */
add_action( 'admin_menu', 'wptheme_remove_menu_pages' );
function wptheme_remove_menu_pages() {
    remove_menu_page( 'edit-comments.php' );
}

/** Hide Admin Bar From Mobile **/
if ( current_user_can( 'manage_options' ) ) {
	if(wp_is_mobile()){
		show_admin_bar( false );	
	}
}

/** Remove Plugin Update **/
//add_filter('site_transient_update_plugins', 'wptheme_remove_update_notifications');
function wptheme_remove_update_notifications($value) {
	if ( isset( $value ) && is_object( $value ) ) {
        unset($value->response[ 'advanced-custom-fields-pro/acf.php' ]);
    }
    return $value;
}
add_filter('gutenberg_can_edit_post', '__return_false', 5);
add_filter('use_block_editor_for_post', '__return_false', 5);
 
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);

// 5. Disable comments  using code start here
// paste the code into function.php file

add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
    
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }

    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');

    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});

// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
add_shortcode('current_year','current_year');
function current_year() {
    $year = date('Y');
    return $year;
}
 
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
 
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
 
// Remove comments page in menu
add_action( 'admin_menu', 'cnc_remove_menu_pages' );
function cnc_remove_menu_pages() {
    remove_menu_page( 'edit-comments.php' );
}
 
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
}); 

add_filter( 'rest_endpoints', 'disable_default_endpoints' );
function disable_default_endpoints( $endpoints ) {
    $endpoints_to_remove = array(
        '/oembed/1.0',
        '/wp/v2',
        '/wp/v2/media',
        '/wp/v2/types',
        '/wp/v2/statuses',
        '/wp/v2/taxonomies',
        '/wp/v2/tags',
        '/wp/v2/users',
        '/wp/v2/comments',
        '/wp/v2/settings',
        '/wp/v2/themes',
        '/wp/v2/blocks',
        '/wp/v2/oembed',
        '/wp/v2/posts',
        '/wp/v2/pages',
        '/wp/v2/block-renderer',
        '/wp/v2/search',
        '/wp/v2/categories'
    );
 
    if ( ! is_user_logged_in() ) {
        foreach ( $endpoints_to_remove as $rem_endpoint ) {
            // $base_endpoint = "/wp/v2/{$rem_endpoint}";
            foreach ( $endpoints as $maybe_endpoint => $object ) {
                if ( stripos( $maybe_endpoint, $rem_endpoint ) !== false ) {
                    unset( $endpoints[ $maybe_endpoint ] );
                }
            }
        }
    }
    return $endpoints; 
}

define( 'CNC_THEME_DIR', get_template_directory() );
define( 'CNC_THEME_URL', get_template_directory_uri() );    