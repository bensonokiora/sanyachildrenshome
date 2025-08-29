<?php
   $this->add_render_attribute( 'block', 'class', [ $settings['breakpoint_menu_mobile'], 'gva-navigation-menu', ' menu-align-' . $settings['align'], $settings['style'] ] );
   $args = [
      'echo'        => false,
      'menu'        => !empty($settings['menu']) ? $settings['menu'] : 'main-menu',
      'menu_class'  => 'gva-nav-menu gva-main-menu',
      'menu_id'     => 'menu-' . wp_rand(5),
      'container'   => 'div',
      'fallback_cb' => false
   ];

   if(class_exists('Donatm_Walker')){
      $args['walker' ]  = new Donatm_Walker();
   }
   
   $menu_html = wp_nav_menu($args);

   if (empty($menu_html)) {
      return;
   }

   // Mobile menu
   $mobile_menu_args = array(
      'menu'              => !empty($settings['menu']) ? $settings['menu'] : 'main-menu',
      'container'         => 'div',
      'container_class'   => 'navbar-collapse',
      'container_id'      => 'gva-mobile-menu',
      'menu_class'        => 'gva-nav-menu gva-mobile-menu',
      
   );


   if(class_exists('Donatm_Walker')){
      $mobile_menu_args['walker'] = new Donatm_Walker();
   }

?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
   <div class="nav-one__default nav-screen__default">
      <?php echo $menu_html; ?>
   </div>

   <div class="nav-one__mobile nav-screen__mobile">
      <div class="canvas-menu gva-offcanvas">
         <a class="dropdown-toggle" data-canvas=".mobile" href="#">
            <span class="menu-bar">
               <span class="one"></span>
               <span class="two"></span>
               <span class="three"></span>
            </span>
         </a>
      </div>
   </div>

   <div class="canvas-mobile">
      <?php global $donatm_theme_options;  $donatm_options = donatm_get_options(); ?>
      <div class="gva-offcanvas-content mobile">
         <div class="first-layer"></div>
         <div class="second-layer"></div>
         <div class="top-canvas">
            <?php $logo_mobile = (isset($donatm_options['header_logo']['url']) && $donatm_options['header_logo']['url']) ? $donatm_options['header_logo']['url'] : get_template_directory_uri().'/assets/images/logo-mobile.png' ; ?>
            <a class="logo-mm" href="<?php echo esc_url( home_url( '/' ) ); ?>">
               <img src="<?php echo esc_url($logo_mobile); ?>" alt="<?php bloginfo( 'name' ); ?>" />
            </a>
            <a class="control-close-mm" href="#">
               <span class="menu-bar-close">
               <span class="one"></span>
               <span class="two"></span>
               <span class="three"></span>
            </span>
            </a>
         </div>
         <div class="wp-sidebar sidebar">
            <?php echo wp_nav_menu($mobile_menu_args); ?>
            <div class="after-offcanvas">
               <?php
                  if(is_active_sidebar('offcanvas_sidebar_mobile')){ 
                     dynamic_sidebar('offcanvas_sidebar_mobile');
                  }
               ?>
            </div>    
         </div>
         <div class="mobile-menu-footer">
            <div class="mobile-socials">
               <?php
                  if($settings['facebook']){
                     echo '<a href="' . $settings['facebook'] . '"><i class="fa fa-facebook"></i></a>';
                  }
                  if($settings['twitter']){
                     echo '<a href="' . $settings['twitter'] . '"><i class="fab fa-x-twitter"></i></a>';
                  }
                  if($settings['linkedin']){
                     echo '<a href="' . $settings['linkedin'] . '"><i class="fa fa-linkedin"></i></a>';
                  }
                  if($settings['pinterest']){
                     echo '<a href="' . $settings['pinterest'] . '"><i class="fa fa-pinterest"></i></a>';
                  }
                  if($settings['youtube']){
                     echo '<a href="' . $settings['youtube'] . '"><i class="fa fa-youtube"></i></a>';
                  }
                  if($settings['instagram']){
                     echo '<a href="' . $settings['instagram'] . '"><i class="fa fa-instagram"></i></a>';
                  }
               ?>
            </div>
         </div>
      </div>
   </div>
</div>