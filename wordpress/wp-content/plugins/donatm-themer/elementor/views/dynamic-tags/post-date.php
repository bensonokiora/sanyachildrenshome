<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $donatm_post;
   if (!$donatm_post){
      return;
   }
   ?>
   
   <div class="post-date">
         <?php 
            if($settings['show_icon']){ 
               echo '<i class="far fa-calendar"></i>';
            }
            echo get_the_date( get_option('date_format'), $donatm_post->ID);
         ?>
   </div>      

