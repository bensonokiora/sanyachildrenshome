<?php
  use Elementor\Group_Control_Image_Size;
  use Elementor\Icons_Manager;

  $settings = $this->get_settings_for_display();
  $skin = $settings['style'];
  $title_text = $settings['title_text'];
  $description_text = $settings['description_text'];
  $this->add_render_attribute( 'block', 'class', [ 'gsc-image-content', $settings['style'] ] );
  $header_tag = 'h2';
	
  $this->add_render_attribute( 'title_text', 'class', 'title' );
  $this->add_render_attribute( 'description_text', 'class', 'desc' );

  $this->add_inline_editing_attributes( 'title_text', 'none' );
  $this->add_inline_editing_attributes( 'description_text' );

?>
		
	<?php if($skin == 'skin-v1'){ ?>
		<div class="about-one__single">
				 	<?php 
				 		if( !empty($settings['image']['url']) ){
							echo '<div class="about-one__image"><div class="image-inner">';
								$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
								echo $image_html;
							echo '</div></div>';
				 		}
				 	?>	
			<?php 	$this->gva_render_link_overlay($settings['link'], 'about-one__link-overlay');  ?>
		</div>
	<?php } ?>  
	<?php if($skin == 'skin-v2'){ ?>
		<div class="about-two__single">
				 	<?php 
				 		if( !empty($settings['image']['url']) ){
							echo '<div class="about-two__image"><div class="image-inner">';
								$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
								echo $image_html;
							echo '</div></div>';
				 		}
				 	?>	
			<?php 	$this->gva_render_link_overlay($settings['link'], 'about-two__link-overlay');  ?>
		</div>
	<?php } ?> 

	<?php if($skin == 'skin-v3'){ ?>
		<div class="about-three__single">
		  	<?php 
		  		if( !empty($settings['image']['url']) ){
				 	echo '<div class="about-three__image">';
				 		echo '<div class="content-inner">';
						  $image_url = $settings['image']['url']; 
						  $image_html = '<img src="' . esc_url($image_url) .'" alt="'. esc_attr($settings['title_text']) . '" />';
						  $this->gva_render_link_html($image_html, $settings['link']);
				 		echo '</div>';
				 		
				 	echo '</div>';
		  		} 
		  		if(!empty($settings['image_logo']['url'])){
				 			echo '<div class="about-three__logo">';
				 				echo '<img src="'.esc_url($settings['image_logo']['url']).'" alt="'. esc_attr($settings['title_text']) . '" />';
				 			echo '</div>';
				 		}
		  		if( !empty($settings['image_second']['url']) ){
				 	echo '<div class="about-three__image-second">';
						echo '<div class="content-inner">';
						 	$image_url_second = $settings['image_second']['url']; 
						 	$image_html = '<img src="' . esc_url($image_url_second) .'" alt="'. esc_attr($settings['title_text']) . '" />';
					  		$this->gva_render_link_html($image_html, $settings['link']);
						echo '</div>';
				 	echo '</div>';
			 	}
			?>
			<?php 	$this->gva_render_link_overlay($settings['link'], 'about-three__link-overlay');  ?>
		</div>
	<?php } ?> 

	
