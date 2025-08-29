<?php
   if(!defined('ABSPATH')){ exit; }
   use Elementor\Icons_Manager;
   use Give\Campaigns\Actions\RenderDonateButton;
   use Give\Campaigns\Models\Campaign;
   use Give\Campaigns\Repositories\CampaignRepository;

   $classes = array();
   $classes[] = 'simple-slider swiper-slider-simple ' . $settings['style'];
   $this->add_render_attribute('wrapper', 'class', $classes);

   $carousel_options = array(
      'space_between'       => isset($settings['space_between']) ? intval($settings['space_between']) : 20,
      'loop'                => $settings['ca_loop'] === 'yes' ? 1 : 0,
      'speed'               => $settings['ca_speed'],
      'autoplay'            => $settings['ca_autoplay'] === 'yes' ? 1 : 0,
      'autoplay_delay'      => $settings['ca_autoplay_delay'],
      'autoplay_hover'      => $settings['ca_autoplay_hover'] === 'yes' ? 1 : 0,
      'navigation'          => $settings['ca_navigation'] === 'yes' ? 1 : 0,
      'pagination'          => $settings['ca_pagination'] === 'yes' ? 1 : 0
   );
   $carousel_params = htmlspecialchars(json_encode($carousel_options));

?>

<div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
   <div class="swiper-content-inner">
      <div class="init-slider-simple swiper" data-carousel="<?php echo $carousel_params ?>">
         <div class="swiper-wrapper">
            <?php foreach ($settings['carousel_content'] as $item){ ?>
               <div class="swiper-slide item-wrap-<?php echo $item['style'] ?>">
                  <div class="slider-item-content slide-<?php echo $item['style'] ?>">
                        
                        <?php if($item['image']['url']){ ?>
                           <div class="slider-image">
                              <img data-swiper-parallax="1200" src="<?php echo esc_url($item['image']['url']) ?>" alt="<?php echo esc_html($item['title']) ?>"/>
                              <div class="slider-image-overlay"></div>
                           </div>
                        <?php } ?>

                        <?php 
                           $classes = '';
                           if(!empty($item['video'])){
                              $classes = ' has-video';
                           }
                        ?>
                        <div class="slider-content">
                           <div class="slider-content-width<?php echo $classes ?>">
                              <?php 
                                 if($item['video']){
                                    echo '<div class="layer-wrap slider-video">';
                                       echo '<div class="layer-inner">';
                                          echo '<a class="popup-video" href="' . $item['video'] . '" data-animation="fadeInRight" data-delay="1200ms" data-duration="800ms"><i class="fas fa-play"></i></a>';
                                       echo '</div>';
                                    echo '</div>';
                                 } 

                                 if($item['sub_title']){
                                    echo '<div class="layer-wrap sub-title">';
                                       echo '<div class="layer-inner">';
                                          echo '<div class="slider-caption" data-animation="fadeInUp" data-delay="1000ms" data-duration="1000ms">';
                                             echo $item['sub_title'];
                                          echo '</div>';
                                       echo '</div>';
                                    echo '</div>';
                                 }
                                 if($item['title']){ 
                                    echo '<div class="layer-wrap title">';
                                       echo '<div class="layer-inner">';
                                          echo '<div class="slider-caption" data-animation="fadeInUp" data-delay="1200ms" data-duration="1000ms">';
                                             echo $item['title'];
                                          echo '</div>';
                                       echo '</div>';
                                    echo '</div>';
                                 }
                                 if($item['desc']){ 
                                    echo '<div class="layer-wrap desc">';
                                       echo '<div class="layer-inner">';
                                          echo '<div class="slider-caption" data-animation="fadeInUp" data-delay="1400ms" data-duration="1000ms">';
                                             echo $item['desc'];
                                          echo '</div>';
                                       echo '</div>';
                                    echo '</div>';
                                 }

                                 if($item['btn_donate_id'] || $item['btn_link']['url'] || $item['btn_link_2']['url']){
                                    echo '<div class="layer-wrap slider-action">';
                                       echo '<div class="layer-inner">';
                                          
                                          if($item['btn_donate_id']){
                                             echo '<div class="action-donate" data-animation="fadeInUp" data-delay="1200ms" data-duration="1000ms">';
                                                $campaign = give(CampaignRepository::class)->getById($item['btn_donate_id']);
                                                echo give(RenderDonateButton::class)($campaign->defaultFormId, $item['btn_donate_title']);  
                                             echo '</div>';
                                          }

                                          if($item['btn_link']['url']){
                                             $_rand = wp_rand();
                                             $this->add_link_attributes('link_' . $_rand, $item['btn_link']);
                                             echo '<a class="slider-caption btn-slider-1 btn-theme" data-animation="fadeInUp" data-delay="1400ms" data-duration="1000ms" ' . $this->get_render_attribute_string( 'link_' . $_rand ) . '><span>';
                                                echo $item['btn_title'];
                                             echo '</span></a>';
                                          }

                                          if($item['btn_link_2']['url']){
                                             $_rand = wp_rand();
                                             $this->add_link_attributes('link_2_' . $_rand, $item['btn_link_2']);
                                             echo '<a class="slider-caption btn-slider-2" data-animation="fadeInUp" data-delay="1800ms" data-duration="1000ms" ' . $this->get_render_attribute_string( 'link_2_' . $_rand ) . '><span>';
                                                echo $item['btn_title_2'];
                                             echo '</span></a>';
                                          }

                                       echo '</div>';
                                    echo '</div>';
                                 }
                              ?>
                           </div>
                        </div> 
                        <div class="slider-overlay"></div>
                        <div data-animation="fadeInDown" data-delay="1200ms" data-duration="1000ms" class="slider-overlay-1"></div>
                        <div data-animation="fadeInUp" data-delay="1400ms" data-duration="1000ms" class="slider-overlay-2"></div>
                  </div>
               </div>
            <?php } ?>
         </div>
         <div class="simple-slider-preloader"></div>
      </div>
   </div>   
   <div class="slider-meta">
      <?php echo ($settings['ca_pagination'] ? '<div class="swiper-pagination"></div>' : '' ); ?>
      <?php echo ($settings['ca_navigation'] ? '<div class="swiper-nav-next"></div><div class="swiper-nav-prev"></div>' : '' ); ?>
   </div>
</div>
