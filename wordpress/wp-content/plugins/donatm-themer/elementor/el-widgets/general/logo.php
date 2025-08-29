<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Logo extends GVAElement_Base {
	const NAME = 'gva-logo';
   const TEMPLATE = 'general/logo';
   const CATEGORY = 'donatm_general';

    public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Logo', 'donatm-themer' );
	}

	public function get_keywords() {
		return [ 'image', 'logo', 'branding' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => __( 'Content', 'donatm-themer' ),
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'donatm-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your title', 'donatm-themer' ),
				'default' => __( 'Home', 'donatm-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Logo Image', 'donatm-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/logo.png',
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
			'align',
			[
				'label' => __( 'Alignment', 'donatm-themer' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'donatm-themer' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'donatm-themer' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'donatm-themer' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'center',
			]
		);
		$this->add_control(
			'max_width',
			[
				'label' => __( 'Max Width', 'donatm-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 80,
						'max' => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-logo .site-branding-logo' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Logo Styling', 'donatm-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'logo_padding',
			[
				'label' => __( 'Padding', 'donatm-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-logo .site-branding-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'logo_margin',
			[
				'label' => __( 'Margin', 'donatm-themer' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .gsc-logo .site-branding-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
         Group_Control_Border::get_type(),
         [
            'name'      => 'logo_border',
            'selector'  => '{{WRAPPER}} .gsc-logo .site-branding-logo',
            'separator' => 'before',
         ]
       );

       $this->add_control(
         'image_border_radius',
         [
            'label'      => __('Border Radius', 'donatm-themer'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .gsc-logo .site-branding-logo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
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

$widgets_manager->register( new GVAElement_Logo );
