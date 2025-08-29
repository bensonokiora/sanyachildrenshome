<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;

class GVAElement_Features_Block extends GVAElement_Base {  
	const NAME = 'gva-features-block';
	const TEMPLATE = 'general/features-block';
	const CATEGORY = 'donatm_general';

   public function get_categories() {
      return array(self::CATEGORY);
   }
    
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __( 'Features Block', 'donatm-themer' );
	}

	public function get_keywords() {
		return [ 'features', 'block', 'icon' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Features Block', 'donatm-themer' ),
			]
		);
		
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style 01', 'donatm-themer' )
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'donatm-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Safe your money', 'donatm-themer' ),
				'placeholder' => __( 'Enter your title', 'donatm-themer' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Image', 'donatm-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/image-1.jpg',
				],
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor amet consectetur adipiscing elit do eiusmod tempor incid idunt ut labore.', 'donatm-themer' ),
				'placeholder' => __( 'Enter your description', 'donatm-themer' ),
				'show_label' => false,
				'condition' => [
					'style' => ['style-1']
				]
			]
		);

		$this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image',
            'default'   => 'full',
            'separator' => 'none',
            'condition' => [
					'style' => ['style-1']
				]
         ]
      );

		$this->add_control(
			'header_tag',
			[
				'label' => __( 'Title HTML Tag', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h3',
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' => __( 'Link', 'donatm-themer' ),
				'type' => Controls_Manager::URL,
			]
		);

		$this->add_control(
			'active',
			[
				'label' 			=> __( 'Active', 'donatm-themer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no'
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label' => __( 'Content', 'donatm-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'mask_color',
			[
				'label' => __( 'Mask Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-one__content' => 'background: {{VALUE}};'
				],
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
				'selectors' => [
					'{{WRAPPER}} .feature-one__title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-one__title' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .feature-one__title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'donatm-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => ['style-1'],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .feature-one__desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => ['style-1'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .feature-one__desc',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render icon box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template( self::TEMPLATE . '.php');
      print '</div>';
	}
}

$widgets_manager->register(new GVAElement_Features_Block());
