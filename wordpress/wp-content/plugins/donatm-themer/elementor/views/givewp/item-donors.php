<?php
if (!defined('ABSPATH')){ exit; }
global $donatm_post;
if(!$donatm_post){ return; }

$page_id = $donatm_post->ID;
$campaign_id = get_post_meta( $page_id,'give_campaign_id', true );

$attrs = array();
$attrs[] = '"campaignId":"' . esc_attr($campaign_id) . '"';
$settings['show_anonymous'] != 'yes' ? $attrs[] = '"showAnonymous":false' : false;
$settings['show_company'] != 'yes' ? $attrs[] = '"showCompanyName":false' : false;
$settings['show_avatar'] != 'yes' ? $attrs[] = '"showAvatar":false' : false;
$settings['show_button'] != 'yes' ? $attrs[] = '"showButton":false' : false;
$settings['sort_by'] ? $attrs[] = '"sortBy":"' . $settings['sort_by'] . '"' : false;;
$settings['per_page'] ? $attrs[] = '"donationsPerPage":' . $settings['per_page'] : false;

$attrs_str = implode(',', $attrs);
?>

<div class="item-campaign-donors">
<?php
   if($campaign_id){ 
      echo render_block(
         parse_blocks(
           '<!-- wp:givewp/campaign-donors {' . $attrs_str . '} /-->'
         )[0]
      );
   }
?>
</div>
