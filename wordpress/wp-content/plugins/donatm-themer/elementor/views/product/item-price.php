<?php
	if (!defined('ABSPATH')){ exit; }

	global $donatm_post, $post;
	if( !$donatm_post ){ return; }
	if( $donatm_post->post_type != 'product' ){ return; }
   $post_id = $donatm_post->ID;
	if(\Elementor\Plugin::$instance->editor->is_edit_mode() || $post->post_type == 'gva__template'){
      global $product;
      $product = wc_get_product($post_id);
   }
?>

<div class="product-item-price">
	<?php woocommerce_template_single_price() ?>
</div>