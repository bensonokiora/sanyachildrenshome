<div class="post post-block-small">      
   <div class="post-content">
      <div class="post-thumbnail">
         <a class="link-image-content" href="<?php the_permalink(); ?>">
            <?php if ( has_post_thumbnail()) {
               the_post_thumbnail('thumbnail');
            }?>
         </a>
      </div>
      <div class="content-inner">
         <?php if( get_the_date() ){ ?>
            <span class="entry-date">
               <i class="far fa-calendar-alt"></i>
               <?php echo esc_html( get_the_date('d M y')) ?>
            </span>
         <?php } ?>
         <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3> 
      </div>    
   </div>   
</div>

  