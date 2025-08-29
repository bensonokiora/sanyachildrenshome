<?php
   $campaigns_id = $settings['post_id'];
	if ( !$campaigns_id ) {
    	echo '<div class="alert alert-primary"> ' . esc_html($settings['notfound']) . '</div>';
		return;
	}
	$this->add_render_attribute('wrapper', 'class', ['wpgive-form clearfix']);
	//add_render_attribute grid
?>
  
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
	<div class="form-content"> 
		<?php
			$this->donatm_get_template_part('give/loop/campaign', $settings['style'], array(
				'campaign_id' 			=> $campaigns_id,
				'title_show' 			=> $settings['title_show'],
				'title_override' 		=> $settings['title'],
				'button_style'			=> $settings['button_style']
			));
		?>
	</div>
</div>

<?php
wp_reset_postdata();