<?php
   $query = $this->query_posts();
   if ( ! $query->found_posts ) {
      return;
   }
   $this->add_render_attribute('wrapper', 'class', ['wpgive-one-item clearfix']);
 
?>

<?php if($settings['post_ids']){ ?>
   
   <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
      <div class="gva-content-items"> 
         <?php
            global $post;
            while ( $query->have_posts() ) { 
               $query->the_post();
               $post->post_count = $query->post_count;
               echo '<div class="item">';
                  $this->donatm_get_template_part('give/loop/item', $settings['style'], array());
               echo '</div>'; 
            }
         ?>
      </div>
   </div>

<?php }else{ 
   echo '<div class="alert alert-info">' . esc_html__('Please select the Individually Content') . '</div>'; 
} ?>

<?php
wp_reset_postdata();