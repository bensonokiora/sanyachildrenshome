<?php 
   global $post;

   $thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'post-thumbnail';
   $excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '0';

   $desc = donatm_limit_words($excerpt_words, get_the_excerpt(), '');

   $meta_classes = 'post-four__meta';
   if(empty(get_the_date())){
      $meta_classes = 'post-four__meta schedule-date';
   }
   $content_classes = 'post-four__content';
   $content_classes .= has_post_thumbnail() ? ' has-thumbnail' : ' has-no-thumbnail';
?>

   <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('post post-four__single'); ?>>
      
      <?php if(has_post_thumbnail()){ ?>
         <div class="post-four__thumbnail">
            <a href="<?php echo esc_url( get_permalink() ) ?>">
               <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
            </a>
            <?php if( get_the_date() ){ ?>
               <div class="post-four__entry-date">
                  <span class="day"><?php echo esc_html( get_the_date('d')) ?></span>
                  <span class="month"><?php echo esc_html( get_the_date('M')) ?></span>
               </div>
            <?php } ?>
         </div>   
      <?php } ?>   

      <div class="<?php echo esc_attr($content_classes) ?>">
         <div class="post-four__content-inner">
            <div class="<?php echo esc_attr($meta_classes) ?>">
               <?php
                  echo '<div class="post-four__author">';
                     echo( '<span class="author"><i class="dicon-user"></i>' . esc_html__('By ', 'donatm') . '</span>');
                     echo( '<span class="author-name">' . get_the_author() . '</span>'); 
                  echo '</div>';
                  if ( in_array( 'category', get_object_taxonomies(get_post_type())) ){
                     echo '<div class="post-four__category"><span class="cat-links"><i class="dicon-tag"></i>' . get_the_category_list( _x( ", ", "Used between list items, there is a space after the comma.", "donatm" ) ) . '</span></div>';
                  }
               ?>
            </div>
            <h3 class="post-four__title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></h3>

            <div class="post-four__read-more">
               <a href="<?php echo esc_url( get_permalink() ) ?>" aria-label="link">
               <span class="btn-text"><?php echo esc_html__( 'Read More', 'donatm') ?></span><i class="dicon-right-arrow-1"></i></a>
            </div>   
         </div>
      </div>   
   </article>   

  