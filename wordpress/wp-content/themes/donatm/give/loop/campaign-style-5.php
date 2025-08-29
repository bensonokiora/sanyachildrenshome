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

<div class="campaign-five">
	
	<div class="campaign-five__wrap">
		<div class="campaign-five__image">
			<?php 
				if(isset($data['image']) && $data['image']){ 
					$image = wp_get_attachment_image(attachment_url_to_postid($data['image']), $thumbnail, false, $image_attr);
					if(empty($image)) $image = '<img src="' . esc_url($data['image']) . '" alt="' . esc_attr($data['title']) . '"/>';
					if($image){
						echo '<a href="' . esc_url($data['pagePermalink']) . '" class="campaign-five__link">';
							echo wp_kses($image, true);
						echo '</a>';
					}
				}
			?>
			<a href="<?php echo esc_url($data['pagePermalink']) ?>" class="campaign-five__overlay"></a>
			<div class="campaign-five__btn-donate card-btn-donate">
				<?php echo give(RenderDonateButton::class)($campaign->defaultFormId, __('Donate Now', 'donatm')) ?>
			</div>
		</div>

		<div class="campaign-five__content">
			<h2 class="campaign-five__title">
				<a href="<?php echo esc_url($data['pagePermalink']) ?>">
					<?php echo esc_html($data['title']) ?>
				</a>
			</h2>
		</div>  
	</div>

	<div class="campaign-five__bottom">
		<div class="campaign-progress campaign-five__progress">
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

		<div class="campaign-five__information">
			<div class="campaign-five__raised">
            <span class="campaign-five__raised-label"><?php echo esc_html__('Raised: ', 'donatm') ?></span>
            <span class="campaign-five__raised-value"><?php echo esc_html($actualFormatted); ?></span>
	      </div>
	      <div class="campaign-five__goal">
	         <span class="campaign-five__goal-label"><?php echo esc_html__('Goal:', 'donatm'); ?></span>
	         <span class="campaign-five__goal-value"><?php echo esc_html($goalFormatted); ?></span>
	      </div>
	   </div>   
	</div>

</div>