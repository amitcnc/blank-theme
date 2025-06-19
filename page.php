<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage CNC_Theme
 * @since  1.0
 * @version 1.0
 */

get_header(); 
if (have_posts()) {
    if (have_rows('page_layouts')) {
        while (have_rows('page_layouts')) {the_row();
            get_template_part('template-parts/page/'.get_row_layout().'/content', get_row_layout());             
        }
    }  
    elseif ( !have_rows('page_layouts') && !( is_account_page() || is_cart() || is_checkout() ) ) {
        ?>
        <section class="other-section">
            <div class="container">
                <div class="title-wrapper text-center">
                    <?php the_title('<h2>', '</h2>'); ?>
                </div>
                <?php the_content(); ?>
            </div>
        </section>
        <?php
    }
    else {        
        the_title('<h2>', '</h2>'); 
        the_content();             
    }
}
get_footer();