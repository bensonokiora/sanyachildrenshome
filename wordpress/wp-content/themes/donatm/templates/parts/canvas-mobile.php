<?php
	$donatm_options = donatm_get_options();
?>
<div class="canvas-mobile">
	
	<div class="gva-offcanvas-content mobile">
		<div class="top-canvas">
			<?php $logo_mobile = (isset($donatm_options['header_logo']['url']) && $donatm_options['header_logo']['url']) ? $donatm_options['header_logo']['url'] : get_template_directory_uri().'/assets/images/logo-mobile.png' ; ?>
		  	<a class="logo-mm" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			 	<img src="<?php echo esc_url($logo_mobile); ?>" alt="<?php bloginfo( 'name' ); ?>" />
		  	</a>
			<a class="control-close-mm" href="#"><i class="far fa-times-circle"></i></a>
		</div>
		<div class="wp-sidebar sidebar">
			<?php do_action('donatm_mobile_menu'); ?>
			<div class="after-offcanvas">
				<?php
					if(is_active_sidebar('offcanvas_sidebar_mobile')){ 
						dynamic_sidebar('offcanvas_sidebar_mobile');
					}
				?>
			</div>    
	  </div>
	</div>
</div>