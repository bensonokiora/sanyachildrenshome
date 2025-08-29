<?php
add_theme_support( 'wp-block-styles' );
add_theme_support( "responsive-embeds" );
add_theme_support( "align-wide" );
function donatm_breadcrumb(){
	$post_id = donatm_id();
	$title = '';
	$title = is_page() ? get_the_title() : $title;
	$title = is_search() ? esc_html__('Search', 'donatm') : $title;
	$title = is_archive() ? get_the_archive_title() : $title;
	$title = is_home() ? esc_html__('Latest posts', 'donatm') : $title;

	$padding_top = donatm_get_option('breadcrumb_padding_top', '');
	$padding_bottom = donatm_get_option('breadcrumb_padding_bottom', '');
	$show_title = donatm_get_option('breadcrumb_show_title', '1');
	$bg_color = donatm_get_option('breadcrumb_bg_color', '');
	$bg_color_opacity = donatm_get_option('breadcrumb_bg_opacity', '1');
	$breadcrumb_image = donatm_get_option('breadcrumb_bg_image', array('id'=> 0));
	$text_style = donatm_get_option('breadcrumb_text_stype', 'text-light');
	if(get_post_meta($post_id, 'donatm_breadcrumb_layout', true) == 'page_options'){
      //Breacrumb Image Color
      $bg_color = get_post_meta($post_id, 'donatm_breacrumb_bg_color', true);
      $bg_color_opacity = get_post_meta($post_id, 'donatm_breacrumb_bg_opacity', true);
      // Breadcrumb Image
      $post_breadcrumb_img = get_post_meta($post_id, 'donatm_breacrumb_image', true);
      if(is_numeric($post_breadcrumb_img)){
         $post_breadcrumb_img_url = wp_get_attachment_image_src( $post_breadcrumb_img, 'full');
      }
      if(isset($post_breadcrumb_img_url[0]) && $post_breadcrumb_img_url[0]){
         $breadcrumb_image['url'] = $post_breadcrumb_img_url[0];
      }
   }

   if(get_post_type() == 'at_biz_dir'){
   	$show_title = true;
   	$title = get_the_title();
   }

	$styles = $styles_inner = $classes = array();
	$styles_overlay = '';

	$classes[] = $text_style;

	if($bg_color){
		$rgba_color = donatm_convert_hextorgb($bg_color);
		$styles_overlay = 'background-color: rgba(' . esc_attr($rgba_color['r']) . ',' . esc_attr($rgba_color['g']) . ',' . esc_attr($rgba_color['b']) . ', ' . ($bg_color_opacity/100) . ')';
	}

	if(isset($breadcrumb_image['url'])){
		$styles[] = 'background-image: url(\'' . $breadcrumb_image['url'] . '\')';
	}

	if($padding_top){
		$styles_inner[] = "padding-top:{$padding_top}px";
	}
	if($padding_bottom){
		$styles_inner[] = "padding-bottom:{$padding_bottom}px";
	}

	$css = count($styles) ? 'style="' . implode(';', $styles) . '"' : '';
	$css_inner = count($styles_inner) > 0 ? 'style="' . implode(';', $styles_inner) . '"' : '';
?>

	<div class="custom-breadcrumb breadcrumb-default <?php echo implode(' ', $classes); ?>" <?php echo trim($css) ?>>
		<?php if($styles_overlay){ ?>
			<div class="breadcrumb-overlay" style="<?php echo esc_attr($styles_overlay); ?>"></div>
		<?php } ?>
		<div class="breadcrumb-main">
		  	<div class="container">
			 	<div class="breadcrumb-container-inner" <?php echo trim($css_inner) ?>>
			 		<?php 
			 			if($title && $show_title){ 
							echo '<h2 class="heading-title">' . html_entity_decode($title) . '</h2>';
						} 
					 	donatm_general_breadcrumbs();
					?>
			 	</div>  
		  	</div>   
		</div>  
	</div>

<?php }

add_action( 'donatm_page_breacrumb', 'donatm_breadcrumb', '10' );

/**
 * Hook to select footer of page
 */
function donatm_get_footer_layout(){
	
	if(!class_exists('GVA_Layout_Frontend')){
		return false;
	}

	$post_id = false;
	if(class_exists('WooCommerce') && is_shop()){
		$post_id = wc_get_page_id('shop');
	}else{
		$post = get_post();
		if( $post && isset($post->ID) && $post->ID ){
			$post_id = $post->ID;
		}
	}

	$frontend = new GVA_Layout_Frontend();
	if(get_post_type($post_id) == 'page'){
		$footer_id = get_post_meta($post_id, 'donatm_footer_layout', true);
		if(empty($footer_id) || $footer_id == '_default_active'){
			$footer_id = $frontend->get_template_default('footer_layout');
		}
		return $footer_id;
	}

	$frontend = new GVA_Layout_Frontend();
	$template_id = $frontend->template_default_active_id();

	$post_meta_template = get_post_meta($post_id, 'donatm_template_layout', true);
	if( !empty($post_meta_template) && $post_meta_template != '_default_active' && $post_meta_template != '_without_layout' && is_numeric($post_meta_template) ){
		$template_id = $post_meta_template;
	}

	$footer_id = 0;
	if($template_id){
		$footer_id = get_post_meta($template_id, 'footer_layout', true);
	}

	if(!$footer_id){
		$footer_id = $frontend->template_default_active_id('footer_layout');
	}

	return $footer_id;
} 
add_filter( 'donatm_get_footer_layout', 'donatm_get_footer_layout' );
 
