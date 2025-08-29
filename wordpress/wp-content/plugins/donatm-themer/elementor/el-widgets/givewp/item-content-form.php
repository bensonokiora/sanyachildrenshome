<?php
if (!defined('ABSPATH')) { exit; }

use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

class GVAElement_GiveWP_Item_Content_Form extends GVAElement_Base{
    
   const NAME = 'gva_givewp_item_content_form';
   const TEMPLATE = 'givewp/item-content-form';
   const CATEGORY = 'donatm_givewp';

   public function get_categories() {
      return array(self::CATEGORY);
   }

   public function get_name() {
      return self::NAME;
   }

   public function get_title() {
      return __('GiveWP - Item Form', 'donatm-themer');
   }

   public function get_keywords() {
      return [ 'givewp', 'item', 'form', 'content' ];
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
         'show_title',
         [
            'label' => __( 'Show Title', 'donatm-themer' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes'
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

$widgets_manager->register(new GVAElement_GiveWP_Item_Content_Form());
