<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Simple_Slider extends GVAElement_Base{
  	const NAME = 'gva-simple-slider';
  	const TEMPLATE = 'general/simple-slider';
  	const CATEGORY = 'donatm_general';

  	public function get_name() {
	 	return self::NAME;
  	}

  	public function get_categories() {
	 	return array(self::CATEGORY);
  	}

  	public function get_title() {
	 	return __('Simple Slider', 'donatm-themer');
  	}

  	public function get_keywords() {
	 	return [ 'slider', 'content' ];
  	}

  	public function get_script_depends() {
	 	return [
			'swiper',
			'gavias.elements',
	 	];
  	}

  	public function get_style_depends() {
	 	return array('swiper');
  	}

	protected function register_controls() {
	  	$this->start_controls_section(
			'section_content',
			[
				 'label' => __('Content', 'donatm-themer'),
			]
	  	);
  
		$repeater = new Repeater();

		$repeater->add_control(
			'style',
			[
				'label' => __( 'Style', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style 01', 'donatm-themer' ),
					'style-2' 		=> __( 'Style 02', 'donatm-themer' ),
					'style-3' 		=> __( 'Style 03', 'donatm-themer' )
				],
				'default' => 'style-1',
			]
		);
	  	$repeater->add_control(
			'image',
			[
				 'label'      => __('Choose Image', 'donatm-themer'),
				 'default'    => [
					  'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/slider-1.jpg',
				 ],
				 'type'       => Controls_Manager::MEDIA,
				 'show_label' => false
			]
	  	);
	  	$repeater->add_control(
		 	'sub_title',
		 	[
				'label'       => __('SubTitle', 'donatm-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'top Funding stories',
				'label_block' => true,
			]
	  	);
		$repeater->add_control(
			'title',
			[
				'label'       => __('Title', 'donatm-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'Add your Title',
				'label_block' => true,
			]
		);
	  	$repeater->add_control(
		 	'desc',
		 	[
				'label'       => __('Description', 'donatm-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => 'We help our clients reimagine, restructure and renew business functions to create<br> agile and resilient organizations It’s always a joy to hear that the work.',
				'show_label' => false
		 	]
	  	);
	  	$repeater->add_control(
			'video',
			[
				'label'       => __('Video Link (Youtube/Vimeo)', 'donatm-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true
			]
		);
		$repeater->add_control(
			'heading_btn_donate',
			[
				'label'       => __('----- BUTTONS -----', 'donatm-themer'),
				'type'        => Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			 'btn_donate_title',
			 [
				'label'       => __('Button Donate Title', 'donatm-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Donate Now', 'donatm-themer'),
				'label_block' => true,
			 ]
		);
		$repeater->add_control(
			'btn_donate_id',
			[
				'label'     	=> __( 'Campaign ID', 'donatm-themer' ),
				'type'      	=> Controls_Manager::NUMBER,
				'placeholder'	=> __( 'Campaign ID', 'donatm-themer' ),
				'min'				=> 1,
				'label_block' 	=> false
			]
		);
		$repeater->add_control(
			'heading_btn_1',
			[
				'label'       => __('----- BUTTONS -----', 'donatm-themer'),
				'type'        => Controls_Manager::HEADING,
			]
		);
		$repeater->add_control(
			 'btn_title',
			 [
				'label'       => __('Button Title 01', 'donatm-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Explore More', 'donatm-themer'),
				'label_block' => true,
			 ]
		);
		$repeater->add_control(
			'btn_link',
			[
				'label'     => __( 'Button Link 01', 'donatm-themer' ),
				'type'      => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'donatm-themer' ),
				'label_block' => true
			]
		);
		$repeater->add_control(
			'btn_title_2',
			[
				'label'       => __('Button Title 02', 'donatm-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Become a Volunteer', 'donatm-themer'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'btn_link_2',
			[
				'label'     => __( 'Button Link 02', 'donatm-themer' ),
				'type'      => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'donatm-themer' ),
				'label_block' => true
			]
		 );

		//------- Style sub title, title, description --------------------

		$repeater->add_control(
			'heading_sub_title',
			[
				'label'       => __('----- Style Sub Title -----', 'donatm-themer'),
				'type'        => Controls_Manager::HEADING,
			]
		);

		$repeater->add_control(
		 	'title_sub_color',
		 	[
				'label' => __( 'Sub Title Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} ' => 'color: {{VALUE}};',
				],
		 	]
	  	);

	  	$repeater->add_group_control(
		 	Group_Control_Typography::get_type(),
		 	[
				'name' => 'title_sub_typography',
				'selector' => '{{WRAPPER}}',
		 	]
	  	);

	  	$repeater->add_control(
			'heading_title',
			[
				'label'       => __('----- Style Title -----', 'donatm-themer'),
				'type'        => Controls_Manager::HEADING,
			]
		);

		$repeater->add_control(
		 	'title_color',
		 	[
				'label' => __( 'Title Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} ' => 'color: {{VALUE}};',
				],
		 	]
	  	);

	  	$repeater->add_group_control(
		 	Group_Control_Typography::get_type(),
		 	[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}}',
		 	]
	  	);

	  	$repeater->add_control(
			'descrption_style',
			[
				'label'       => __('----- Description Style -----', 'donatm-themer'),
				'type'        => Controls_Manager::HEADING,
			]
		);

		$repeater->add_control(
		 	'descrption_color',
		 	[
				'label' => __( 'Title Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
				  '{{WRAPPER}} ' => 'color: {{VALUE}};',
				],
		 	]
	  	);

	  	$repeater->add_group_control(
		 	Group_Control_Typography::get_type(),
		 	[
				'name' => 'descrption_typography',
				'selector' => '{{WRAPPER}}',
		 	]
	  	);

		$this->add_control(
			'carousel_content',
			[
				'label'       => __('Content Item', 'donatm-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'sub_title'         => esc_html__( 'Change The World Together', 'donatm-themer' ),
						'title'             => 'Empowering lives<br>through giving'
					),
					array(
						'sub_title'         => esc_html__( 'Change The World Together', 'donatm-themer' ),
						'title'             => 'Lend a helping hand<br>to who those need it'
					),
				) 
			]
		);
		  
		$this->end_controls_section();

		// Slider Setting ---------------
		$this->start_controls_section(
			'section_slider_setting',
			[
				'label' => __( 'Sliders Setting', 'donatm-themer' )
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'wrap-1' 		=> __( 'Style 01', 'donatm-themer' ),
					'wrap-2' 		=> __( 'Style 02', 'donatm-themer' )
				],
				'default' => 'wrap-1',
			]
		);
		$this->add_responsive_control(
			'min_height',
			[
				'label' 		=> esc_html__('Min Height', 'donatm-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .simple-slider .swiper-slide' => 'min-height: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
		$this->add_responsive_control(
			'content_padding_top',
			[
				'label' 		=> esc_html__('Content Padding Top', 'donatm-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .simple-slider .swiper-slide .slider-content' => 'padding-top: {{SIZE}}{{UNIT}};',
					
				],
			]
		);
		$this->add_control(
			'space_between',
			[
			  'label'     => __('Space Between Items', 'donatm-themer'),
			  'type'      => Controls_Manager::NUMBER,
				'default'	=> 0
			]
	 	);
	  	$this->add_control(
			'ca_loop',
			[
				'label'     => __('Loop', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);
		$this->add_control(
			'ca_speed',
			[
				'label'     => __('Speed', 'donatm-themer'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1200,
			]
		);
		$this->add_control(
			'ca_autoplay',
			[
				'label'     => __('Auto Play', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		 );
		$this->add_control(
			'ca_autoplay_delay',
			[
				'label'     => __('Auto Play Delay', 'donatm-themer'),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
			]
		);
		$this->add_control(
			'ca_autoplay_hover',
			[
				'label'     => __('Play Hover', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);
		$this->add_control(
			'ca_navigation',
			[
				'label'     => __('Navigation', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);
		$this->add_control(
			'ca_pagination',
			[
				'label'     => __('Pagination', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no'
			]
		);
		$this->end_controls_section();

		// Style -----------------
		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'donatm-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'donatm-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_bottom_space',
			[
				'label' => __( 'Spacing', 'donatm-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
				  'px' => [
					 'min' => 0,
					 'max' => 100,
				  ],
				],
				'default' => [
				  'size'  => 0
				],
				'selectors' => [
				  '{{WRAPPER}} .gsc-content-carousel .item-content .item-content-inner .box-content .gsc-heading .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		  $this->end_controls_section();
	 }

	 protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
		include $this->get_template(self::TEMPLATE . '.php');
		print '</div>';
	 }

}

$widgets_manager->register(new GVAElement_Simple_Slider());
