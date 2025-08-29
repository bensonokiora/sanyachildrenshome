<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_GiveWP_Item_Goal extends GVAElement_Base{
    
   const NAME = 'gva-givewp-item-goal';
   const TEMPLATE = 'givewp/item-goal';
   const CATEGORY = 'donatm_givewp';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('GiveWP - Item Goal', 'donatm-themer');
   }

   public function get_keywords() {
      return [ 'givewp', 'item', 'goal' ];
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
         'style',
         [
            'label' => __( 'Style', 'donatm-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'style-1'      => __( 'Style I', 'donatm-themer' ),
            ],
            'default' => 'style-1',
         ]
      );
      $this->add_control(
         'empty_fill',
         [
            'label' => __( 'Color EmptyFill', 'kitecx-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .givewp-item-goal.style-1 .campaign-goal .goal' => 'background-color: {{VALUE}};',
            ],
         ]
      );
      $this->add_control(
         'bar_color',
         [
            'label' => __( 'Color', 'kitecx-themer' ),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}} .givewp-item-goal.style-1 .campaign-goal .goal .goal-bar' => 'background-color: {{VALUE}};',
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

$widgets_manager->register(new GVAElement_GiveWP_Item_Goal());