<?php if($skin == 'skin-v4'){ ?>
  <div class="about-four__single">
  	<div class="about-four__wrap">
	  	<?php if($title_text){ ?>
				<<?php echo esc_attr($header_tag) ?> class="about-four__title">
					<?php $this->gva_render_link_html($title_text, $settings['link']); ?>
				</<?php echo esc_attr($header_tag) ?>>
			<?php } ?>
		 <?php if (!empty($settings['image']['url'])) : ?>
			<div class="about-four__image">
				 <?php
					$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
					$this->gva_render_link_html($image_html, $settings['link']);
				 ?>
			</div>
		 <?php endif; ?>
		 	<div class="about-four__content">
					<?php 
						if( !empty($settings['image_second']['url']) ){
					 	echo '<div class="about-four__image-second">';
							echo '<div class="content-inner">';
							 	$image_url_second = $settings['image_second']['url']; 
							 	$image_html = '<img src="' . esc_url($image_url_second) .'" alt="'. esc_attr($settings['title_text']) . '" />';
						  		$this->gva_render_link_html($image_html, $settings['link']);
							echo '</div>';
					 	echo '</div>';
					} ?>
			 		<?php	if($settings['video'] == 'yes' && $settings['video_url']){ ?>
	            <div class="about-four__video">
	               <a class="video-link popup-video" href="<?php echo esc_url($settings['video_url']) ?>">
	                  <i class="fa fa-play"></i>
	               </a>
	            </div>
	         <?php } ?>
		 	</div> 
	 	</div> 
	 	<?php 	$this->gva_render_link_overlay($settings['link'], 'about-four__link-overlay');  ?>

  </div>
<?php } ?> 
<?php if($skin == 'skin-v5'){ ?>
  <div class="about-five__single">
  	<div class="about-five__wrap">
			<?php 
				if( !empty($settings['image']['url']) ){
				 	echo '<div class="about-five__image">';
						echo '<div class="content-inner">';
						 	$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
						  $this->gva_render_link_html($image_html, $settings['link']);
						echo '</div>';
				 	echo '</div>';
			 	}
				if( !empty($settings['image_second']['url']) ){
			 	echo '<div class="about-five__image-second">';
					echo '<div class="content-inner">';
					 	$image_url_second = $settings['image_second']['url']; 
					 	$image_html = '<img src="' . esc_url($image_url_second) .'" alt="'. esc_attr($settings['title_text']) . '" />';
				  		$this->gva_render_link_html($image_html, $settings['link']);
					echo '</div>';
			 	echo '</div>';
			} ?>
	 	</div> 
	 	<?php 	$this->gva_render_link_overlay($settings['link'], 'about-five__link-overlay');  ?>

  </div>
<?php } ?> 
<?php if($skin == 'skin-v6'){ ?>
  <div class="about-six__single">
  	<div class="about-six__wrap">
			<?php 
				if( !empty($settings['image']['url']) ){
				 	echo '<div class="about-six__image">';
						echo '<div class="content-inner">';
						 	$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
						  $this->gva_render_link_html($image_html, $settings['link']);
						echo '</div>';
				 	echo '</div>';
			 	}
				if( !empty($settings['image_second']['url']) ){
			 	echo '<div class="about-six__image-second">';
					echo '<div class="content-inner">';
					 	$image_url_second = $settings['image_second']['url']; 
					 	$image_html = '<img src="' . esc_url($image_url_second) .'" alt="'. esc_attr($settings['title_text']) . '" />';
				  		$this->gva_render_link_html($image_html, $settings['link']);
					echo '</div>';
			 	echo '</div>';
			} ?>
	 	</div> 
	 	<?php 	$this->gva_render_link_overlay($settings['link'], 'about-six__link-overlay');  ?>

  </div>
<?php } ?> 
<?php if($skin == 'skin-v7'){ ?>
		<div class="about-seven__single">
				 	<?php 
				 		if( !empty($settings['image']['url']) ){
							echo '<div class="about-seven__image"><div class="image-inner">';
								$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
								echo $image_html;
							echo '</div></div>';
				 		}
				 	?>	
			<?php 	$this->gva_render_link_overlay($settings['link'], 'about-seven__link-overlay');  ?>
		</div>
	<?php } ?> 
<?php if($skin == 'skin-v8'){ ?>
  <div class="about-eight__single">
  	<div class="about-eight__wrap">
			<?php 
				if( !empty($settings['image']['url']) ){
				 	echo '<div class="about-eight__image">';
						echo '<div class="content-inner">';
						 	$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
						  $this->gva_render_link_html($image_html, $settings['link']);
						echo '</div>';
				 	echo '</div>';
			 	}
				if( !empty($settings['image_second']['url']) ){
			 	echo '<div class="about-eight__image-second">';
					echo '<div class="content-inner">';
					 	$image_url_second = $settings['image_second']['url']; 
					 	$image_html = '<img src="' . esc_url($image_url_second) .'" alt="'. esc_attr($settings['title_text']) . '" />';
				  		$this->gva_render_link_html($image_html, $settings['link']);
					echo '</div>';
			 	echo '</div>';
			} ?>
	 	</div> 
	 	<?php 	$this->gva_render_link_overlay($settings['link'], 'about-eight__link-overlay');  ?>

  </div>
<?php } ?> 
<?php if($skin == 'skin-v9'){ ?>
		<div class="about-nine__single">
				 	<?php 
				 		if( !empty($settings['image']['url']) ){
							echo '<div class="about-nine__image"><div class="image-inner">';
								$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'image');
								echo $image_html;
							echo '</div></div>';
				 		}
				 	?>	
			<?php 	$this->gva_render_link_overlay($settings['link'], 'about-nine__link-overlay');  ?>
		</div>
	<?php } ?> 