<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Give\Campaigns\Models\Campaign;
use Give\Campaigns\ValueObjects\CampaignType;
use Give\Framework\Database\DB;
use Give\Framework\Exceptions\Primitives\InvalidArgumentException;
use Give\Framework\Models\ModelQueryBuilder;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;


class GVAElement_Give_Campaigns extends GVAElement_Base{

	const NAME = 'gva-give-campaigns';
	const TEMPLATE = 'givewp/campaigns/';
	const CATEGORY = 'donatm_givewp';

	public function get_categories() {
		return array(self::CATEGORY);
	}

	public function get_name() {
		return self::NAME;
	}

	public function get_title() {
		return __('All GiveWP Campaigns', 'donatm-themer');
	}

	public function get_keywords() {
		return [ 'donate', 'content', 'carousel', 'grid', 'all', 'give', 'wp', 'campaigns' ];
	}

	public function get_script_depends() {
		return [
			'swiper',
			'easypiechart',
			'gavias.elements',
		];
	}

	public function get_style_depends() {
		return array('swiper');
	 }

	private function get_categories_list(){
		$categories = array();

		$categories['none'] = __( 'None', 'donatm-themer' );
		$taxonomy = 'give_forms_category';
		$tax_terms = get_terms( $taxonomy );
		if ( ! empty( $tax_terms ) && ! is_wp_error( $tax_terms ) ){
			foreach( $tax_terms as $item ) {
				$categories[$item->term_id] = $item->name;
			}
		}
		return $categories;
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
			'layout',
			[
				'label'   => __( 'Layout Display', 'donatm-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'carousel',
				'options' => [
					'grid'      		=> __( 'Grid', 'donatm-themer' ),
					'carousel'  		=> __( 'Carousel', 'donatm-themer' )
				]
			]
		);

		$this->add_control(
			'post_ids',
			[
				'label' 		=> __( 'Select Individually', 'donatm-themer' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> '',
				'placeholder'	=> '1,2,3,4,5,6',
				'label_block' 	=> true,
				'condition' 	=> [
			   		'layout' => ['grid', 'carousel']
				]
			]  
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __( 'Posts Per Page', 'donatm-themer' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 6,
				'condition' => [
			   'layout' => ['grid', 'carousel']
			]
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Order By', 'donatm-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'campaigns.id',
				'options' => [
					'campaigns.id'  	=> __( 'ID', 'donatm-themer' ),
					'campaign_title' 	=> __( 'Title', 'donatm-themer' ),
					'rand()'       		=> __( 'Random', 'donatm-themer' )
				],
				'condition' => [
			   'layout' => ['grid', 'carousel']
			]
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'donatm-themer' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => __( 'ASC', 'donatm-themer' ),
					'desc' => __( 'DESC', 'donatm-themer' )
				],
				'condition' => [
			   'layout' => ['grid', 'carousel']
			]
			]
	  );

		$this->add_control(
			'style',
			[
				'label'     => __('Style', 'donatm-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'style-1'           => __( 'Item Style 01', 'donatm-themer' ),
					'style-2'           => __( 'Item Style 02', 'donatm-themer' ),
					'style-3'           => __( 'Item Style 03', 'donatm-themer' ),
					'style-4'           => __( 'Item Style 04', 'donatm-themer' ),
					'style-5'           => __( 'Item Style 05', 'donatm-themer' )
				],
				'default' => 'style-1',
				'condition' => [
			   'layout' => ['grid', 'carousel']
			]
			]
		);
		$this->add_control(
			'image_size',
			[
				'label'     => __('Image Style', 'donatm-themer'),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => $this->get_thumbnail_size(),
				'default'   => 'post-thumbnail',
				'condition' => [
			   'layout' => ['grid', 'carousel']
			]
			]
		);
		$this->add_control(
			'excerpt_words',
			[
				'label'     => __('Excerpt Words', 'donatm-themer'),
				'type'      => 'number',
				'default'   => 15,
				'condition' => [
			   'layout' => ['grid', 'carousel']
			]
			]
		);

		$this->add_control(
			'pagination',
			[
				'label'     => __('Pagination', 'donatm-themer'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => [
					'layout' => 'grid'
				]
			]
		);

		$this->add_control(
			'notfound',
			[
				'label'     => __('Text Not found', 'donatm-themer'),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => __('At the moment there are no result in this element. Please check all of content.', 'donatm-themer')
			]
		);

		$this->end_controls_section();

		$this->add_control_carousel(false, array('layout' => 'carousel'));

		$this->add_control_grid(array('layout' => 'grid'));

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$defaults = [
			'orderby' => 'campaigns.id',
			'order' => 'desc',
			'posts_per_page' => 6,
			'offset' => 0,
		];
		$settings = wp_parse_args( $settings, $defaults );

		if(is_front_page()){
			$page = (get_query_var('page')) ? get_query_var('page') : 1;
		}else{
			$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		$limit = $settings['posts_per_page'];
		$offset = $page > 0 ? ($page - 1) * $limit : 0;
		
		//$builder = new ModelQueryBuilder(Campaign::class);
		//$campaigns_query = $builder->from('give_campaigns', 'campaigns')
		// ->select(
		// 	['campaigns.id', 'id'],
		// 	['campaigns.form_id', 'defaultFormId'], // Prefix the `form_id` column to avoid conflicts with the `give_campaign_forms` table.
		// 	['campaign_type', 'type'],
		// 	['campaign_page_id', 'pageId'],
		// 	['campaign_title', 'title'],
		// 	['short_desc', 'shortDescription'],
		// 	['long_desc', 'longDescription'],
		// 	['campaign_logo', 'logo'],
		// 	['campaign_image', 'image'],
		// 	['primary_color', 'primaryColor'],
		// 	['secondary_color', 'secondaryColor'],
		// 	['campaign_goal', 'goal'],
		// 	['goal_type', 'goalType'],
		// 	'status',
		// 	['start_date', 'startDate'],
		// 	['end_date', 'endDate'],
		// 	['date_created', 'createdAt'],
		// 	['GROUP_CONCAT(campaign_forms.form_id)', 'form_ids']
		// )
		// ->join(function ($builder) {
		// 	$builder
		// 		->leftJoin("give_campaign_forms", "campaign_forms")
		// 		->on("campaign_forms.campaign_id", "id");
		// })
		// ->groupBy("campaigns.id")
		// ->orderBy($settings['orderby'], $settings['order'])
		// ->limit($limit)
		// ->offset($offset)
		// ->where('campaigns.campaign_type', CampaignType::CORE);

		$query = Campaign::query();
		$query->where('status', 'active');
        $totalQuery = clone $query;

		$query->orderBy($settings['orderby'], $settings['order']);
		$query->limit($limit);
		$query->offset($offset);
		$query->where('campaigns.campaign_type', CampaignType::CORE);

		// Where Post IDs
		$post_ids = $settings['post_ids'];
		if($post_ids){
			$ids = explode(',', $post_ids);
			if( is_array($ids) && count($ids) > 0 ){
				$query->whereIn('campaigns.id', $ids);
			}
		}

		// Return Campaigns
		$campaigns = $query->getAll();
		
		// Count 
		$count = empty($campaigns) ? 0 : $totalQuery->count();
        $total_pages = $count === 0 ? 0 : (int)ceil($count / $limit);

        //Display
		printf('<div class="gva-element-%s gva-element">', $this->get_name() );
		if(!empty($settings['layout'])){
			include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
		}
		print '</div>'; 
	}
}

$widgets_manager->register(new GVAElement_Give_Campaigns());