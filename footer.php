<?php 
    $footer_white_logo                = get_field('footer_white_logo','option');
    $footer_sign_up_button            = get_field('footer_sign_up_button','option');
    $info_email                       = get_field('info_email','option');
    $copyright_text                   = get_field('copyright_text','option');
    $linkedin_link                   = get_field('linkedin_link','option');
    $footer_menu                    = get_field('footer_menu','option');      
    $footer_social_link_list          = get_field('footer_social_link_list','option');      
?>

        </div><!-- END Main div -->
        <div class="push"><!-- --></div>
    </div><!-- END FULL WRAPPER div-->  
    <footer>
        <div class="top_footer">
            <div class="wrapper">
                <?php if( !empty($footer_white_logo) || !empty($footer_sign_up_button)): ?>  
                <div class="top d_flex">
                    <?php if( !empty($footer_white_logo)): ?>  
                        <a href="<?php echo home_url(); ?>" class="logo"> 
                            <img src="<?php echo $footer_white_logo['url']; ?>" alt="<?php echo $footer_white_logo['alt']; ?>"> 
                        </a>
                    <?php endif; ?>
                    
                    <?php if( $footer_sign_up_button ): 
                        $footer_sign_up_button_url = $footer_sign_up_button['url'];
                        $footer_sign_up_button_title = $footer_sign_up_button['title']; ?>
                        <a class="btn btny" href="<?php echo esc_url( $footer_sign_up_button_url ); ?>"><?php echo esc_html( $footer_sign_up_button_title ); ?></a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="bottom d_flex">
                    <?php if( !empty($footer_menu) ): ?>
                        <ul class="d_flex">
                            <?php while( have_rows('footer_menu','option') ) : the_row();
                                $footer_menu_link = get_sub_field('footer_menu_link','option');
                                
                                if( $footer_menu_link ): 
                                    $footer_menu_link_url = $footer_menu_link['url'];
                                    $footer_menu_link_title = $footer_menu_link['title']; ?>
                                        <li><a href="<?php echo esc_url( $footer_menu_link_url ); ?>"><?php echo esc_html( $footer_menu_link_title ); ?></a></li>
                                <?php endif; 
                            endwhile; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if( !empty($info_email) ): ?>
                    <a href="mailto:<?php echo $info_email; ?>" class="email"><img src="<?php echo CNC_THEME_URL; ?>/assets/images/site/email.svg" alt="email"><?php echo $info_email; ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="bottom_footer">
            <div class="wrapper d_flex">
                <?php if( !empty($copyright_text) ): ?>
                    <?php echo $copyright_text ?>
                <?php endif; ?>

                <?php if( !empty($footer_social_link_list) ): ?>
                <?php while( have_rows('footer_social_link_list','option') ) : the_row();
                $footer_social_link_icon = get_sub_field('footer_social_link_icon','option');
                $footer_social_link_url  = get_sub_field('footer_social_link_url','option');

                if( !empty( $footer_social_link_icon ) && !empty( $footer_social_link_url ) ):
                ?>
                <a href="<?php echo $footer_social_link_url; ?>" target="_blank">
                    <img src="<?php echo $footer_social_link_icon['url']; ?>" alt="<?php echo $footer_social_link_icon['alt']; ?>">
                </a>
                <?php endif; endwhile; endif; ?>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>  
</body>
</html>