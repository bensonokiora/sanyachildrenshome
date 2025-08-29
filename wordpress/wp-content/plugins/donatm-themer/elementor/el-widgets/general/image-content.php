<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Image_Content extends GVAElement_Base {
	const NAME = 'gva-image-content';
	const TEMPLATE = 'general/image-content';
	const CATEGORY = 'donatm_general';

   public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __( 'Image Content', 'donatm-themer' );
	}
	
	public function get_keywords() {
		return [ 'image', 'content' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'donatm-themer' ),
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'skin-v1' => esc_html__('Style 01', 'donatm-themer'),
					'skin-v2' => esc_html__('Style 02', 'donatm-themer'),
					'skin-v3' => esc_html__('Style 03', 'donatm-themer'),
					'skin-v4' => esc_html__('Style 04', 'donatm-themer'),
					'skin-v5' => esc_html__('Style 05', 'donatm-themer'),
					'skin-v6' => esc_html__('Style 06', 'donatm-themer'),
					'skin-v7' => esc_html__('Style 07', 'donatm-themer'),
					'skin-v8' => esc_html__('Style 08', 'donatm-themer'),
					'skin-v9' => esc_html__('Style 09', 'donatm-themer'),
				],
				'default' => 'skin-v1'
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'donatm-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'donatm-themer' ),
				'default' => __( 'Quality Standards', 'donatm-themer' ),
				'label_block' => true,
				'condition' => [
					'style' => ['skin-v4']
				],
			]
		);
		$this->add_control(
			'description_text',
			[
				'label' => __( 'Description', 'donatm-themer' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter Your Description', 'donatm-themer' ),
				'condition' => [
					'style' => ['skin-v10'],
				],
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
			'image_second',
			[
				'label' => __( 'Choose Image Second', 'donatm-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/image-2.jpg',
				],
				'condition' => [
					'style' => ['skin-v3', 'skin-v4', 'skin-v5', 'skin-v6', 'skin-v8']
				],
			]
		);

		$this->add_control(
			'image_logo',
			[
				'label' => __( 'Choose Logo', 'donatm-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => false,
				'default' => [
					'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/logo-small-white.png',
				],
				'condition' => [
					'style' => ['skin-v3']
				],
			]
		);

		$this->add_group_control(
         Elementor\Group_Control_Image_Size::get_type(),
         [
            'name'      => 'image',
            'default'   => 'full',
            'separator' => 'none',
	         'condition' => [
					'style' => ['skin-v1'],
				]
         ]
      );

		$this->add_control(
			'video',
			[
				'label' 			=> __( 'Video', 'donatm-themer' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'placeholder' 	=> __( 'Enable/Disable Video Heading', 'donatm-themer' ),
				'default' 		=> 'no',
				'condition' => [
					'style' => ['skin-v4']
				],
			]
		);
		$this->add_control(
			'video_url',
			[
				'label' 			=> __( 'Video Youtube or Vimeo URL', 'donatm-themer' ),
				'label_block'	=> true,
				'type' 			=> Controls_Manager::TEXT,
				'condition' => [
					'video' => 'yes',
					'style' => ['skin-v4']
				],
			]
		);

		$this->add_control(
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'donatm-themer' ),
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
				'default' => 'h2',
				'condition' => [
					'style' => ['skin-v3']
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'donatm-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'donatm-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'link_text',
			[
				'label' => __( 'Text Link', 'donatm-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Read More', 'donatm-themer' ),
				'default' => __( 'Read More', 'donatm-themer' ),
				'condition' => [
					'style' => ['skin-v4'],
				],
			]
		);

		$this->end_controls_section();

		// Title Style
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'donatm-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['skin-v1', 'skin-v3'],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .about-one__title, {{WRAPPER}} .about-three__title, {{WRAPPER}} .about-four__title, {{WRAPPER}} .about-five__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{WRAPPER}} .about-one__title, {{WRAPPER}} .about-three__title, {{WRAPPER}} .about-four__title, {{WRAPPER}} .about-five__title',
			]
		);

		$this->end_controls_section();

		// Description Style
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => __( 'Description', 'donatm-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['skin-v1', 'skin-v3'],
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => __( 'Text Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-one__desc, {{WRAPPER}} .about-three__desc, {{WRAPPER}} .about-four__desc, {{WRAPPER}} .about-five__desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .about-one__desc, {{WRAPPER}} .about-three__desc, {{WRAPPER}} .about-four__desc, {{WRAPPER}} .about-five__desc',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template(self::TEMPLATE . '.php');
      print '</div>';
	}

}

 $widgets_manager->register(new GVAElement_Image_Content());
