<?php 
use Elementor\Icons_Manager;
   
$has_icon = ! empty( $item['selected_icon']['value']); 
$style = $settings['style'];
$avatar = (isset($item['testimonial_image']['url']) && $item['testimonial_image']['url']) ? $item['testimonial_image']['url'] : '';
?>
<div class="testimonial-item <?php echo esc_attr($style) ?> elementor-repeater-item-<?php echo $item['_id'] ?>">
   
   <?php if( $style == 'style-1'){ ?>
      <div class="testimonial-one__single">
         <div class="testimonial-one__quote">
            <div class="testimonial-one__stars">
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
               <i class="fa fa-star"></i>
            </div>
            <?php echo esc_html($item['testimonial_content']); ?>
         </div>
         <div class="testimonial-one__content">
            <span class="testimonial-one__icon"><i class="dicon-straight-quotes"></i></span>
            <div class="testimonial-one__meta">
               <?php 
                  if($avatar){ 
                     echo '<div class="testimonial-one__image">';
                        echo '<img src="' . esc_url($avatar) . '" alt="' . $item['testimonial_name'] . '" />';
                     echo '</div>';
                  }
               ?>
               <div class="testimonial-one__information">
                  <h3 class="testimonial-one__name"><?php echo $item['testimonial_name']; ?></h3>
                  <div class="testimonial-one__job"><?php echo $item['testimonial_job']; ?></div>
                  
               </div>
            </div>
         </div>
      </div>      
   <?php } ?>  

   <?php if( $style == 'style-2'){ ?>
      <div class="testimonial-two__single">
         <span class="testimonial-two__icon"><i class="dicon-straight-quotes"></i></span>
         <div class="testimonial-two__quote">
            <?php echo $item['testimonial_content']; ?>
         </div>
         <div class="testimonial-two__content">
            <div class="testimonial-two__meta">
               <?php 
                  if($avatar){ 
                     echo '<div class="testimonial-two__image">';
                        echo '<img src="' . esc_url($avatar) . '" alt="' . $item['testimonial_name'] . '" />';
                     echo '</div>';
                  }
               ?>
               <div class="testimonial-two__information">
                  <span class="testimonial-two__name"><?php echo $item['testimonial_name']; ?></span>
                  <span class="testimonial-two__job"><?php echo $item['testimonial_job']; ?></span>
               </div>
            </div>
            
         </div>
      </div>
   <?php } ?>  

   <?php if( $style == 'style-3'){ ?>
      <div class="testimonial-three__single">
         <div class="testimonial-three__wrap">
            <div class="testimonial-three__content">
               <div class="testimonial-three__meta">
               	<?php 
		               if($avatar){ 
		                  echo '<div class="testimonial-three__image">';
		                     echo '<img src="' . esc_url($avatar) . '" alt="' . $item['testimonial_name'] . '" />';
		                  echo '</div>';
		               }
		            ?>
		            <div class="testimonial-three__information">
                     <div class="testimonial-three__name"><?php echo $item['testimonial_name']; ?></div>
                     <div class="testimonial-three__job"><?php echo $item['testimonial_job']; ?></div>
                     <div class="testimonial-three__stars">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                     </div>
                  </div>
               </div>
               <span class="testimonial-three__icon"><i class="dicon-straight-quotes"></i></span>
            </div>
            <div class="testimonial-three__quote">
               <?php echo $item['testimonial_content']; ?>
            </div> 
         </div>
      </div>
   <?php } ?> 
   <?php if( $style == 'style-4'){ ?>
      <div class="testimonial-four__single">
         <div class="testimonial-four__wrap">
            <div class="testimonial-four__content">
               <div class="testimonial-four__icon"><i class="dicon-straight-quotes"></i></div>
               
                  <div class="testimonial-four__meta">
                     <?php 
                        if($avatar){ 
                           echo '<div class="testimonial-four__image">';
                              echo '<img src="' . esc_url($avatar) . '" alt="' . $item['testimonial_name'] . '" />';
                           echo '</div>';
                        }
                     ?>
                  </div>

                  <div class="testimonial-four__information">
                     <div class="testimonial-four__name"><?php echo $item['testimonial_name']; ?></div>
                     <div class="testimonial-four__job"><?php echo $item['testimonial_job']; ?></div>
                  </div>
               </div>
            <div class="testimonial-four__quote">
               <?php echo $item['testimonial_content']; ?>
            </div> 
         </div>
      </div>
   <?php } ?> 

</div>

