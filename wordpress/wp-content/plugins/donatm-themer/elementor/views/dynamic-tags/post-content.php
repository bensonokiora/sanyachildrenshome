<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $donatm_post;
   if (!$donatm_post){
      return;
   }
   ?>
   
   <div class="post-content">
      <?php 
      if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
         echo do_shortcode( $donatm_post->post_content );
      }else{
         $content = apply_filters( 'the_content', $donatm_post->post_content );
         echo do_shortcode($content);
      }
      ?>
   </div> 