<?php
/**
 *
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2025 Gaviasthemes. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */
$copyright = donatm_get_option('copyright_text', '');
?>
	</div><!--end page content-->
	
</div><!-- End page -->

	<footer id="wp-footer" class="clearfix">
		<?php 
			$footer_id = apply_filters('donatm_get_footer_layout', null );
			if($footer_id && class_exists('GVA_Layout_Frontend')){
				echo '<div class="footer-main">' . GVA_Layout_Frontend::getInstance()->element_display($footer_id) . '</div>';
			}

		?>

		<?php if(donatm_get_option('copyright_default', 'yes') == 'yes'){ ?>
			<div class="copyright">
				<div class="container">
					<div class="copyright-content">
							<div class="row">
								<div class="col-sm-12 col-xs-12">
									<?php 
										if(!empty($copyright)){ 
											echo esc_html($copyright);
										}else{
											echo esc_html__('Copyright 2025 - Company - All rights reserved. Powered by WordPress.', 'donatm');
										}
									?>
								</div>
							</div>	
						</div>	
				</div>
			</div>
		<?php } ?>	

	</footer>
	
	<div id="gva-overlay"></div>
	
<?php wp_footer(); ?>

</body>
</html>