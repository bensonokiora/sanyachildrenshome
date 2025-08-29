<?php 
   global $post;

   $thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'post-thumbnail';
   $excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '0';

   $desc = donatm_limit_words($excerpt_words, get_the_excerpt(), '');

   $meta_classes = 'post-five__meta';
   if(empty(get_the_date())){
      $meta_classes = 'post-five__meta schedule-date';
   }
   $content_classes = 'post-five__content';
   $content_classes .= has_post_thumbnail() ? ' has-thumbnail' : ' has-no-thumbnail';
?>

   <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('post post-five__single'); ?>>
      
      <?php if(has_post_thumbnail()){ ?>
         <div class="post-five__thumbnail">
            <a href="<?php echo esc_url( get_permalink() ) ?>">
               <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
            </a>
            <?php if( get_the_date() ){ ?>
               <div class="post-five__entry-date">
                  <span class="day"><?php echo esc_html( get_the_date('d')) ?></span>
                  <span class="month"><?php echo esc_html( get_the_date('M')) ?></span>
               </div>
            <?php } ?>
         </div>   
      <?php } ?>   

      <div class="<?php echo esc_attr($content_classes) ?>">
         <div class="post-five__content-inner">
            <div class="<?php echo esc_attr($meta_classes) ?>">
               <?php
                  if ( in_array( 'category', get_object_taxonomies(get_post_type())) ){
                     echo '<div class="post-five__category"><span class="cat-links"><i class="dicon-tag"></i>' . get_the_category_list( _x( ", ", "Used between list items, there is a space after the comma.", "donatm" ) ) . '</span></div>';
                  }
               ?>
               <?php  if(comments_open()){ ?>
                  <span class="post-five__comment"><i class="dicon-bubble-chat"></i>
                     <?php echo comments_number( esc_html__('0 Comments', 'donatm'), esc_html__('1 Comment', 'donatm'), esc_html__('% Comments', 'donatm') ); ?>
                  </span>
               <?php } ?>
            </div>
            <h3 class="post-five__title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></h3>   
         </div>
      </div>   
   </article>   

  