<?php 
function custom_breadcrumbs() {
    // Settings
    $separator = ' / ';
    $home_title = 'Home';
    $post_type = get_post_type();

    // Get the query & post information
    global $post, $wp_query;

    // Start the breadcrumb with a link to your homepage
    echo '<nav>';
    echo '<a href="' . home_url() . '">' . $home_title . '</a>' . $separator;

    if (is_home()) {
        
       
    } elseif (is_single()) {
        // Single post
      
        $post_type_object = get_post_type_object($post_type);
        $slug = $post_type_object->rewrite['slug'];
        if ($post_type !== 'post') {
            // Custom post type
          
            if($post_type == 'partners'){
                $parter_pageid = 1604;
                echo '<a href="' . home_url() . '/' . get_post_field( 'post_name', $parter_pageid ) . '/">' . get_the_title($parter_pageid) . '</a>' . $separator;
            }else{                       
                echo '<a href="' . home_url() . '/' . $slug . '/">' . $post_type_object->labels->singular_name . '</a>' . $separator;
            }            
        }

         if ($post_type == 'post') {
            $news_pageid = 1715;
            echo '<a href="' . home_url() . '/' . get_post_field( 'post_name', $news_pageid ) . '/">' . get_the_title($news_pageid) . '</a>' . $separator;
        }

      

        // Get categories
        // $category = get_the_category();
        // if (!empty($category)) {
        //     $last_category = end($category);
        //     $cat_parents = get_category_parents($last_category->term_id, true, $separator);
        //     echo $cat_parents;
        // }

        echo '<span>' . get_the_title() . '</span>';
    } elseif (is_page()) {
        // Standard page
        if ($post->post_parent) {
            $ancestors = get_post_ancestors($post->ID);
            $ancestors = array_reverse($ancestors);

            foreach ($ancestors as $ancestor) {
                echo '<a href="' . get_permalink($ancestor) . '">' . get_the_title($ancestor) . '</a>' . $separator;
            }
        }
        echo '<span>' . get_the_title() . '</span>';
    } elseif (is_category()) {
        // Category archive
        $current_category = get_category(get_query_var('cat'), false);
        if ($current_category->parent != 0) {
            echo get_category_parents($current_category->parent, true, $separator);
        }
        echo '<span>' . single_cat_title('', false) . '</span>';
    }elseif (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        echo '<span>Author: ' . $userdata->display_name . '</span>';
    } elseif (is_search()) {
        echo '<span>Search results for "' . get_search_query() . '"</span>';
    } elseif (is_404()) {
        echo '<span>404 - Page not found</span>';
    } elseif ( is_post_type_archive( $post_type) ){      
        $post_type_object = get_post_type_object($post_type);
        $slug = $post_type_object->rewrite['slug'];
        echo '<span>' . $post_type_object->labels->singular_name . '</span>';
    }

    echo '</nav>';
}
