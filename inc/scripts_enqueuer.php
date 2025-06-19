<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Enqueue scripts and styles.
*/

add_action( 'wp_enqueue_scripts', 'wptheme_scripts' );
function wptheme_scripts() {
    // Theme stylesheet.
    $version = 1.0; 
    $get_page_template = get_page_template();   
      
    wp_enqueue_style( 'wptheme-screen', get_theme_file_uri( '/assets/css/screen.css' ), array(), $version );
    wp_enqueue_style( 'wptheme-custom', get_theme_file_uri( '/assets/css/custom.css' ), array(), $version );  
    
    //Theme js.  
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'wptheme-script', get_theme_file_uri( '/assets/js/script.js' ), array( 'jquery' ), true,  time() );   
    wp_localize_script( 'wptheme-script', 'wptheme_script_obj', array( 'template_di_uri' => CNC_THEME_URL ) );      
    wp_enqueue_script( 'wptheme-custom', get_theme_file_uri( '/assets/js/custom.js' ), array( 'jquery' ), time() );
    wp_localize_script( 'wptheme-custom', 'wptheme_ajax_obj', array(  'ajaxurl' => admin_url( 'admin-ajax.php' ),'get_page_template' => $get_page_template ) );     
};

/**
 *  Remove Not used css & JS
 */
/* De register css */
add_action( 'wp_print_styles', 'wptheme_deregister_styles', 9999);
function wptheme_deregister_styles() {
    wp_dequeue_style('wc-block-style');
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('contact-form-7');    
}