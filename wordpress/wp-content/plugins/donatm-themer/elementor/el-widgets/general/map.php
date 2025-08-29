<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

class GVAElement_Map extends GVAElement_Base {
	const NAME = 'gva-map';
   const TEMPLATE = 'general/map';
   const CATEGORY = 'donatm_general';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

	public function get_title() {
		return __( 'Map', 'donatm-themer' );
	}

	
	public function get_keywords() {
		return [ 'map', 'block' ];
	}

	public function get_script_depends() {
      return [
         'map-ui',
         'google-maps-api'
      ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
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
				'label_block' => true
			]
		);

		$this->add_control(
			'map_type',
			[
				'label' => __( 'Map Type', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ROADMAP' => esc_html__('ROADMAP', 'donatm-themer'),
					'HYBRID' => esc_html__('HYBRID', 'donatm-themer'),
					'SATELLITE' => esc_html__('SATELLITE', 'donatm-themer'),
					'TERRAIN' => esc_html__('TERRAIN', 'donatm-themer'),
				],
				'default' => 'ROADMAP',
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Latitude, Longitude for map', 'donatm-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Latitude, Longitude', 'donatm-themer' ),
				'description' => esc_html__( 'eg: 21.0173222,105.78405279999993', 'donatm-themer' ),
				'label_block' => true
			]
		);

		$this->add_control(
			'height',
			[
				'label' => __( 'Map height', 'donatm-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '500px', 'donatm-themer' ),
				'default' => '500px',
				'description' => esc_html__( 'Enter map height (in pixels or leave empty for responsive map), eg: 400px', 'donatm-themer' )
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
$widgets_manager->register(new GVAElement_Map());
