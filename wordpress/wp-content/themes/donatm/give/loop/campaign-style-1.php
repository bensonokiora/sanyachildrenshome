<?php
	use Give\Helpers\Form\Template;
   use Give\Campaigns\Models\Campaign;
	use Give\Campaigns\Repositories\CampaignRepository;
	use Give\Campaigns\Repositories\CampaignsDataRepository;
	use Give\Campaigns\ViewModels\CampaignViewModel;
	use Give\Campaigns\Actions\RenderDonateButton;
	use Give\Campaigns\CampaignDonationQuery;

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

	//CAMPAIGN_ID
	$donations = new CampaignDonationQuery($campaign);
	$donations_count = $donations->countDonations();
?> 

<div class="campaign-one">
	<div class="campaign-one__image">
		<?php 
			if(isset($data['image']) && $data['image']){ 
				$image = wp_get_attachment_image(attachment_url_to_postid($data['image']), $thumbnail, false, $image_attr);
				if(empty($image)) $image = '<img src="' . esc_url($data['image']) . '" alt="' . esc_attr($data['title']) . '"/>';
				if($image){
					echo '<a href="' . esc_url($data['pagePermalink']) . '" class="campaign-one__link">';
						echo wp_kses($image, true);
					echo '</a>';
				}
			}
		?>
		<a href="<?php echo get_permalink(); ?>" class="campaign-one__overlay"></a>

	</div>

	<div class="campaign-one__content">
		

		<h2 class="campaign-one__title">
			<a href="<?php echo esc_url($data['pagePermalink']) ?>"><?php echo esc_html($data['title']) ?></a>
		</h2> 

		<div class="campaign-one__information">
			<div class="campaign-one__raised">
            <span class="campaign-one__raised-label"><?php echo esc_html__('Raised: ', 'donatm') ?></span>
            <span class="campaign-one__raised-value"><?php echo esc_html($actualFormatted); ?></span>
	      </div>
	      <div class="campaign-one__percent_raised"><?php echo esc_html($progress)?>%</div>
	   </div>   
		<div class="campaign-progress campaign-one__progress">
         <div class="progress">
            <div class="progress-bar" data-progress-animation="<?php echo esc_attr($progress)?>%"></div>
         </div>
      </div> 

      <div class="campaign-one__goal">
         <span class="campaign-one__goal-label"><?php echo esc_html__('Goal:', 'donatm'); ?></span>
         <span class="campaign-one__goal-value"><?php echo esc_html($goalFormatted); ?></span>
      </div>

      <div class="campaign-one__bottom">
      	<div class="campaign-one__donations">
      		<i class="fa fa-heart"></i>
      		<?php echo esc_html($donations_count) ?>
      		<span><?php echo esc_html__('Donations', 'donatm') ?></span>
			</div>
			<div class="campaign-one__button">
				<?php echo give(RenderDonateButton::class)($campaign->defaultFormId, __('Donate Now', 'donatm')) ?>
			</div>
		</div>
	</div>
</div>

