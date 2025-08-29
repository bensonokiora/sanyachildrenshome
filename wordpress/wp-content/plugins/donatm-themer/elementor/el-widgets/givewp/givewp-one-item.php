<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;


class GVAElement_Give_One_Item extends GVAElement_Base{

	const NAME = 'gva-give-one-item';
	const TEMPLATE = 'givewp/givewp-one-item';
	const CATEGORY = 'donatm_givewp';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __(' GiveWP One Item', 'donatm-themer');
	}

	public function get_keywords() {
		return [ 'donate', 'content', 'all', 'give', 'wp', 'form' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'easypiechart',
			'gavias.elements',
		];
	}

	public function get_style_depends() {
		return array();
	}

	private function get_posts() {
		$posts = array();

		$loop = new \WP_Query( array(
			'post_type' => array('give_forms'),
			'posts_per_page' => -1,
			'post_status'=> array('publish'),
		));

		$posts['none'] = __('None', 'donatm-themer');

		while ( $loop->have_posts() ) : $loop->the_post();
			$id = get_the_ID();
			$title = get_the_title();
			$posts[$id] = $title;
		endwhile;

		wp_reset_postdata();

		return $posts;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => __('Query & Layout', 'donatm-themer'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_ids',
			[
				'label' => __( 'Select Individually', 'donatm-themer' ),
				'type' => Controls_Manager::SELECT2,
				'default' => '',
				'multiple'    => false,
				'label_block' => true,
				'options'   => $this->get_posts(),
			]  
		);

		$this->add_control(
			'style',
			[
				'label'     => __('Style', 'donatm-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'simple-1'           => __( 'Item Style 01', 'donatm-themer' ),
					'simple-2'           => __( 'Item Style 02', 'donatm-themer' ),
					'simple-3'           => __( 'Item Style 03', 'donatm-themer' )
				],
				'default' => 'simple-1',
			]
		);

		$this->end_controls_section();

	}

	 public static function get_query_args(  $settings ) {
		$defaults = [
			'post_ids' => '',
			'orderby' => 'date',
			'order' => 'desc',
			'posts_per_page' => 1,
			'offset' => 0,
		];

		$settings = wp_parse_args( $settings, $defaults );
		$ids = $settings['post_ids'];

		$query_args = [
			'post_type' => 'give_forms',
			'ignore_sticky_posts' => 1,
			'post_status' => 'publish', 
		];

		if($ids){
			$query_args['post__in'] = array($ids);
		}
		return $query_args;
	}

	public function query_posts() {
		$query_args = $this->get_query_args( $this->get_settings() );
		return new WP_Query( $query_args );
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
			include $this->get_template(self::TEMPLATE . '.php');
		print '</div>'; 
	}
}

$widgets_manager->register(new GVAElement_Give_One_Item());