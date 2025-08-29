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

class GVAElement_Icon_Box_Styles extends GVAElement_Base {  
	const NAME = 'gva-icon-box-styles';
	const TEMPLATE = 'general/icon-box-styles';
	const CATEGORY = 'donatm_general';

   public function get_categories() {
      return array(self::CATEGORY);
   }
    
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __( 'Icon Box Styles', 'donatm-themer' );
	}

	public function get_keywords() {
		return [ 'icon box', 'icon' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Icon Box Style', 'donatm-themer' ),
			]
		);
		
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style 01', 'donatm-themer' ),
					'style-2' 		=> __( 'Style 02', 'donatm-themer' )
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'donatm-themer' ),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				]
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title & Description', 'donatm-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'This is the heading', 'donatm-themer' ),
				'placeholder' => __( 'Enter your title', 'donatm-themer' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'description_text',
			[
				'label' => '',
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'There are many new variations of pasages of available text.', 'donatm-themer' ),
				'placeholder' => __( 'Enter your description', 'donatm-themer' ),
				'show_label' => false,
				'condition' => [
					'style' => ['style-1', 'style-2']
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
			'active',
			[
				'label' => __( 'Active', 'donatm-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( //** Section Button
			'section_button',
			[
				'label' => __( 'Button & Link', 'donatm-themer' ),
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' => __( 'Link', 'donatm-themer' ),
				'type' => Controls_Manager::URL,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Icon', 'donatm-themer' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'selected_icon[value]!' => ''
				],
			]
		);

		$this->add_control(
			'box_primary_color',
			[
				'label' => __( 'Primary Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .box-style-one__icon-inner' => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'style' => ['style-1']
				]
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__('Icon Color', 'donatm-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .box-style-one__icon-inner i, {{WRAPPER}} .box-style-two__icon-inner i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .box-style-one__icon-inner svg, {{WRAPPER}} .box-style-two__icon-inner svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'donatm-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 12,
						'max' => 120,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .box-style-one__icon-inner i, {{WRAPPER}} .box-style-two__icon-inner i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .box-style-one__icon-inner svg, {{WRAPPER}} .box-style-two__icon-inner svg' => 'width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' 		=> esc_html__('Spacing', 'donatm-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .box-style-one__icon-inner, {{WRAPPER}} .box-style-two__icon-inner' => 'margin-right: {{SIZE}}{{UNIT}};'
				],
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
					'{{WRAPPER}} .box-style-one__title, {{WRAPPER}} .box-style-two__title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
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
					'{{WRAPPER}} .box-style-one__title, {{WRAPPER}} .box-style-two__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .box-style-one__title a, {{WRAPPER}} .box-style-two__title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .box-style-one__title, {{WRAPPER}} .box-style-two__title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'donatm-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => __( 'Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .box-style-one__desc, {{WRAPPER}} .box-style-two__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .box-style-one__desc, {{WRAPPER}} .box-style-two__desc',

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

$widgets_manager->register(new GVAElement_Icon_Box_Styles());
