<?php
if (!defined('ABSPATH')){ exit; }
global $donatm_post;
if(!$donatm_post){ return; }

$page_id = $donatm_post->ID;
$campaign_id = get_post_meta( $page_id,'give_campaign_id', true );

$attrs = array();
?>

<div class="item-campaign-goal">
<?php
   if($campaign_id){ 
      echo render_block(
         parse_blocks(
           '<!-- wp:givewp/campaign-goal {"campaignId":"' . esc_attr($campaign_id) . '"} /-->'
         )[0]
      );
   }
?>
</div>
