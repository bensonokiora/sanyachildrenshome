<?php
function donatm_register_meta_boxes(){
	$prefix = 'donatm_';
	global $meta_boxes;
	$meta_boxes = array();

	/* ====== Metabox Template ====== */
	$meta_boxes[] = array(
		'id'    => 'gavias_metaboxes_page',
		'title' => esc_html__('Page Meta', 'donatm'),
		'pages' => array( 'gva__template'),
		'priority'   => 'high',
		'fields' => array(
			array(
				'name' => esc_html__('Template Type', 'donatm'),
				'id'   => "gva_template_type",
				'type' => 'text'
			),
		)
	);

	/* ====== Metabox Page ====== */
	$meta_boxes[] = array(
		'id'    => 'gavias_metaboxes_page',
		'title' => esc_html__('Page Meta', 'donatm'),
		'pages' => array( 'page'),
		'priority'   => 'high',
		'fields' => array(
			array(
            'name' => esc_html__('Full Width', 'donatm'),
            'id'   => "{$prefix}page_full_width",
            'type' => 'switch',
            'desc' => esc_html__('Turn on to have the main area display at 100% width according to the window size. Turn off to follow site width.', 'donatm'),
            'std' => 0,
         ),
			array(
				'name' => esc_html__('Header Layout', 'donatm'),
				'id'   => "{$prefix}header_layout",
				'type' => 'select',
				'options' => donatm_list_header_layout(),
				'multiple' => false,
				'std'  => '_default_active',
			),
			array(
				'name' => esc_html__('Footer Layout', 'donatm'),
				'id'   => "{$prefix}footer_layout",
				'type' => 'select',
				'options' => donatm_list_footer_layout(),
				'multiple' => false,
				'std'  => '_default_active',
			),
			array(
				'name' => esc_html__('Extra page class', 'donatm'),
				'id' => $prefix . 'extra_page_class',
				'desc' => esc_html__("If you wish to add extra classes to the body class of the page (for custom css use), then please add the class(es) here.", 'donatm'),
				'clone' => false,
				'type'  => 'text',
				'std' => '',
			),
		)
	);

	/* ====== Metabox Page Title ====== */
	$meta_boxes[] = array(
		'id' => 'gavias_metaboxes_page_heading',
		'title' => esc_html__('Page Title & Breadcrumb', 'donatm'),
		'pages' => array( 'post', 'page', 'product', 'portfolio', 'tribe_events'),
		'context' => 'normal',
		'priority'   => 'high',
		'fields' => array(
		  	array(
				'name' => esc_html__('Remove Title of Page', 'donatm'),   
				'id'   => "{$prefix}disable_page_title",
				'type' => 'switch',
				'std'  => 0,
		  	),
		  	array(
			 	'name' => esc_html__('Disable Breadcrumbs', 'donatm'),
			 	'id'   => "{$prefix}no_breadcrumbs",
			 	'type' => 'switch',
			 	'desc' => esc_html__('Disable the breadcrumbs from under the page title on this page.', 'donatm'),
			 	'std' => 0,
		  	),
		  	array(
			 	'name' => esc_html__('Breadcrumb Layout', 'donatm'),
			 	'id'   => "{$prefix}breadcrumb_layout",
			 	'type' => 'select',
			 	'options' => array(
				 	'layout_options'    => esc_html__('Default Options in Layout Template', 'donatm'),
				 	'page_options'      => esc_html__('Individuals Options This Page', 'donatm')
			 	),
			 	'multiple' => false,
			 	'std'  => 'theme_options',
			 	'desc' => esc_html__('You can use breadcrumb settings default in Layout Template or individuals this page', 'donatm')
		  	),
		  	array(
			 	'name' 	=> esc_html__( 'Background Overlay Color', 'donatm' ),
			 	'id'   	=> "{$prefix}breacrumb_bg_color",
			 	'desc' 	=> esc_html__( "Set an overlay color for hero heading image.", 'donatm' ),
			 	'type' 	=> 'color',
			 	'class' => 'breadcrumb_setting',
			 	'std'  	=> '',
		  	),
		  	array(
			 	'name'       => esc_html__( 'Overlay Opacity', 'donatm' ),
			 	'id'         => "{$prefix}breacrumb_bg_opacity",
			 	'desc'       => esc_html__( 'Set the opacity level of the overlay. This will lighten or darken the image depening on the color selected.', 'donatm' ),
			 	'clone'      => false,
			 	'type'       => 'slider',
			 	'prefix'     => '',
			 	'class'   	  => 'breadcrumb_setting',
			 	'js_options' => array(
				  	'min'  => 0,
				  	'max'  => 100,
				  	'step' => 1,
			 	),
			 	'std'   => '50'
		  	),
		  	array(
			 	'name'  	=> esc_html__('Breadcrumb Background Image', 'donatm'),
			 	'id'    	=> "{$prefix}breacrumb_image",
			 	'type'  	=> 'image_advanced',
			 	'class'   	=> 'breadcrumb_setting',
			 	'max_file_uploads' => 1
		  	),
		)
	);

	return $meta_boxes;
 }  
  /********************* META BOX REGISTERING ***********************/
  add_filter( 'rwmb_meta_boxes', 'donatm_register_meta_boxes' , 99 );

