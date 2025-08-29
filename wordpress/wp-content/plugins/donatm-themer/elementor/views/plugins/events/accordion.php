<?php
  	$query = $this->query_posts();
  	$_random = gaviasthemer_random_id();
  	if ( ! $query->found_posts ) {
	 	return;
  	}
	$this->add_render_attribute('wrapper', 'class', ['events-accordion clearfix']);
?>
  
  	<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div class="events-accordion-wrap">
			<?php
				global $post;
				$count = 0;
				while ( $query->have_posts() ) { 
					$count++;
            	$active_class = $count == 2 ? ' active default-active' : '';
				  	$query->the_post();
				  	echo '<div class="event-accordion-item' . esc_attr($active_class) . '">';
					 	set_query_var( 'image_size', $settings['image_size'] );
					 	get_template_part('tribe-events/list/single', 'accordion' );
				  	echo '</div>';
				}
			?>
		</div>
  	</div>

<?php
  wp_reset_postdata();