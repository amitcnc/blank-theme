<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head> 
        <?php    
            $site_preview_image               = get_field( 'site_preview_image', 'option' );   
            if(!empty($site_preview_image)){
                $site_preview_image  = get_field( 'site_preview_image', 'option' )['url'];
            }else if(!empty($site_preview_image)){
                $site_preview_image = get_the_post_thumbnail_url(get_the_ID(), 'full'); 
            }else{
                $site_preview_image = CNC_THEME_URL.'/assets/images/screenshot.jpg';
            }
        ?>  
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="x-ua-compatible" content="IE=Edge">
   
        <!-- Chrome, Firefox OS, Opera and Vivaldi -->
        <meta name="theme-color" content="#000">
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="#000">
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="#000">       
        <meta property="og:description" content="<?php bloginfo('name'); ?>">
        <meta name="twitter:description" content="<?php bloginfo('name'); ?>">        
        <meta name="twitter:creator" content="<?php bloginfo('name'); ?>">
        <meta name="twitter:site" content="<?php bloginfo('name'); ?>">        
        <meta name="twitter:title" content="<?php bloginfo('name'); ?>">
        <meta name="twitter:image" content="<?php echo $site_preview_image; ?>">
        <meta name="pinterest-rich-pin" content="IDC-Card">       

        <!-- Favicon -->
        <link rel="icon" type="image/ico" href="<?php echo CNC_THEME_URL; ?>/assets/images/site/favicon.ico" /> 
        <link rel="mask-icon" href="<?php echo CNC_THEME_URL; ?>/assets/images/site/favicon.ico"/>  
        <?php wp_head(); ?>	
    </head>
    <body <?php body_class(); ?>>           
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <header>
            <div class="wrapper d_flex"> 
                <div class="right_col d_flex">
                    <?php 
                        wp_nav_menu( 
                            array(                                    
                                'menu'              => 'menu-top-desktop',
                                'container'         => false,                                   
                                'menu_class'        => 'd_flex',                                        
                                'theme_location'    => 'header-menu'                                
                             ) );     
                    ?>  
                </div>
            </div>
        </header>
        <!-- FULL WRAPPER-->
        <div id="full_wrapper">
            <div class="main">