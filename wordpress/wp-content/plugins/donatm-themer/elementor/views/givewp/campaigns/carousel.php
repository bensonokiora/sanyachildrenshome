<?php
	if (!$campaigns || !count($campaigns)) {
    	echo '<div class="alert alert-primary"> ' . esc_html($settings['notfound']) . '</div>';
		return;
	}

	$classes = array();
	$classes[] = 'wpgive-forms-carousel gva-give swiper-slider-wrapper';
	$classes[] = $settings['space_between'] < 15 ? 'margin-disable': '';
	$this->add_render_attribute('wrapper', 'class', $classes);

	$_random = gaviasthemer_random_id();
	$this->add_render_attribute('wrapper', 'data-filter', $_random);
  ?>

	<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
		<div class="swiper-content-inner">
			<div class="init-carousel-swiper swiper" data-carousel="<?php echo $this->get_carousel_settings() ?>">
				<div class="swiper-wrapper">
					<?php
						$count = 0;
						foreach ($campaigns as $key => $campaign) {
							echo '<div class="swiper-slide">';
								$this->donatm_get_template_part('give/loop/campaign', $settings['style'], array(
		                     'thumbnail_size' => $settings['image_size'],
		                     'excerpt_words'  => $settings['excerpt_words'],
		                     'campaign'		  => $campaign
		                  ));
							echo '</div>';
						}
					?>
				</div>
			</div>	
		</div>	
		<?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
		<?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?> 
	</div>
  <?php
  wp_reset_postdata();