<?php
	use Give\Helpers\Form\Template;
   use Give\Campaigns\Models\Campaign;
	use Give\Campaigns\Repositories\CampaignRepository;
	use Give\Campaigns\Repositories\CampaignsDataRepository;
	use Give\Campaigns\ViewModels\CampaignViewModel;
	use Give\Campaigns\Actions\RenderDonateButton;

	$campaignId = isset($campaign_id) ? $campaign_id : false;
	if( !$campaignId ) {
    	return;
	}

	$campaign = Campaign::find($campaignId);

 	$ViewModels = new CampaignViewModel($campaign);
 	$data = $ViewModels->exports();

 	$goalStats = $data['goalStats'];
 	$progress = $goalStats['percentage'];
	$progress_class = $progress < 10 ? 'percent-small' : 'percent-default';
	$actualFormatted = $goalStats['actualFormatted'];
	$goalFormatted = $goalStats['goalFormatted'];

	$title_show = (isset($title_show) && $title_show) ? $title_show : 'no';
	$title_override = (isset($title_override) && $title_override) ? $title_override : '';
	$button_style = (isset($button_style) && $button_style) ? $button_style : '';
	$title = $title_override ? $title_override : $data['title'];
?> 

<div class="campaign-totals-one">
	<div class="campaign-totals-one__wrap">
		<div class="campaign-totals-one__content">
			
			<?php if($title_show == 'yes'){ ?>
				<h2 class="campaign-totals-one__title">
					<a href="<?php echo esc_url($data['pagePermalink']) ?>">
						<?php echo esc_html($data['title']) ?>
					</a>
				</h2>
			<?php } ?>

			<div class="campaign-progress campaign-totals-one__progress">
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

			<div class="campaign-totals-one__information">
				<div class="campaign-totals-one__raised">
	            <span class="campaign-totals-one__raised-label"><?php echo esc_html__('Raised: ', 'donatm') ?></span>
	            <span class="campaign-totals-one__raised-value"><?php echo esc_html($actualFormatted); ?></span>
		      </div>
		      <div class="campaign-totals-one__goal">
		         <span class="campaign-totals-one__goal-label"><?php echo esc_html__('Goal:', 'donatm'); ?></span>
		         <span class="campaign-totals-one__goal-value"><?php echo esc_html($goalFormatted); ?></span>
		      </div>
		   </div>   

			<div class="campaign-totals-one__action <?php echo esc_attr($button_style) ?>"> 
				<?php echo give(RenderDonateButton::class)($campaign->defaultFormId, __('Donate Now', 'donatm')) ?>
			</div>
		</div>  
	</div>
</div>