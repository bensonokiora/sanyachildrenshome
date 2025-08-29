<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $donatm_post;
   if (!$donatm_post){
      return;
   }
?>

<?php 
   $thumbnail_size = $settings['donatm_image_size'];

   if(has_post_thumbnail($donatm_post)){
      echo get_the_post_thumbnail($donatm_post, $thumbnail_size);
   }
?>

