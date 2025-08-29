<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_GiveWP_Item_Donate_Button extends GVAElement_Base{
    
   const NAME = 'gva-givewp-item-donate-button';
   const TEMPLATE = 'givewp/item-donate-button';
   const CATEGORY = 'donatm_givewp';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('GiveWP - Donate Button', 'donatm-themer');
   }

   public function get_keywords() {
      return [ 'givewp', 'item', 'donate', 'button' ];
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
         'label_btn',
         [
            'label' => __( 'Button Label', 'donatm-themer' ),
            'type' => Controls_Manager::TEXT,
            'placeholder' => __( 'Enter your label', 'donatm-themer' ),
            'default' => __( 'Donate Now', 'donatm-themer' ),
            'label_block' => true
         ]
      );
      $this->add_control(
         'campaign_id',
         [
            'label' => __( 'Custom Campaign ID', 'donatm-themer' ),
            'type' => Controls_Manager::NUMBER,
            'min'  => 1,
            'default' => '',
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

$widgets_manager->register(new GVAElement_GiveWP_Item_Donate_Button());
