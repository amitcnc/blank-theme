<?php 
/* Template Name: Thank You */ 
  get_header();
  $thank_you_image  = get_field('thank_you_image','option');
  $thank_you_title = get_field('thank_you_title','option');
  $thank_you_content = get_field('thank_you_content','option');
  $thank_back_home_button = get_field('thank_back_home_button','option');
?>
<?php if( !empty($thank_you_image) || !empty($thank_you_title) || !empty($thank_you_content) || !empty($thank_back_home_button)): ?>
  <div class="thankyou_page">
      <div class="wrapper">
          <?php if(!empty($thank_you_image)): ?>
          <img src="<?php echo $thank_you_image['url'];?>"alt="<?php echo $thank_you_image['alt'];?>">
          <?php endif; ?>

          <?php if(!empty($thank_you_title)):?><h1><?php echo $thank_you_title;?></h1><?php endif; ?>
          <?php if(!empty($thank_you_content)):?><?php echo $thank_you_content; ?><?php endif; ?>
          <?php if(!empty($thank_back_home_button)):?><a href="<?php echo home_url();?>" class="btn btny"><?php echo $thank_back_home_button['title']; ?></a><?php endif; ?>
      </div>
  </div>
<?php endif; ?>
<?php  get_footer();