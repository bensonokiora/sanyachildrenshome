<?php
	if (!$campaigns || !count($campaigns)) {
    	echo '<div class="alert alert-primary"> ' . esc_html($settings['notfound']) . '</div>';
		return;
	}

	$this->add_render_attribute('wrapper', 'class', ['wpgive-forms-grid clearfix']);
	//add_render_attribute grid
	$this->get_grid_settings();
?>
  
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
	<div class="gva-content-items"> 
	  	<div <?php echo $this->get_render_attribute_string('grid') ?>>
			<?php
				foreach ($campaigns as $key => $campaign) {
				  	echo '<div class="item">';
						$this->donatm_get_template_part('give/loop/campaign', $settings['style'], array(
					  		'thumbnail_size' => $settings['image_size'],
							'excerpt_words'  => $settings['excerpt_words'],
		               'campaign'		 => $campaign
						));
					echo '</div>';	
				}
			?>
	  	</div>
	</div>
	<?php if($settings['pagination'] == 'yes'): ?>
		<div class="pagination">
			<?php echo $this->pagination_custom($total_pages, $limit); ?>
		</div>
	<?php endif; ?>
</div>

<?php
wp_reset_postdata();