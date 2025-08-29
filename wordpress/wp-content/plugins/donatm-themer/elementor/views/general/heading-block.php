<?php
   use Give\Campaigns\Actions\RenderDonateButton;
   use Give\Campaigns\Models\Campaign;
   use Give\Campaigns\Repositories\CampaignRepository;

   $title_text = $settings['title_text'];
   $sub_title = $settings['sub_title'];
   $description_text = $settings['description_text'];
   $button_style = $settings['button_style'] ? $settings['button_style'] : 'btn-line-white';
   $button_size = $settings['button_size'] ? $settings['button_size'] : '';
   $auto_responisve = $settings['auto_responsive'] == 'yes' ? 'auto-responsive' : '';
   $style = $settings['style'];
   $this->add_render_attribute( 'block', 'class', [ 'align-' . $settings['align'], $settings['style'], 'widget gsc-heading', 'box-align-' . $settings['box_align'], $auto_responisve ]  );
   $header_tag = $settings['header_tag'];

   $this->add_render_attribute( 'title_text', 'class', 'title' );
   $this->add_render_attribute( 'description_text', 'class', 'title-desc' );
   $this->add_render_attribute( 'sub_title', 'class', ['sub-title'] );

   $this->add_inline_editing_attributes( 'title_text', 'none' );

   $this->add_inline_editing_attributes( 'description_text' );
   $btn_classes = "btn-cta {$button_style} {$button_size}";
?>

<?php if($style == 'style-large'){ ?>

   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      
      <div class="content-inner">
         <?php 
            if($sub_title){
               echo '<div ' . $this->get_render_attribute_string( 'sub_title' ) . '>';
                  echo '<span class="tagline">' .  esc_html($sub_title) . '</span>'; 
               echo '</div>';
            } 
         ?>  
         
         <?php if($title_text){ ?>
            <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
               <span><?php echo $settings['title_text'] ?></span>
            </<?php echo esc_attr($header_tag) ?>>
         <?php } ?>
         
         <?php 
            if( $description_text && !empty(trim($description_text)) ){ 
               echo '<div ' . $this->get_render_attribute_string( 'description_text' ) . '>';
                  echo wp_kses($description_text, true);
               echo '</div>';
            } 
         ?>

         <div class="heading-action">
           <?php 
               if($settings['button_url']['url']){
                  $this->gva_render_button($btn_classes); 
               } 
            ?>
            <?php if($settings['video'] == 'yes' && $settings['video_url']){ ?>
               <a class="video-link popup-video" href="<?php echo esc_url($settings['video_url']) ?>">
                  <i class="fa fa-play"></i>
                  <span class="arrow"></span>
               </a>
            <?php } ?>
            <?php 
               if($settings['button_donate_id'] && class_exists('Give')){ 
                  echo '<div class="style_' . $settings['button_donate_style'] . '">';
                     $campaign_id = $settings['button_donate_id'];
                     $campaign = give(CampaignRepository::class)->getById($campaign_id);
                     $defaultFormId = isset($campaign->defaultFormId) ? $campaign->defaultFormId : false;
                     if($defaultFormId){
                        echo give(RenderDonateButton::class)($campaign->defaultFormId,  $settings['button_donate_label']);  
                     }else{
                        echo '<a class="btn-theme">The Campaign not exist!</a>';
                     }
                  echo '</div>';
               }
            ?>
         </div>

      </div>
   </div>

<?php } ?>

<?php if($style == 'style-1' || $style == 'style-2' || $style == 'style-3' || $style == 'style-4'){ ?>
   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      
      <div class="content-inner">
         <?php if($settings['video'] == 'yes' && $settings['video_url']){ ?>
            <div class="heading-video">
               <a class="video-link popup-video" href="<?php echo esc_url($settings['video_url']) ?>">
                  <i class="fa fa-play"></i>
                  <span class="arrow"></span>
               </a>
            </div>
         <?php } ?>
         
         <?php 
            if($sub_title){
               echo '<div ' . $this->get_render_attribute_string( 'sub_title' ) . '>';
                  echo '<span class="tagline">' .  esc_html($sub_title) . '</span>'; 
               echo '</div>';
            } 
         ?>  
         
         <?php if($title_text){ ?>
            <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
               <span><?php echo $settings['title_text'] ?></span>
            </<?php echo esc_attr($header_tag) ?>>
         <?php } ?>
         
         <?php 
            if( $description_text && !empty(trim($description_text)) ){ 
               echo '<div ' . $this->get_render_attribute_string( 'description_text' ) . '>';
                  echo wp_kses($description_text, true);
               echo '</div>';
            } 
         ?>

         <?php
            if($settings['button_url']['url'] || $settings['button_donate_id']){ 
               echo '<div class="heading-action">';
                  if($settings['button_url']['url']){
                     $this->gva_render_button($btn_classes); 
                  } 
                  if($settings['button_donate_id'] && class_exists('Give')){ 
                     echo '<div class="style_' . $settings['button_donate_style'] . '">';
                        $campaign_id = $settings['button_donate_id'];
                        $campaign = give(CampaignRepository::class)->getById($campaign_id);
                        $defaultFormId = isset($campaign->defaultFormId) ? $campaign->defaultFormId : false;
                        if($defaultFormId){
                           echo give(RenderDonateButton::class)($campaign->defaultFormId,  $settings['button_donate_label']);  
                        }else{
                           echo '<a class="btn-theme">The Campaign not exist!</a>';
                        }
                     echo '</div>';
                  }
               echo '</div>';
            }
         ?>
      </div>

   </div>
<?php } ?>

