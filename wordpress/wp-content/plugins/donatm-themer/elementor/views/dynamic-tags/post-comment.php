<?php
   if (!defined('ABSPATH')){ exit; }

   global $donatm_post, $post;

   if(!$donatm_post){ return; }
   $post = $donatm_post;
?>
   
<div class="post-comment">
   <?php
      if(comments_open($donatm_post->ID)){
         comments_template();
      }else{
         if(\Elementor\Plugin::$instance->editor->is_edit_mode()){
            echo '<div class="alert alert-info">' . esc_html__('This Post Disabled Comment', 'donatm-themer') . '</div>';
         }
      }
   ?>
</div>      

