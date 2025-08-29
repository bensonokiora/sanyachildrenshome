<?php
if(!function_exists('donatm_give_breadcrumb')){
	function donatm_give_breadcrumb(){
		$result = donatm_style_breadcrumb();
		extract($result);
		if(isset($no_breadcrumbs) && $no_breadcrumbs == true){
			echo '<div class="disable-breadcrumb clearfix"></div>';
			return false;
		}
		?>
		
		<div class="custom-breadcrumb <?php echo implode(' ', $classes); ?>" <?php echo(count($styles) > 0 ? 'style="' . implode(';', $styles) . '"' : ''); ?>>
			<?php if($styles_overlay){ ?>
			  <div class="breadcrumb-overlay" style="<?php echo esc_attr($styles_overlay); ?>"></div>
			<?php } ?>
			<div class="breadcrumb-main">
				<div class="container">
					<div class="breadcrumb-container-inner">
						<?php if($title && ( $show_page_title ) ){ 
							echo '<h2 class="heading-title">' . esc_html( $title ) . '</h2>';
						} ?>
						<?php donatm_general_breadcrumbs(); ?>
					</div>  
				</div>   
			</div>  
		</div>

		<?php
	}
	add_action( 'donatm_give_before_main_content', 'donatm_give_breadcrumb', 20 );
}

function donatm_give_change_posts_per_page( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}
	$posts_per_page = donatm_get_option('give_posts_per_page', 6);
	if ( is_post_type_archive( 'give_forms' ) ) {
		$query->set( 'posts_per_page', $posts_per_page );
	}
}
add_filter( 'pre_get_posts', 'donatm_give_change_posts_per_page' );

function donatm_give_get_donation_form_submit_button( $form_id, $args = array() ) {
  global $post;
  if( isset( $post->ID) && $post->ID ){
	 $form_id = $post->ID;
  }
  $display_label_field = give_get_meta( $form_id, '_give_checkout_label', true, '', 'form' );
  $display_label_field = apply_filters( 'give_donation_form_submit_button_text', $display_label_field, $form_id, $args );
  $display_label       = ( ! empty( $display_label_field ) ? $display_label_field : esc_html__( 'Donate Now', 'donatm' ) );
  ob_start();
  ?>
  <div class="give-submit-button-wrap give-clearfix">
	 <button type="submit" class="give-submit give-btn" id="give-purchase-button" name="give-purchase" value="<?php echo esc_attr($display_label); ?>" data-before-validation-label="<?php echo esc_attr($display_label); ?>">
			<?php echo esc_html($display_label); ?>
	 </button>
	 <span class="give-loading-animation"></span>
  </div>
  <?php
  return ob_get_clean();
}
add_filter( '__give_donation_form_submit_button', 'donatm_give_get_donation_form_submit_button');

function donatm_give_display_checkout_button( $output ) {
  $output = '<div class="clearfix give-checkout-button">'.$output.'</div>';
  echo wp_kses( $output, true );
}

add_filter( '__give_display_checkout_button', 'donatm_give_display_checkout_button', 1);

add_action('give_embed_head', 'donatm_give_embed_head', 11);
function donatm_give_embed_head(){
	$custom_css = '.give-form-templates{padding: 0 0 20px; margin: 5px;}';
	$custom_css .= '.give-form-templates .give-embed-form{width: 100%; max-width: 100%;}';
	$custom_css .= '#give-donor-dashboard{max-width: 100%!important;}';
	$custom_css .= '.give-donor-dashboard-desktop-layout{box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08)!important; border-radius: 0!important;border:1px solid rgba(0, 0, 0, 0.08)!important;}';
	$custom_css .= '.give-form-type-multi .headline,.give-form-type-multi .seperator{display: none!important;}';
	$custom_css .= '.give-form-type-multi .description{padding-top: 15px;}';
	wp_enqueue_style(
	  'donatm-custom-style', 
		DONATM_THEME_URL . '/assets/css/custom_script.css'
	);
	wp_add_inline_style( 'donatm-custom-style', $custom_css );
}

//give_update_option('number_decimals', 0);
add_action( 'wp_print_footer_scripts', 'donatm_give_form_scripts'  );
function donatm_give_form_scripts() {
	if(class_exists('Give')){
		echo '<link rel="stylesheet" id="donatm-give-form-css" type="text/css" href="' . DONATM_THEME_URL . '/assets/css/givewp-block.css">';
		echo '<link rel="stylesheet" id="donatm-give-font-css" type="text/css" href="' . donatm_fonts_url() . '">';
	}
}

