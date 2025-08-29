<?php 
   global $post;

   $thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'post-thumbnail';
   $excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '0';

   $desc = donatm_limit_words($excerpt_words, get_the_excerpt(), '');

   $meta_classes = 'post-one__meta';
   if(empty(get_the_date())){
      $meta_classes = 'post-one__meta schedule-date';
   }
   $author_name = get_the_author_meta( 'display_name', $post->post_author );
   $content_classes = 'post-one__content';
   $content_classes .= has_post_thumbnail() ? ' has-thumbnail' : ' has-no-thumbnail';
?>

   <article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('post post-one__single'); ?>>
      
      <?php if(has_post_thumbnail()){ ?>
         <div class="post-one__thumbnail">
            <a href="<?php echo esc_url( get_permalink() ) ?>">
               <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
            </a>
         </div>   
      <?php } ?>   

      <div class="<?php echo esc_attr($content_classes) ?>">
         <div class="post-one__content-inner">
            <?php if( get_the_date() ){ ?>
               <div class="post-one__entry-date">
                  <span class="day"><?php echo esc_html( get_the_date('d')) ?></span>
                  <span class="month"><?php echo esc_html( get_the_date('M')) ?></span>
               </div>
            <?php } ?>
            <div class="<?php echo esc_attr($meta_classes) ?>">
               <?php donatm_posted_on(); ?>
            </div>
         </div>
         <h3 class="post-one__title"><a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php the_title() ?></a></h3>
         <div class="post-one__read-more">
            <a href="<?php echo esc_url( get_permalink() ) ?>" aria-label="link">
               <?php echo esc_html__( 'Read More', 'donatm') ?><i class="dicon-right-arrow-1"></i></a>
         </div>
      </div>   
   </article>   

  