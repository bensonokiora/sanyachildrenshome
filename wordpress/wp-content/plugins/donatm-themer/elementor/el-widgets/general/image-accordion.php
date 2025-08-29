<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Image_Accordion extends GVAElement_Base{
  	const NAME = 'gva-image-accordion';
  	const TEMPLATE = 'general/image-accordion';
  	const CATEGORY = 'donatm_general';

  	public function get_name() {
	 	return self::NAME;
  	}

  	public function get_categories() {
	 	return array(self::CATEGORY);
  	}

	public function get_title() {
		return esc_html__('Image Accordion', 'donatm-themer');
	}

	public function get_keywords() {
		return [ 'horizontal', 'content', 'accordion', 'image' ];
	}

	public function get_script_depends() {
		return [
			'gavias.elements'
		];
	}

	public function get_style_depends() {
		return array();
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'donatm-themer'),
			]
		);
		$this->add_control( // xx Layout
			'layout_heading',
			[
				'label'   => esc_html__('Layout', 'donatm-themer'),
				'type'    => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'layout',
			[
				'label'   => esc_html__('Layout Display', 'donatm-themer'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => [
					 'grid'      => esc_html__('Grid', 'donatm-themer'),
					 'carousel'  => esc_html__('Carousel', 'donatm-themer')
				]
			]
	  	);
	  	$this->add_control(
			'style',
			[
				'label' => esc_html__('Style', 'donatm-themer'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 	=> esc_html__('Style 01', 'donatm-themer'),
				],
				'default' => 'style-1',
			]
	  	);
		$this->add_responsive_control(
			'min_height',
			[
				'label' 		=> esc_html__('Min Height', 'donatm-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 600,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .service-one__content' => 'min-height: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'donatm-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Add your Title',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__('Description', 'donatm-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Luxury Properties With Conveniences.',
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'image',
			[
				'label'      => esc_html__('Choose Image', 'donatm-themer'),
				'default'    => [
					'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/image-3.jpg',
				],
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false,
			]
		);
		if(class_exists('ATBDP_Listing')){
			$repeater->add_control(
				'taxonomy',
				[
					'label' => __( 'Taxonomy', 'donatm-themer' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
					  	ATBDP_TYPE => esc_html__('Type', 'donatm-themer'),
					  'at_biz_dir-location' => esc_html__('Location', 'donatm-themer'),
					  'at_biz_dir-category' => esc_html__('Category', 'donatm-themer'),
					],
					'default' => 'at_biz_dir-location',
				]
			);
			$repeater->add_control(
				'term_slug',
				[
					'label'       	=> esc_html__('Term Slug', 'donatm-themer'),
					'type'        	=> Controls_Manager::TEXT,
					'placeholder'	=> esc_html__('ex: villa', 'donatm-themer'),
					'default'	  	=> ''
				]
			);
		}
		$repeater->add_control(
			'link',
			[
				'label'     => esc_html__('Link', 'donatm-themer'),
				'type'      => Controls_Manager::URL,
				'placeholder' => esc_html__('https://your-link.com', 'donatm-themer'),
				'label_block' => true
			]
		);
		$repeater->add_control(
         'active',
			[
	         'label'       => __('Active', 'donatm-themer'),
	         'type'        => Controls_Manager::SWITCHER,
	         'default'	  => 'no'
	     	]
	   );
		$this->add_control(
			'services_content',
			[
				'label'       => esc_html__('Service Content Item', 'donatm-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
				  	array(
					 	'title'  => esc_html__('California', 'donatm-themer'),
					 	'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/gallery-1.jpg'
                  ]
				  	),
				  	array(
					 	'title'  => esc_html__('New York', 'donatm-themer'),
					 	'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/gallery-2.jpg'
                  ]
				  	),
				  	array(
					 	'title'  => esc_html__('Las Vegas', 'donatm-themer'),
					 	'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/gallery-3.jpg'
                  ]
				  	),
				  	array(
					 	'title'  => esc_html__('Melbourne', 'donatm-themer'),
					 	'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/gallery-4.jpg'
                  ]
				  	),
				  	array(
					 	'title'  => esc_html__('New York', 'donatm-themer'),
					 	'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/gallery-5.jpg'
                  ]
				  	),
				  	array(
					 	'title'  => esc_html__('London', 'donatm-themer'),
					 	'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/gallery-3.jpg'
                  ]
				  	)
				)
			]
		);
		
		$this->add_control(
			'image_size',
			[
				'label'     => __('Image Size', 'donatm-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => ''
			]
		);

		$this->add_control(
			'btn_label',
			[
				'label' => __( 'Button label last item', 'donatm-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Get a Quote', 'donatm-themer' ),
				'placeholder' => __( 'Enter your label', 'donatm-themer' ),
				'label_block' => true,
				'condition' => [
					'style' => ['style-1']
				]
			]
		);

		$this->end_controls_section();


	 	$this->start_controls_section(
			'section_style_content',
			[
				'label' => esc_html__('Content', 'donatm-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => esc_html__('Title', 'donatm-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => esc_html__('Spacing', 'donatm-themer'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 100,
				  ],
				],
				'selectors' => [
				  '{{WRAPPER}} .accordion-one__title, {{WRAPPER}} .accordion-two__title, {{WRAPPER}} .accordion-three__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'donatm-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .accordion-one__title, {{WRAPPER}} .accordion-one__title a, {{WRAPPER}} .accordion-two__title, {{WRAPPER}} .accordion-two__title a, {{WRAPPER}} .accordion-three__title, {{WRAPPER}} .accordion-three__title a' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .accordion-one__title, {{WRAPPER}} .accordion-two__title, {{WRAPPER}} .accordion-three__title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => esc_html__('Description', 'donatm-themer'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__('Color', 'donatm-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} .accordion-one__desc, {{WRAPPER}} .accordion-two__desc, {{WRAPPER}} .accordion-three__desc' => 'color: {{VALUE}};'
				],
			]
		);

	  	$this->add_group_control(
		 	Group_Control_Typography::get_type(),
		 	[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .accordion-one__desc, {{WRAPPER}} .accordion-two__desc, {{WRAPPER}} .accordion-three__desc'
			]
	  	);

		$this->end_controls_section();
	 }

	 protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			include $this->get_template(self::TEMPLATE . '.php');
		print '</div>';
	 }

}

$widgets_manager->register(new GVAElement_Image_Accordion());
