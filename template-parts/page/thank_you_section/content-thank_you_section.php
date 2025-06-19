<?php
/*
    * Template Part Name    : Content Thank You Section
    * Flexbile Layout Key   : content_thank_you_section
    */
  $thank_you_title = get_field('thank_you_title','option');
  $thank_you_content = get_field('thank_you_content','option');
  $thank_you_button_url = get_field('thank_you_button_url','option');
  global $is_preview;

if( !empty($thank_you_title) || !empty($thank_you_content) || !empty($thank_you_button_url)): ?>

<section class="thankyou-section <?php echo ($is_preview) ? ' acf-admin-preview' : ''; ?>">
  <div class="container">
    <div class="thanks-wrapper text-center">
      <?php if($thank_you_title): ?><h1><?php echo $thank_you_title; ?></h1><?php endif; ?>
      <?php if($thank_you_content): echo $thank_you_content; endif; ?>
      <?php if($thank_you_button_url): 
            $link_title = $thank_you_button_url['title'];
            $link_url   = $thank_you_button_url['url'];
            $link_target = $thank_you_button_url['target'] ? $thank_you_button_url['target'] : '_self';
      ?> 
        <a class="btn" href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>"><?php echo $link_title; ?></a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>