<?php
if(!defined('ABSPATH')){ exit; }

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Team extends GVAElement_Base{

   const NAME = 'gva-team';
   const TEMPLATE = 'general/team/';
   const CATEGORY = 'donatm_general';

   public function get_name() {
      return self::NAME;
   }

   public function get_categories() {
      return array(self::CATEGORY);
   }

    
   public function get_title() {
      return __('Team', 'donatm-themer');
   }

   public function get_keywords() {
      return [ 'team', 'meet', 'carousel', 'grid' ];
   }

   public function get_script_depends() {
      return [
         'swiper',
         'gavias.elements',
      ];
   }

   public function get_style_depends() {
      return array('swiper');
   }

   protected function register_controls() {
      $this->start_controls_section(
         'section_content',
         [
            'label' => __('Content', 'donatm-themer'),
         ]
      );

      $repeater = new Repeater();

      $repeater->add_control(
         'image',
         [
            'label'      => __('Choose Image', 'donatm-themer'),
            'default'    => [
               'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/team-1.jpg',
            ],
            'type'       => Controls_Manager::MEDIA,
            'show_label' => false,
         ]
      );
      $repeater->add_control(
         'name',
         [
            'label'       => __('Name', 'donatm-themer'),
            'type'        => Controls_Manager::TEXT,
            'label_block' => true,
         ]
      );
      $repeater->add_control(
         'desc',
         [
            'label'       => __('Description', 'donatm-themer'),
            'type'        => Controls_Manager::TEXTAREA,
            'label_block' => true,
         ]
      );
      $repeater->add_control(
         'position',
         [
            'label'       => __('Position', 'donatm-themer'),
            'type'        => Controls_Manager::TEXT,
            'label_block' => true,
         ]
      );
      $repeater->add_control(
         'link',
         [
            'label'      => __('Link', 'donatm-themer'),
            'placeholder' => __( 'https://your-link.com', 'donatm-themer' ),
            'type'       => Controls_Manager::URL,
         ]
      );
      $repeater->add_control(
         'social_link_heading',
         [
            'label'      => __('Social Link', 'donatm-themer'),
            'type'       => Controls_Manager::HEADING,
         ]
      );
      $repeater->add_control(
         'facebook',
         [
            'label'      => __('Facebook Link', 'donatm-themer'),
            'type'       => Controls_Manager::URL,
         ]
      );

      $repeater->add_control(
         'twitter',
         [
            'label'      => __('Twitter X Link', 'donatm-themer'),
            'type'       => Controls_Manager::URL,
         ]
      );
      $repeater->add_control(
         'instagram',
         [
            'label'      => __('Instagram Link', 'donatm-themer'),
            'type'       => Controls_Manager::URL,
         ]
      );
      $repeater->add_control(
         'pinterest',
         [
            'label'      => __('Pinterest Link', 'donatm-themer'),
            'type'       => Controls_Manager::URL,
         ]
      );

      $this->add_control(
         'team_content',
         [
            'label'       => __('Team Content Item', 'donatm-themer'),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'title_field' => '{{{ name }}}',
            'default'     => array(
               array(
                  'name'         => esc_html__('Leslie Alexander', 'donatm-themer'),
                  'position'     => esc_html__('Volunteer', 'donatm-themer'),
                  'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/team-1.jpg',
                  ],
                  'facebook'     => ['url' => '#'],
                  'twitter'      => ['url' => '#'],
                  'instagram'    => ['url' => '#']
               ),
               array(
                  'name'  => esc_html__('Ralph Edwards', 'donatm-themer'),
                  'position'     => esc_html__('Supporter', 'donatm-themer'),
                  'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/team-2.jpg',
                  ],
                  'facebook'     => ['url' => '#'],
                  'twitter'      => ['url' => '#'],
                  'instagram'    => ['url' => '#']
               ),
               array(
                  'name'  => esc_html__('Marvin McKinney', 'donatm-themer'),
                  'position'     => esc_html__('Volunteer', 'donatm-themer'),
                  'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/team-3.jpg',
                  ],
                  'facebook'     => ['url' => '#'],
                  'twitter'      => ['url' => '#'],
                  'instagram'    => ['url' => '#']
               ),
               array(
                  'name'  => esc_html__('Eleanor Pena', 'donatm-themer'),
                  'position'     => esc_html__('Volunteer', 'donatm-themer'),
                  'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/team-4.jpg',
                  ],
                  'facebook'     => ['url' => '#'],
                  'twitter'      => ['url' => '#'],
                  'instagram'    => ['url' => '#']
               ),
               array(
                  'name'  => esc_html__('Kathryn Murphy', 'donatm-themer'),
                  'position'     => esc_html__('CEO, Company', 'donatm-themer'),
                  'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/team-5.jpg',
                  ],
                  'facebook'     => ['url' => '#'],
                  'twitter'      => ['url' => '#'],
                  'instagram'    => ['url' => '#']
               ),
               array(
                  'name'  => esc_html__('Guy Hawkins', 'donatm-themer'),
                  'position'     => esc_html__('Team leader', 'donatm-themer'),
                  'image'  => [
                     'url' => GAVIAS_DONATM_PLUGIN_URL . 'elementor/assets/images/team-6.jpg',
                  ],
                  'facebook'     => ['url' => '#'],
                  'twitter'      => ['url' => '#'],
                  'instagram'    => ['url' => '#']
               ),
            ),
         ]
      );

      $this->add_control(
         'layout',
         [
            'label'   => __( 'Layout Display', 'donatm-themer' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'grid',
            'options' => [
               'grid'      => __( 'Grid', 'donatm-themer' ),
               'carousel'  => __( 'Carousel', 'donatm-themer' )
            ]
         ]
      );
      $this->add_control(
         'style',
         [
            'label' => __( 'Item Style', 'donatm-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               'style-1'      => __( 'Item Style 01', 'donatm-themer' ),
               'style-2'      => __( 'Item Style 02', 'donatm-themer' ),
               'style-3'      => __( 'Item Style 03', 'donatm-themer' ),
               'style-4'      => __( 'Item Style 04', 'donatm-themer' )
            ],
            'default' => 'style-1',
         ]
      );
       $this->add_control(
         'image_size',
         [
            'label'   => __( 'Image Size', 'donatm-themer' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'full',
            'options' => $this->get_thumbnail_size()
         ]
      );
        
      $this->end_controls_section();

      $this->add_control_carousel(false, array('layout' => 'carousel'));

      $this->add_control_grid(array('layout' => 'grid'));

   }

   protected function render(){
      $settings = $this->get_settings_for_display();
      printf('<div class="gva-element-%s gva-element">', $this->get_name());
      if(!empty($settings['layout'])){
         include $this->get_template(self::TEMPLATE . $settings['layout'] . '.php');
      }
      print '</div>';
   }

}

$widgets_manager->register(new GVAElement_Team());
