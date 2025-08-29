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

class GVAElement_Icon_Box_Group extends GVAElement_Base{
	const NAME = 'gva_icon_box_group';
	const TEMPLATE = 'booking/booking';
	const CATEGORY = 'donatm_general';

	public function get_categories() {
		return array(self::CATEGORY);
	}
		
	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return esc_html__('Icon Box Carousel/Grid', 'donatm-themer');
	}

	public function get_keywords() {
		return [ 'icon', 'box', 'content', 'carousel', 'grid' ];
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
					'carousel'  => esc_html__('Carousel', 'donatm-themer'),
					'list'  		=> esc_html__('List with Label', 'donatm-themer')
				]
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> esc_html__('Style', 'donatm-themer'),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'style-1' => esc_html__('Style 01', 'donatm-themer'),
					'style-2' => esc_html__('Style 02', 'donatm-themer'),
					'style-3' => esc_html__('Style 03', 'donatm-themer'),
					'style-4' => esc_html__('Style 04', 'donatm-themer'),
					'style-5' => esc_html__('Style 05', 'donatm-themer')
				],
				'default' => 'style-1',
				'condition' => [
					'layout' => ['grid', 'carousel'],
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'	=> esc_html__('Title'),
				'type' 		=> Controls_Manager::TEXT,
				'default' => 'Or browse the highlights:',
				'label_block' => true,
				'condition' => [
					'layout' => ['list']
				],
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'selected_icon',
			[
				'label'      	=> esc_html__('Choose Icon', 'donatm-themer'),
				'type'       	=> Controls_Manager::ICONS,
				'default' 		=> [
					'value' 		=> 'dicon-insurance-agent',
					'library' 	=> 'donatm-icons-theme'
				]
			]
		);
		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'donatm-themer'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Add your Title', 'donatm-themer'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'desc',
			[
				'label'       => esc_html__('Description', 'donatm-themer'),
				'type'        => Controls_Manager::TEXTAREA,
				'default'	  => ''
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
					'default' => ATBDP_TYPE
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
				'label'     	=> esc_html__('Link', 'donatm-themer'),
				'type'      	=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__('https://your-link.com', 'donatm-themer'),
				'label_block' 	=> true
			]
		);
		$repeater->add_control(
			'active',
			[
				'label' 			=> esc_html__('Active', 'donatm-themer'),
				'type' 			=> Controls_Manager::SWITCHER,
				'placeholder' 	=> esc_html__('Active', 'donatm-themer'),
				'default' 		=> 'no'
			]
		);
		$this->add_control(
			'icon_boxs',
			[
				'label'       => esc_html__('Brand Content Item', 'donatm-themer'),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'  					=> esc_html__('Restuarant', 'donatm-themer'),
						'selected_icon' 			=> array('value' => 'gicon-cutlery')
					),
					array(
						'title'  					=> esc_html__('Nightlife', 'donatm-themer'),
						'selected_icon' 			=> array('value' => 'gicon-cocktail')
					),
					array(
						'title'  					=> esc_html__('Fitness', 'donatm-themer'),
						'selected_icon' 			=> array('value' => 'gicon-health')
					),
					array(
						'title'  					=> esc_html__('Shopping', 'donatm-themer'),
						'selected_icon' 			=> array('value' => 'gicon-shop')
					),
					array(
						'title'  					=> esc_html__('Traveling', 'donatm-themer'),
						'selected_icon' 			=> array('value' => 'gicon-car-1')
					),
					array(
						'title'  					=> esc_html__('Beauty', 'donatm-themer'),
						'selected_icon' 			=> array('value' => 'gicon-skincare')
					)
				)
			]
		);
		
		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

		// Icon Styling
		$this->start_controls_section(
			'section_general_style',
			[
				'label' => esc_html__('General', 'donatm-themer'),
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
		$this->add_responsive_control(
			'primary_color',
			[
				'label' 		=> esc_html__('Background Color', 'donatm-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__single' => 'background-color: {{VALUE}};'
				]
			] 
		);
		$this->add_responsive_control(
			'second_color',
			[
				'label' 		=> esc_html__('Primary Color', 'donatm-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .list-icon-one ul .icon-item:hover, {{WRAPPER}} .list-icon-one ul .icon-item.active' => 'background-color: {{VALUE}};'
				],
				'condition' => [
					'layout' => 'list'
				],
			] 
		);
		$this->end_controls_section();

		// Icon Style
		$this->start_controls_section(
			'section_icon_style',
			[
				'label'	=> esc_html__('Icon', 'donatm-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'list'
				],
			]
		);

		$this->add_responsive_control(
			'icon_color',
			[
				'label' 		=> esc_html__('Icon Color', 'donatm-themer'),
				'type' 		=> Controls_Manager::COLOR,
				'default' 	=> '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__icon, {{WRAPPER}} .iconbox-two__icon, {{WRAPPER}} .iconbox-three__icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-one__icon svg, {{WRAPPER}} .iconbox-two__icon svg, {{WRAPPER}} .iconbox-three__icon svg' => 'fill: {{VALUE}};'
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
						'min' => 8,
						'max' => 80,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__icon, {{WRAPPER}} .iconbox-two__icon, {{WRAPPER}} .iconbox-three__icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .iconbox-one__icon svg, {{WRAPPER}} .iconbox-two__icon svg, {{WRAPPER}} .iconbox-three__icon svg' => 'width: {{SIZE}}{{UNIT}};',
					
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
					'{{WRAPPER}} .iconbox-three__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' => esc_html__('Padding', 'donatm-themer'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .iconbox-three__icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Title Style
		$this->start_controls_section(
			'section_title_style',
			[
				'label'	=> esc_html__('Title', 'donatm-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
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
					'{{WRAPPER}} .iconbox-one__title, {{WRAPPER}} .iconbox-two__title, {{WRAPPER}} .iconbox-three__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_responsive_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'donatm-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__title, {{WRAPPER}} .iconbox-two__title, {{WRAPPER}} .iconbox-three__title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-one__title a, {{WRAPPER}} .iconbox-two__title a, {{WRAPPER}} .iconbox-three__title a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-icon-one ul .icon-item' => 'color: {{VALUE}};',
					
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .iconbox-one__title, {{WRAPPER}} .iconbox-two__title, {{WRAPPER}} .iconbox-three__title',
			]
		);

		$this->end_controls_section();
		// Desc Style
		$this->start_controls_section(
			'section_desc_style',
			[
				'label'	=> esc_html__('Description', 'donatm-themer'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'desc_bottom_space',
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
					'{{WRAPPER}} .iconbox-one__desc, {{WRAPPER}} .iconbox-two__desc, {{WRAPPER}} .iconbox-three__desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		); 

		$this->add_responsive_control(
			'desc_color',
			[
				'label' => esc_html__('Color', 'donatm-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .iconbox-one__desc, {{WRAPPER}} .iconbox-two__desc, {{WRAPPER}} .iconbox-three__desc' => 'color: {{VALUE}};',
					'{{WRAPPER}} .iconbox-one__desc a, {{WRAPPER}} .iconbox-two__desc a, {{WRAPPER}} .iconbox-three__desc a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .list-icon-one ul .icon-item' => 'color: {{VALUE}};',
					
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'selector' => '{{WRAPPER}} .iconbox-one__desc, {{WRAPPER}} .iconbox-two__desc, {{WRAPPER}} .iconbox-three__desc',
			]
		);

		$this->end_controls_section();
		// Label Style
		$this->start_controls_section(
			'section_label_style',
			[
				'label'	=> esc_html__('Label', 'donatm-themer'),
				'tab'   	=> Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout' => 'list'
				],
			]
		);
		$this->add_responsive_control(
			'label_color',
			[
				'label' => esc_html__('Color', 'donatm-themer'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .list-icon-one ul .title' => 'color: {{VALUE}};',
					
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .list-icon-one ul .title',
			]
		);
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			if( !empty($settings['layout']) ){
				include $this->get_template('general/icon-box-group/' . $settings['layout'] . '.php');
			}
		print '</div>';
	}

}

$widgets_manager->register(new GVAElement_Icon_Box_Group());
