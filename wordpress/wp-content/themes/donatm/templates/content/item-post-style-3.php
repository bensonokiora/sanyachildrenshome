<?php 
   global $post;

   $thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'post-thumbnail';
   $excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '0';

   $desc = donatm_limit_words($excerpt_words, get_the_excerpt(), '');

   $meta_classes = 'post-three__meta';
   if(empty(get_the_date())){
      $meta_classes = 'post-three__meta schedule-date';
   }
   $content_classes = 'post-three__content';
   $content_classes .= has_post_thumbnail() ? ' has-thumbnail' : ' has-no-thumbnail';
?>

   <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('post post-three__single'); ?>>
      
      <?php if(has_post_thumbnail()){ ?>
         <div class="post-three__thumbnail">
            <a href="<?php echo esc_url( get_permalink() ) ?>">
               <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
            </a>
            
         </div>   
      <?php } ?>   

      <div class="<?php echo esc_attr($content_classes) ?>">
         <div class="post-three__content-inner">
            <div class="<?php echo esc_attr($meta_classes) ?>">
               <?php
                  if ( in_array( 'category', get_object_taxonomies(get_post_type())) ){
                     echo '<div class="post-three__category"><span class="cat-links">' . get_the_category_list( _x( ", ", "Used between list items, there is a space after the comma.", "donatm" ) ) . '</span></div>';
                  }
               ?>
               <?php if( get_the_date() ){ ?>
                  <div class="post-three__entry-date">
                     <?php echo esc_html( get_the_date('d M y')) ?>
                  </div>
               <?php } ?>
            </div>
            <h3 class="post-three__title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></h3>

            <div class="post-three__footer">
               <div class="post-three__avatar">
                  <?php
                  echo '<div class="left">';
                     echo get_avatar( get_the_author_meta( 'ID' ), 160 ); 
                  echo '</div>';
                  echo '<div class="right">';
                     echo( '<span class="author">' . esc_html__('By', 'donatm') . '</span>');
                     echo( '<span class="author-name">' . get_the_author() . '</span>'); 
                  echo '</div>';
                  ?>
               </div>
               <div class="post-three__read-more">
                  <a href="<?php echo esc_url( get_permalink() ) ?>" aria-label="link">
                  <?php echo esc_html__( 'Read More', 'donatm') ?></a>
               </div>
            </div>   

         </div>
      </div>   
   </article>   

  