<?php
   if (!defined('ABSPATH')) {
      exit; 
   }
   global $donatm_post;

   $post_id = 0;
   if($donatm_post){
      $post_id = $donatm_post->ID;
   }

   $classes = array();
   $styles = array();
   //Breadcrumb by post
   if(get_post_meta($post_id, 'donatm_breadcrumb_layout', true) == 'page_options'){
      $breadcrumb_disable = get_post_meta($post_id, 'donatm_no_breadcrumbs', true);
      if($breadcrumb_disable){ return; }

      //Breacrumb Image Color
      $breadcrumb_bg_color = get_post_meta($post_id, 'donatm_breacrumb_bg_color', true);
      $breadcrumb_bg_color_opacity = get_post_meta($post_id, 'donatm_breacrumb_bg_opacity', true);
      $rgba_color = $this->convert_hextorgb($breadcrumb_bg_color);

      // Breadcrumb Image
      $breadcrumb_image = get_post_meta($post_id, 'donatm_breacrumb_image', true);
      if(is_numeric($breadcrumb_image)){
         $breadcrumb_image_url = wp_get_attachment_image_src( $breadcrumb_image, 'full');
      }else{
         $breadcrumb_image_url = $breadcrumb_image;
      }
      if($breadcrumb_image_url){
         $styles[] = 'background-image: url(\'' . $breadcrumb_image_url . '\')';
      }
   }

   $title = get_the_title();
   if(is_archive()) $title = single_cat_title('', false);
   if(class_exists('WooCommerce') && is_shop()){
      $title = woocommerce_page_title(false);
   }

   if(is_search()){
      $title = esc_html__('Search', 'donatm-themer');
   }

   if( empty($title) && is_archive() ){
      $title = get_the_archive_title();
   }

   // Classes
   //$classes[] = $breadcrumb_text_align;

   $css = '';
   if(count($styles) > 0){
      $css= 'style="' . implode(';', $styles) . '"';
   }
   
?>
   
<div class="post-breadcrumb">
   <div class="custom-breadcrumb <?php echo implode(' ', $classes); ?>" <?php echo $css; ?>>
      <div class="breadcrumb-overlay"></div>
      <div class="breadcrumb-main">
        <div class="container">
          <div class="breadcrumb-container-inner">
            <?php 
               if($title && $settings['show_title'] == 'yes'){ 
                 echo '<h2 class="heading-title">' . html_entity_decode($title) . '</h2>';
               } 
               if($settings['show_links']){
                  $this->breadcrumbs(); 
               }
            ?>
          </div>  
        </div>   
      </div>  
   </div>
</div>      

