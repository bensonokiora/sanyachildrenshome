<?php

if (!defined('ABSPATH')) {
		exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Marquee extends GVAElement_Base{
	const NAME = 'gva_marquee';
	const TEMPLATE = 'general/marquee';
	const CATEGORY = 'donatm_general';

	public function get_categories() {
		return array(self::CATEGORY);
	}
		
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('Marquee', 'donatm-themer');
	}

	public function get_keywords() {
		return [ 'marquee', 'content' ];
	}

	public function get_script_depends() {
		return [
			'marquee',
			'gavias.elements',
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
			'style',
			[
				'label' 		=> esc_html__('Style', 'donatm-themer'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'style-1' => esc_html__('Style 01', 'donatm-themer')
				],
				'default' => 'style-1',
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
			'image',
			[
				'label' => __( 'Choose Image', 'donatm-themer' ),
				'type' => Controls_Manager::MEDIA,
				'label_block' => true,
				'default' => [
					'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/image-3.jpg',
				],
			]
		);
		$repeater->add_control(
			'link',
			[
				'label'     	=> esc_html__('Link', 'donatm-themer'),
				'type'      	=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__('https://your-link.com', 'donatm-themer'),
				'label_block' 	=> true
			]
		);

		$this->add_control(
			'content_items',
			[
				'label'       => esc_html__('Content Item', 'donatm-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'  					=> esc_html__('Medical', 'donatm-themer')
					),
					array(
						'title'  					=> esc_html__('Education', 'donatm-themer')
					),
					array(
						'title'  					=> esc_html__('Foods', 'donatm-themer')
					),
					array(
						'title'  					=> esc_html__('Health', 'donatm-themer')
					),
					array(
						'title'  					=> esc_html__('Support', 'donatm-themer')
					),
					array(
						'title'  					=> esc_html__('Donation', 'donatm-themer')
					)
				)
			]
		);
		
		$this->add_control(
			'direction',
			[
				'label' 		=> esc_html__('Direction', 'donatm-themer'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'left' => esc_html__('Left', 'donatm-themer'),
					'right' => esc_html__('Right', 'donatm-themer')
				],
				'default' => 'left',
			]
		);
		$this->add_control(
			'duration',
			[
				'label' 		=> esc_html__('Duration', 'donatm-themer'),
				'type' 		=> Controls_Manager::NUMBER,
				'default' => 50000,
			]
		);
		$this->add_control(
			'gap',
			[
				'label' 		=> esc_html__('Gap', 'donatm-themer'),
				'type' 		=> Controls_Manager::NUMBER,
				'default' => 10,
			]
		);
		$this->add_control(
			'pause_on_hover',
			[
				'label' => __( 'Pause On Hover', 'donatm-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Auto Responsive size of title', 'donatm-themer' ),
				'default' => 'yes'
			]
		);
		$this->add_control(
			'image_size',
			[
				'label'     => __('Image Size', 'donatm-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => 'thumbnail'
			]
		);
		$this->end_controls_section();

		// Icon Styling
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Style', 'donatm-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_box',
			[
				'label'	=> esc_html__('Box', 'donatm-themer'),
				'type'	=> Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' 		=> esc_html__('Primary Color', 'donatm-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-item' => 'background-color: {{VALUE}};'
				]
			] 
		);

		$this->add_control(
			'heading_icon',
			[
				'label'	=> esc_html__('Icon', 'donatm-themer'),
				'type'	=> Controls_Manager::HEADING
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> esc_html__('Icon Color', 'donatm-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .box-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content svg' => 'fill: {{VALUE}};'
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> esc_html__('Size', 'donatm-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .box-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .box-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' 		=> esc_html__('Spacing', 'donatm-themer'),
				'type' 		=> Controls_Manager::SLIDER,
				'default' 	=> [
					'size' 	=> 0,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .icon-inner' => 'padding-bottom: {{SIZE}}{{UNIT}};',
				],
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
				'default' => [
					'size'  => 5
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .title' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-icon-box-group .icon-box-content .title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .gsc-icon-box-group .icon-box-content .title, {{WRAPPER}} .gsc-icon-box-group .icon-box-content .title a',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			include $this->get_template('general/marquee.php');
		print '</div>';
	}

}

$widgets_manager->register(new GVAElement_Marquee());
