<?php 
/* Template Name: Contact Page Template */
get_header(); 
$contact_title           = get_field('contact_title');
$contact_content         = get_field('contact_content');
$contact_form            = get_field('contact_form');
if( !empty($contact_title) || !empty($contact_content) || !empty($contact_form)): ?>
<div class="contact_page">
    <div class="wrapper d_flex">
        <img src="<?php echo CNC_THEME_URL; ?>/assets/images/site/contacttree.png" class="contacttree" alt="contacttree">        
        <?php if( !empty($contact_title) || !empty($contact_content)): ?>
        <div class="left_col">
            <?php if( !empty($contact_title)): ?>
                <h1><?php echo $contact_title ?></h1>
            <?php endif; ?>
            
            <?php if( !empty($contact_content)): ?>
                <?php echo $contact_content ?>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($contact_form)): ?>
        <div class="right_col">
            <?php   
                if(!empty($contact_form)):                     
                $forM_id = $contact_form[0]->ID;
                $title = get_the_title($forM_id);
                echo do_shortcode('[contact-form-7 id="'.$forM_id.'" title="'.$title.'"]'); 
                endif;
            ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php get_footer();?>