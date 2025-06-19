<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
Class wptheme_FrameWork {
    public function __construct() {
        $this->helper();
    }
    public function helper(){
        /** Include Functions Files **/
        include_once( CNC_THEME_DIR . '/inc/core_func.php' );
        include_once( CNC_THEME_DIR . '/inc/security_func.php' );
        include_once( CNC_THEME_DIR . '/inc/scripts_enqueuer.php' );
        include_once( CNC_THEME_DIR . '/inc/acf_func.php' ); 
        include_once( CNC_THEME_DIR . '/inc/breadcrumb.php' ); 
    }
}
// Install Theme
$theme = new wptheme_FrameWork();