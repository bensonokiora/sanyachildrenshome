<?php
if (!defined('ABSPATH')){ exit; }
global $donatm_post;
if(!$donatm_post){ return; }

$page_id = $donatm_post->ID;
$campaign_id = get_post_meta( $page_id,'give_campaign_id', true );

$classes[] = $settings['style'];
$classes[] = 'item-statistics';
$this->add_render_attribute('wrapper', 'class', $classes);

$attrs = array();
$attrs[] = '"campaignId":"' . esc_attr($campaign_id) . '"';
$settings['type'] ? $attrs[] = '"statistic":"' . $settings['type'] . '"' : false;;

$attrs_str = implode(',', $attrs);

$title = $settings['title_text'];
?>
<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <?php 
      if($title){
         echo '<div class="title-text">' . esc_html($title) . '</div>';
      }
      if($campaign_id){
         echo render_block(
            parse_blocks(
               '<!-- wp:givewp/campaign-stats-block {' . $attrs_str . '} /-->'
            )[0]
         );
      }
   ?>
</div>
