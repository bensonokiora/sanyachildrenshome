<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_GiveWP_Item_Statistics extends GVAElement_Base{
    
   const NAME = 'gva-givewp-item-statistics';
   const TEMPLATE = 'givewp/item-statistics';
   const CATEGORY = 'donatm_givewp';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('GiveWP - Item Campaign Statistics', 'donatm-themer');
   }

   public function get_keywords() {
      return [ 'givewp', 'item', 'statistics' ];
   }

   public function get_script_depends() {
      return array();
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
         'title_text',
         [
            'label' => __( 'Title', 'donatm-themer' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter your title', 'donatm-themer' ),
            'default' => __( 'Add Your Heading Text Here', 'donatm-themer' ),
            'label_block' => true
         ]
      );
      $this->add_control(
         'style',
         [
            'label' => __( 'Style', 'donatm-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'style-1'      => __( 'Style 01', 'donatm-themer' ),
            ],
            'default' => 'style-1',
         ]
      );
      $this->add_control(
         'type',
         [
            'label' => __( 'Type', 'donatm-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'top-donation'       => __( 'Top Donation', 'donatm-themer' ),
               'average-donation'   => __( 'Average Donation', 'donatm-themer' )
            ],
            'default' => 'top-donation',
         ]
      );
      $this->add_control(
         'primary color',
         [
            'label' => __( 'Primary Color', 'kitecx-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .givewp-item-statistics.style-1 .campaign-statistics .statistics' => 'background-color: {{VALUE}};',
            ],
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

$widgets_manager->register(new GVAElement_GiveWP_Item_Statistics());
