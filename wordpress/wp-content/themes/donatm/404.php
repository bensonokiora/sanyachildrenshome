<?php
/**
 *
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2025 Gaviasthemes. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */

	$primary_text = donatm_get_option('nfpage_primary_text', '');
	$title = donatm_get_option('nfpage_title', '');
	$desc = donatm_get_option('nfpage_desc', '');

	$btn_title = donatm_get_option('nfpage_btn_title', '');
	$btn_link = donatm_get_option('nfpage_btn_link', '');
	$btn_link = !empty($bth_title) ? $bth_title : home_url( '/' );

	$image = DONATM_THEME_URL . '/assets/images/404-image.png';
	$nfpage_image = donatm_get_option('nfpage_image', false);

	if(isset($nfpage_image['url']) && !empty($nfpage_image['url'])){
		$image = $nfpage_image['url'];
	}
?>
<?php get_header(); ?>

<div id="content">
	<div class="page-wrapper">
		<div class="not-found-wrapper text-center">
			<div class="not-found-image">
				<img src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr__('404 not found', 'donatm') ?>" />
			</div>

			<div class="not-found-title">
				<h1><?php echo ( !empty($title) ? esc_html($title) : esc_html__('OPPS! This Page is Not Found', 'donatm') ); ?></h1>
			</div>

			<div class="not-found-desc">
				<?php echo ( !empty($desc) ? esc_html($desc) : esc_html__('The page requested could not be found. This could be a spelling error in the URL or a removed page.', 'donatm') ); ?>
			</div> 

			<div class="not-found-home text-center">
				<a class="btn-theme" href="<?php echo esc_url($btn_link); ?>">
					<?php echo ( !empty($btn_title) ? esc_html($btn_title) : esc_html__('Back Homepage', 'donatm') ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>