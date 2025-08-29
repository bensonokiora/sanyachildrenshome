<?php
   if (!defined('ABSPATH')){ exit; }
  
   global $donatm_post;

   if (!$donatm_post){ return; }

   if ($donatm_post->post_type != 'give_forms'){ return;}

   $form_id = $donatm_post->ID;

   $args = array(
      'show_title' => $settings['show_title'],
      'id'         => $form_id
   )
?>

<div class="givewp-content-form">
   <?php echo give_form_shortcode($args); ?>
</div>

