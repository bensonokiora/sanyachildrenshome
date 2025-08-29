<?php
   if (!defined('ABSPATH')){ exit; }
   use Elementor\Icons_Manager;
   use Elementor\Group_Control_Image_Size;
   $classes = array();
   $classes[] = 'gsc-marquee';
   $this->add_render_attribute('wrapper', 'class', $classes);
   $_rand = wp_rand();
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div>
      <div class="marquee-text" data-direction="<?php echo $settings['direction'] ?>" data-duration="<?php echo $settings['duration'] ?>" data-gap="<?php echo $settings['gap'] ?>" data-pauseonhover="<?php echo $settings['pause_on_hover'] ?>">
         <?php
            foreach ($settings['content_items'] as $item){ 
               $image_url = isset($item['image']['url']) ? $item['image']['url'] : '';
               $image_id = $item['image']['id']; 
               if($image_id){
                  $attach_url = Group_Control_Image_Size::get_attachment_image_src($image_id, 'image', $settings);
                  if($attach_url){
                     $image_url = $attach_url;
                  }
               }
               echo '<span class="marquee-item" data-rand="' . $_rand . '">';
                  echo '<span class="marquee-dot"></span>';
                  echo '<span class="marquee-title">';
                     if($image_url){
                        echo '<span class="marquee-image">';
                           echo '<img src="' . esc_url($image_url) . '" alt="' . $item['title'] . '" />';
                        echo '</span>';
                     }
                     echo $item['title'];
                  echo '</span>';
               echo '</span>';
            } 
         ?>
       
      </div>
   </div>   
</div>
