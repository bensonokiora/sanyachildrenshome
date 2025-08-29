<?php
Redux::setSection( $opt_name, array(
  'title'     	=> esc_html__('Typography & Styling', 'donatm'),
  'icon'      	=> 'el-icon-pencil',
  'fields' 		=> array(
  		array (
         'id'     => 'main_font_info',
         'type'   => 'info',
         'icon'   => true,
         'raw'    => '<h3 class="mb-0">' . esc_html__('Main Font', 'donatm') . '</h3>',
      ),
      array(
         'id'        => 'main_font_source',
         'type'      => 'radio',
         'title'     => esc_html__('Font Source', 'donatm'),
         'options'   => array(
            '0'   => esc_html__('(none)', 'donatm'),
            '1'   => esc_html__('Standard + Google Webfonts', 'donatm'), 
         ),
         'default'   => '1'
      ),
      // Main font: Standard + Google Webfonts
      array (
         'id'           => 'main_font',
         'type'         => 'typography',
         'title'        => esc_html__('Font Face', 'donatm'),
         'line-height'  => false,
         'text-align'   => false,
         'font-style'   => false,
         'font-weight'  => false,
         'font-size'    => false,
         'color'        => false,
         'required'     => array('main_font_source', '=', '1')
      ),
      // Secondary font
      array (
         'id'     => 'secondary_font_info',
         'icon'   => true,
         'type'   => 'info',
         'raw'    => '<h3 class="mb-0">' . esc_html__('Secondary Font', 'donatm') . '</h3>',
      ),
      array(
         'id'        => 'secondary_font_source',
         'type'      => 'radio',
         'title'     => esc_html__('Font Source', 'donatm'),
         'options'   => array(
            '0'   => esc_html__('(none)', 'donatm'),
            '1'   => esc_html__('Standard + Google Webfonts', 'donatm'), 
         ),
         'default'   => '0'
      ),
      // Secondary font: Standard + Google Webfonts
      array (
         'id'           => 'secondary_font',
         'type'         => 'typography',
         'title'        => esc_html__('Font Face', 'donatm'),
         'line-height'  => false,
         'text-align'   => false,
         'font-style'   => false,
         'font-weight'  => false,
         'font-size'    => false,
         'color'        => false,
         'required'     => array('secondary_font_source', '=', '1')
      ),

      //Styling
	 	array(
			'id'  	=> 'colors_info_styling',
			'type'   => 'info',
			'raw' 	=> '<h3 class="mb-0">' . esc_html__('Body Colors', 'donatm') . '</h3>'
	 	),
	 	array(
         'id'           => 'body_color',
         'type'         => 'color',
         'title'        => esc_html__('Body Color', 'donatm'),
         'default'      => '',
         'transparent'  => false,
         'validate'     => 'color'
      ),
      array(
         'id'           => 'color_link',
         'type'         => 'color',
         'title'        => esc_html__('Link Color', 'donatm'),
         'default'      => '',
         'transparent'  => false,
         'validate'     => 'color'
      ),
      array(
         'id'           => 'color_link_hover',
         'type'         => 'color',
         'title'        => esc_html__('Link Hover Color', 'donatm'),
         'default'      => '',
         'transparent'  => false,
         'validate'     => 'color'
      ),
      array(
         'id'           => 'color_heading',
         'type'         => 'color',
         'title'        => esc_html__('Heading Color', 'donatm'),
         'default'      => '',
         'transparent'  => false,
         'validate'     => 'color'
      ),
	 	array(
         'id'     => 'info_background',
         'type'   => 'info',
         'raw'    => '<h3 class="mb-0">' . esc_html__('Background', 'donatm') . '</h3>'
      ),
      array(
         'id'           => 'main_background_color',
         'type'         => 'color',
         'title'        => esc_html__('Background Color', 'donatm'),
         'desc'         => esc_html__('Used for the main site background.', 'donatm'),
         'default'      => '',
         'transparent'  => false,
         'validate'     => 'color'
      ),
      array(
         'id'     => 'main_background_image',
         'type'   => 'media', 
         'url'    => true,
         'title'  => esc_html__('Background Image', 'donatm'),
         'desc'   => esc_html__('Upload a background image or specify a URL (boxed layout).', 'donatm')
      ),
      array(
         'id'        => 'main_background_image_type',
         'type'      => 'select',
         'title'     => esc_html__('Background Type', 'donatm'),
         'desc'      => esc_html__('Select the background-image type (fixed image or repeat pattern/texture).', 'donatm'),
         'options'   => array( 
            'fixed' => esc_html__('Fixed (Full)', 'donatm'), 
            'repeat' => esc_html__('Repeat (Pattern)', 'donatm')
         ),
         'default'   => 'fixed'
      ),
      
      array(
         'id'        => 'footer_info_styling',
         'type'      => 'info',
         'raw'       => '<h3 class="mb-0">' . esc_html__('Footer Default Styling', 'donatm') . '</h3>'
      ),
      array(
         'id'        => 'footer_bg_color',
         'type'      => 'color',
         'title'     => esc_html__('Background Color', 'donatm'),
         'default'   => '',
         'validate'  => 'color'
      ),
      array(
         'id'        => 'footer_color',
         'type'      => 'color',
         'title'     => esc_html__('Text Color', 'donatm'),
         'default'   => '',
         'validate'  => 'color'
      ),
      array(
         'id'        => 'footer_color_link',
         'type'      => 'color',
         'title'     => esc_html__('Link Color', 'donatm'),
         'default'   => '',
         'validate'  => 'color'
      ),
      array(
         'id'        => 'footer_color_link_hover',
         'type'      => 'color',
         'title'     => esc_html__('Link Hover Color', 'donatm'),
         'default'   => '',
         'validate'  => 'color'
      )
  	)
));