/**
 * Hook to select header of page
 */
function donatm_get_header_layout(){
	if(!class_exists('GVA_Layout_Frontend')){
		return false;
	}
	$post_id = false;

	if(class_exists('WooCommerce') && is_shop()){
		$post_id = wc_get_page_id('shop');
	}else{
		$post = get_post();
		if( $post && isset($post->ID) && $post->ID ){
			$post_id = $post->ID;
		}
	}

	$frontend = new GVA_Layout_Frontend();
	if(get_post_type($post_id) == 'page'){
		$header_id = get_post_meta($post_id, 'donatm_header_layout', true);
		if(empty($header_id) || $header_id == '_default_active'){
			$header_id = $frontend->get_template_default('header_layout');
		}
		return $header_id;
	}
	
	$template_id = $frontend->template_default_active_id();
	$post_meta_template = get_post_meta($post_id, 'donatm_template_layout', true);

	if( !empty($post_meta_template) && $post_meta_template != '_default_active' && is_numeric($post_meta_template) ){
		$template_id = $post_meta_template;
	}

	$header_id = 0;
	if($template_id){
		$header_id = get_post_meta($template_id, 'header_layout', true);
	}

	if(!$header_id){
		$header_id = $frontend->template_default_active_id('header_layout');
	}
	
	return $header_id;
} 
add_filter( 'donatm_get_header_layout', 'donatm_get_header_layout' );

function donatm_main_menu(){
	if(has_nav_menu( 'primary' )){
		$donatm_menu = array(
			'theme_location'    => 'primary',
			'container'         => 'div',
			'container_class'   => 'navbar-collapse',
			'container_id'      => 'gva-main-menu',
			'menu_class'        => ' gva-nav-menu gva-main-menu',
			'walker'            => new Donatm_Walker()
		);
		wp_nav_menu($donatm_menu);
	}  
}
add_action( 'donatm_main_menu', 'donatm_main_menu', 10 );
 
function donatm_mobile_menu(){
	if(has_nav_menu( 'primary' )){
		$donatm_menu = array(
			'theme_location'    => 'primary',
			'container'         => 'div',
			'container_class'   => 'navbar-collapse',
			'container_id'      => 'gva-mobile-menu',
			'menu_class'        => 'gva-nav-menu gva-mobile-menu',
			'walker'            => new Donatm_Walker()
		);
		wp_nav_menu($donatm_menu);
	}  
}
add_action( 'donatm_mobile_menu', 'donatm_mobile_menu', 10 );

function donatm_header_mobile(){
	get_template_part('templates/parts/header', 'mobile');
}
add_action('donatm_header_mobile', 'donatm_header_mobile', 10);

function donatm_canvas_mobile(){
	get_template_part('templates/parts/canvas', 'mobile');
}
add_action('donatm_canvas_mobile', 'donatm_canvas_mobile', 10);

add_filter('gavias-elements/map-api', 'donatm_googlemap_api');
function donatm_googlemap_api( $key = '' ){
   return donatm_get_option('map_api_key', '');
}

add_filter('gavias-post-type/slug-portfolio', 'donatm_slug_portfolio');
function donatm_slug_portfolio( $key = '' ){
	return donatm_get_option('slug_portfolio', '');
}

function donatm_setup_admin_setting(){
  	global $pagenow; 
  	if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	 	update_option( 'thumbnail_size_w', 175 );  
	 	update_option( 'thumbnail_size_h', 175 );  
	 	update_option( 'thumbnail_crop', 1 );  
	 	update_option( 'medium_size_w', 600 );  
	 	update_option( 'medium_size_h', 540 ); 
	 	update_option( 'medium_crop', 1 );  
  }
}
add_action( 'init', 'donatm_setup_admin_setting'  );

function donatm_page_class_names($classes) {
	$post_id = donatm_id();
 	$class_el = get_post_meta($post_id, 'donatm_extra_page_class', true);
 	if($class_el) $classes[] = $class_el;
 	$classes[] = 'donatm-body-loading';
 	return $classes;
}
add_filter( 'body_class', 'donatm_page_class_names' );

function donatm_admin_body_class( $str_classes ) {
   global $post;
   $template_slug = get_page_template_slug( $post );
   $classes   = explode(' ', $str_classes);
   $classes[] = 'template-' . str_replace('.php', '', $template_slug);
  	$new_classes = join(' ', $classes);
   return $new_classes;
}
add_filter( 'admin_body_class', 'donatm_admin_body_class' );

function donatm_post_classes($classes, $class, $post_id){
   if(is_single($post_id)){
    	$classes[] = 'post-single-content';
   }
   return $classes;
}
add_filter( 'post_class', 'donatm_post_classes', 10, 3 );

function donatm_nav_items( $items, $menu, $args ) {
  	if( is_admin() ){
    	return $items;
  	}
  	foreach($items as $item){
    	if( $item->attr_title == 'logout' ){
      	$item->url = wp_logout_url( home_url('/') );
    	}
	   if ('megamenu-explore' === $item->classes[0]) { 
	      $item->megamenu = true;
	      $item->megaalign = 'fullwidth';
	      $item->submegamenu = '306';
	   }
  	}
   return $items;
}
add_filter( 'wp_get_nav_menu_items', 'donatm_nav_items', 11, 3 );
