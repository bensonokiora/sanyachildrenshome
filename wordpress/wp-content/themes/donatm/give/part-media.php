<?php 
  $images = get_post_meta( get_the_ID(), 'donatm_give_gallery_images' , false );
  $video = get_post_meta( get_the_ID(), 'donatm_give_video_url' , true ); 
  $_random = wp_rand();
?>

<?php if( ($images && is_array($images) && count($images) > 0) || $video ){ ?>
	
	<div class="campaign-media givewp-media">
		<div class="givewp-gallery"> 
		  	<div class="lightGallery">
			 	<?php if($images && is_array($images) && count($images) > 0){
					$i = 0;
					foreach($images as $image): 
						$i++; $image_full_src = false; $image_thumb_src = false;
						if($image_full_src = wp_get_attachment_image_src($image, 'full')) $image_full_src = $image_full_src['0'];
						if($image_thumb_src = wp_get_attachment_image_src($image, 'thumbnail')) $image_thumb_src = $image_thumb_src['0']; 
						if($i==1){ ?>
							<div class="image-item">
								<a href="<?php echo esc_url($image_full_src) ?>" class="zoomGallery" data-elementor-lightbox-slideshow="gallery-<?php echo esc_attr($_random); ?>">
									<span class="icon-expand">
									  	<i class="wicon-camera-1"></i>
									  	<span class="count"><?php echo count($images) ?></span>
									</span>
									<img src="<?php echo esc_url($image_thumb_src) ?>"  class="hidden" alt="<?php the_title_attribute() ?>" />
								</a>
							</div>
						<?php }else{ ?>
							<div class="image-item">
								<a href="<?php echo esc_url($image_full_src) ?>" class="zoomGallery hidden" data-elementor-lightbox-slideshow="gallery-<?php echo esc_attr($_random); ?>">
									<img src="<?php echo esc_url($image_thumb_src) ?>" alt="<?php the_title_attribute() ?>" class="hidden" />
								</a>
							</div>
						<?php }
					endforeach;
			 	}?>
		  	</div>
		</div>

		<?php if($video){ ?>
		  	<div class="givewp-video">
		    	<a class="video-link popup-video" href="<?php echo esc_url($video) ?>"><i class="wicon-video-camera-2"></i></a>
		  	</div>
		<?php } ?>

	</div>

<?php } ?>