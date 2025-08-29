<?php
if (!defined('ABSPATH')){ exit; }

use Give\Campaigns\Actions\RenderDonateButton;
use Give\Campaigns\Models\Campaign;
use Give\Campaigns\Repositories\CampaignRepository;
use Give\Framework\Database\DB;

global $donatm_post;
if(!$donatm_post){ return; }

$page_id = $donatm_post->ID;
$campaign_id = get_post_meta( $page_id,'give_campaign_id', true );

if($settings['campaign_id']){
   $campaign_id = $settings['campaign_id'];
}

$classes[] = $settings['style'];
$classes[] = 'item-donate-button';
$this->add_render_attribute('wrapper', 'class', $classes);
?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <?php 
      if($campaign_id){
         $campaign = give(CampaignRepository::class)->getById($campaign_id);
         $defaultFormId = isset($campaign->defaultFormId) ? $campaign->defaultFormId : false;
         if($defaultFormId){
            echo give(RenderDonateButton::class)($campaign->defaultFormId,  $settings['label_btn']);  
         }else{
            echo '<a class="btn-theme">The Campaign does not exist</a>';
         }
      }
   ?>
</div> 
