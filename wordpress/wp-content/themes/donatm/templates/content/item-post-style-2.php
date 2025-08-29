<?php 
   $thumbnail = isset($thumbnail_size) && $thumbnail_size ? $thumbnail_size : 'post-thumbnail';
?>

<article id="post-<?php echo esc_attr(get_the_ID()); ?>" <?php post_class('post post-two__single'); ?>>
   <div class="post-two__wrap">
      <?php if(has_post_thumbnail()){ ?>
         <div class="post-two__thumbnail">
            <a href="<?php echo esc_url( get_permalink() ) ?>">
               <?php the_post_thumbnail( $thumbnail, array( 'alt' => get_the_title() ) ); ?>
            </a>
            <?php if( get_the_date() ){ ?>
               <div class="post-two__entry-date">
                  <span class="day"><?php echo esc_html( get_the_date('d')) ?></span>
                  <span class="month"><?php echo esc_html( get_the_date('M')) ?></span>
               </div>
            <?php } ?>
         </div>   
      <?php } ?>   
      <div class="post-two__content">
         <div class="content-inner">
            <div class="post-two__meta">
               <?php
                  if ( in_array( 'category', get_object_taxonomies(get_post_type())) ){
                     echo '<div class="post-two__category"><span class="cat-links"><i class="dicon-tag"></i>' . get_the_category_list( _x( ", ", "Used between list items, there is a space after the comma.", "donatm" ) ) . '</span></div>';
                  }
               ?>
               <?php  if(comments_open()){ ?>
                  <span class="post-two__comment"><i class="dicon-bubble-chat"></i>
                     <?php echo comments_number( esc_html__('0 Comments', 'donatm'), esc_html__('1 Comment', 'donatm'), esc_html__('% Comments', 'donatm') ); ?>
                  </span>
               <?php } ?>
            </div>
             
            <h2 class="post-two__title">
               <a href="<?php echo esc_url( get_permalink() ) ?>"><?php the_title() ?></a>
            </h2>
            <div class="post-two__avatar">
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
         </div>
      </div>
   </div>
   <a href="<?php echo esc_url( get_permalink() ) ?>" class="link-overlay" aria-label="link"></a>
</article>   

  