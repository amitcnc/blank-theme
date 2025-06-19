<?php 
  get_header();
  $not_found_image        = get_field('not_found_image','option'); 
  $not_found_title        = get_field('not_found_title','option');
  $not_found_content      = get_field('not_found_content','option');
  $back_home_button       = get_field('back_home_button','option');
?>	

<?php if(!empty($not_found_image) || !empty($not_found_title) || !empty($not_found_content) || !empty($back_home_button)): ?>
<div class="error_page">
    <div class="wrapper">

        <?php if(!empty($not_found_image)): ?>
        <img src="<?php echo $not_found_image['url'];?>"alt="<?php echo $not_found_image['alt'];?>">
        <?php endif; ?>

        <?php if(!empty($not_found_title) || !empty($not_found_content) || !empty($back_home_button)): ?>
        <div class="text d_flex">
            <div class="left_col">
                <?php if(!empty($not_found_title)):?><h1><?php echo $not_found_title;?></h1><?php endif; ?>
                <?php if(!empty($back_home_button)):?><a href="<?php echo home_url();?>" class="btn btny"><?php echo $back_home_button['title']; ?></a><?php endif; ?>
            </div>
            <div class="right_col">
              <?php if(!empty($not_found_content)):?><?php echo $not_found_content; ?><?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<?php  get_footer();