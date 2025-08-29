<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $donatm_post;
   if (!$donatm_post){
      return;
   }
   $html_tag = $settings['html_tag'];
?>

<div class="donatm-post-title">
   <<?php echo esc_attr($html_tag) ?> class="post-title">
      <span><?php echo get_the_title($donatm_post) ?></span>
   </<?php echo esc_attr($html_tag) ?>>
</div>   