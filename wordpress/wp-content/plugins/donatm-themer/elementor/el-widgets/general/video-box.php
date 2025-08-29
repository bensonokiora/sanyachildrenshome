<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Video_Box extends GVAElement_Base {  
	const NAME = 'gva-video-box';
   const TEMPLATE = 'general/video-box';
   const CATEGORY = 'donatm_general';

   public function get_categories(){
      return array(self::CATEGORY);
   }
    
   public function get_name(){
      return self::NAME;
   }

	public function get_title() {
		return __( 'Video Box', 'donatm-themer' );
	}

	public function get_keywords() {
		return [ 'video', 'box' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Content', 'donatm-themer' ),
			]
		);

		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'donatm-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter Your Title', 'donatm-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'style', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' 		=> __( 'Style 1', 'donatm-themer' ),
					'style-2' 		=> __( 'Style 2', 'donatm-themer' ),
					'style-3' 		=> __( 'Style 3', 'donatm-themer' ),
					'style-4' 		=> __( 'Style 4', 'donatm-themer' ),
					'style-5' 		=> __( 'Style 5', 'donatm-themer' ),
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Image', 'donatm-themer' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
               'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/video.jpg',
				],
				'condition' => [
					'style' => ['style-1']
				]
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link Video (Youtube/Vimeo)', 'donatm-themer' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'donatm-themer' ),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_box_style',
			[
				'label' => __( 'Box Style', 'donatm-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'primary_color',
			[
				'label' => __( 'Primary Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-two__content' => 'border-color: {{VALUE}};',

				],
			]
		);
		$this->add_control(
			'second_color',
			[
				'label' => __( 'Second Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-two__content:before' => 'border-color: {{VALUE}};',

				],
			]
		);
		$this->add_control(
			'bg_color',
			[
				'label' => __( 'Background Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-two__content' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_control(
			'bg_icon_color',
			[
				'label' => __( 'Icon Background Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-two__action' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'style-2',
				],
			]
		);

		$this->add_control(
			'heading_icon',
			[
				'label' => __( 'Icon', 'donatm-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'donatm-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30
				],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .video-one__action .popup-video,{{WRAPPER}} .video-two__action .popup-video' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-one__action .video-one__icon,{{WRAPPER}} .video-two__action .video-two__icon ' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => __( 'Border Color', 'donatm-themer' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .video-one__action .video-one__icon,{{WRAPPER}} .video-two__action .video-two__icon' => 'border-color: {{VALUE}}',
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
				'label' => __( 'Spacing Bottom', 'donatm-themer' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 20
				],
				'selectors' => [
					'{{WRAPPER}} .video-two__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .video-two__title' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .video-two__title',
			]
		);

		$this->add_control(
			'heading_description',
			[
				'label' => __( 'Description', 'donatm-themer' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => 'style-1',
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
					'{{WRAPPER}} .highlight_content .desc' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => 'style-1',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .highlight_content .desc',
				'condition' => [
					'style' => 'style-1',
				],

			]
		);

		$this->add_responsive_control(
			'description_bottom_space',
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
					'size' => 20
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-icon-box-styles .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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

$widgets_manager->register(new GVAElement_Video_Box());
