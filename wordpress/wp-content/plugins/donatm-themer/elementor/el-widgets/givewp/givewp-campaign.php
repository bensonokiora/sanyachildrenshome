<?php
if ( ! defined( 'ABSPATH' ) ) {
   exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Give\Framework\Database\DB;

class GVAElement_GiveWP_Campaign extends GVAElement_Base{

   const NAME = 'gva-givewp-campaign-totals';
   const TEMPLATE = 'givewp/wpgive-campaign';
   const CATEGORY = 'donatm_givewp';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('GiveWP Campaign', 'donatm-themer');
   }


   public function get_icon() {
      return 'eicon-posts-carousel';
   }

   public function get_keywords() {
      return [ 'donate', 'content', 'campaign', 'give' ];
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

   private function get_posts() {
      $posts = array();

      $campaigns = DB::table('give_campaigns', 'campaigns')
            ->select(
                ['campaigns.id', 'id'],
                ['campaigns.form_id', 'defaultFormId'],
                ['campaign_title', 'title'],
                ['GROUP_CONCAT(campaign_forms.form_id)', 'form_ids']
            )
            ->join(function ($builder) {
                $builder
                    ->leftJoin("give_campaign_forms", "campaign_forms")
                    ->on("campaign_forms.campaign_id", "id");
            })
            ->groupBy("campaigns.id")
            ->orderBy('id', 'DESC')
            ->limit(100)
            ->getAll();

      $posts['none'] = __('None', 'donatm-themer');
      foreach ($campaigns as $key => $campaign) {
         $posts[absint($campaign->id)] = esc_html($campaign->title);
      }
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
         'style',
         [
            'label'     => __('Style', 'donatm-themer'),
            'type'      => \Elementor\Controls_Manager::SELECT,
            'options' => [
               'totals-1'     => __( 'Item Style 01', 'donatm-themer' )
            ],
            'default' => 'totals-1',
         ]
      );

      $this->add_control(
         'post_id',
         [
            'label' => __( 'Select Individually', 'donatm-themer' ),
            'type' => Controls_Manager::SELECT2,
            'default' => '',
            'multiple'    => false,
            'label_block' => true,
            'options'   => $this->get_posts()
         ]  
      );
      $this->add_control(
         'title_show',
         [
            'label'     => __('Show Title', 'donatm-themer'),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'no',
            
         ]
      );
      $this->add_control(
         'title',
         [
            'label'        => __( 'Title Override', 'donatm-themer' ),
            'type'         => Controls_Manager::TEXT,
            'placeholder'  => __( 'Enter your custom title', 'donatm-themer' ),
            'default'      => '',
            'label_block'  => true,
            'condition' => [
               'title_show' => 'yes'
            ]
         ]
      );
      $this->add_control(
         'button_style',
         [
            'label'     => __('Button Style', 'donatm-themer'),
            'type'      => \Elementor\Controls_Manager::SELECT,
            'options' => [
               'default'            => __( 'Default', 'donatm-themer' ),
               'btn-donate-white'   => __( 'Button White', 'donatm-themer' )
            ],
            'default' => 'default',
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

      // Style
      $this->start_controls_section(
         'section_style_content',
         [
            'label' => esc_html__('Style', 'donatm-themer'),
            'tab'   => Controls_Manager::TAB_STYLE,
         ]
      );

      $this->add_control(
         'text_color',
         [
            'label' => esc_html__('Text Color', 'donatm-themer'),
            'type' => Controls_Manager::COLOR,
            'default' => '',
            'selectors' => [
              '{{WRAPPER}} .campaign-totals-one__raised, {{WRAPPER}} .campaign-totals-one__goal' => 'color: {{VALUE}};'
            ],
         ]
      );

      $this->end_controls_section();
   }

   protected function render() {
      $settings = $this->get_settings_for_display();
      printf('<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template('givewp/givewp-campaign.php');
      print '</div>'; 
   }
   
}

$widgets_manager->register(new GVAElement_GiveWP_Campaign());