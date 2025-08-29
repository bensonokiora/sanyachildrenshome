<?php
	use Give\Helpers\Form\Template;
	use Give\Campaigns\Models\Campaign;
	use Give\Campaigns\Repositories\CampaignRepository;
	use Give\Campaigns\Repositories\CampaignsDataRepository;
	use Give\Campaigns\ViewModels\CampaignViewModel;
	use Give\Campaigns\Actions\RenderDonateButton;

	$campaignId = $campaign->id;
	if( !$campaignId || !$campaign ) {
		return;
	}
	$ViewModels = new CampaignViewModel($campaign);
	$data = $ViewModels->exports();

	$goalStats = $data['goalStats'];
	$progress = $goalStats['percentage'];
	$progress_class = $progress < 10 ? 'percent-small' : 'percent-default';
	$actualFormatted = $goalStats['actualFormatted'];
	$goalFormatted = $goalStats['goalFormatted'];

	$thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'donatm_medium';
	$excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '30';
	$image_attr = '';
?> 

<div class="campaign-two">
	<div class="campaign-two__wrap">
		<div class="campaign-two__image">
			<?php 
				if(isset($data['image']) && $data['image']){ 
					$image = wp_get_attachment_image(attachment_url_to_postid($data['image']), $thumbnail, false, $image_attr);
					if(empty($image)) $image = '<img src="' . esc_url($data['image']) . '" alt="' . esc_attr($data['title']) . '"/>';
					if($image){
						echo '<a href="' . esc_url($data['pagePermalink']) . '" class="campaign-two__link">';
							echo wp_kses($image, true);
						echo '</a>';
					}
				}
			?>
			<a href="<?php echo esc_url($data['pagePermalink']) ?>" class="campaign-two__overlay"></a>
		</div>

		<div class="campaign-two__content">
			
			<div class="campaign-progress campaign-two__progress">
	         <div class="progress">
	            <div class="progress-bar" data-progress-animation="<?php echo esc_attr($progress)?>%">
	            	<?php 
	            		if($progress > 75){ 
	               		echo '<span class="percentage percentage-left">' .  esc_attr($progress) . '%</span>';
	               	}else{
	               		echo '<span class="percentage">' .  esc_attr($progress) . '%</span>';
	               	}
	               ?>
	            </div>
	         </div>
	      </div>   

			<div class="campaign-two__information">
				<div class="campaign-two__raised">
	            <span class="campaign-two__raised-label"><?php echo esc_html__('Raised: ', 'donatm') ?></span>
	            <span class="campaign-two__raised-value"><?php echo esc_html($actualFormatted); ?></span>
		      </div>
		      <div class="campaign-two__goal">
		         <span class="campaign-two__goal-label"><?php echo esc_html__('Goal:', 'donatm'); ?></span>
		         <span class="campaign-two__goal-value"><?php echo esc_html($goalFormatted); ?></span>
		      </div>
		   </div>   

			<h2 class="campaign-two__title">
				<a href="<?php echo esc_url($data['pagePermalink']) ?>">
					<?php echo esc_html($data['title']) ?>
				</a>
			</h2>

			<div class="campaign-two__btn-donate card-btn-donate">
				<?php echo give(RenderDonateButton::class)($campaign->defaultFormId, __('Donate Now', 'donatm')) ?>
			</div>
		</div>  
	</div>
</div>