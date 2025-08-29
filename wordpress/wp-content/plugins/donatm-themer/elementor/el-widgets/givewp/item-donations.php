<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_GiveWP_Item_Donations extends GVAElement_Base{
	 
	const NAME = 'gva_givewp_donations';
	const TEMPLATE = 'givewp/item-donations';
	const CATEGORY = 'donatm_givewp';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('GiveWP - Item Donations', 'donatm-themer');
	}

	public function get_keywords() {
		return [ 'givewp', 'item', 'donations' ];
	}

	public function get_script_depends() {
		return [];
	 }

	 public function get_style_depends() {
		  return array();
	 }

	protected function register_controls() {
	  
		$this->start_controls_section(
			self::NAME . '_content',
			[
				'label' => __('Content', 'donatm-themer'),
			]
		);

		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1'      => __( 'Style 01', 'donatm-themer' )
				],
				'default' => 'style-1',
			]
		);
		$this->add_control(
			'sort_by',
			[
				'label' => __( 'Sort By', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'top-donations'      => __( 'Top Donations', 'donatm-themer' ),
					'recent-donations'   => __( 'Recent Donations', 'donatm-themer' )
				],
				'default' => 'recent-donations',
			]
		);
		$this->add_control(
			'per_page',
			[
				'label' 	=> __( 'Per Page', 'donatm-themer' ),
				'type' 	=> Controls_Manager::NUMBER,
				'min'		=> 1, 
				'default' => 8,
			]
		);
		$this->add_control(
			'show_anonymous',
			[
				'label'     => __('Show anonymous', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes'
			]
		);
		$this->add_control(
			'show_icon',
			[
				'label'     => __('Show Icon', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'show_button',
			[
				'label'     => __('Show Button', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
			]
		);

		$this->end_controls_section();

	}

	protected function render(){
		parent::render();

		$settings = $this->get_settings_for_display();
		printf( '<div class="donatm-%s donatm-element">', $this->get_name() );
			include $this->get_template(self::TEMPLATE . '.php');
		print '</div>';
	}
}

$widgets_manager->register(new GVAElement_GiveWP_Item_Donations());
