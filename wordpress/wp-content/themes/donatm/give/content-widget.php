<?php
  $form_id = get_the_ID();
  $form = new Give_Donate_Form( $form_id );
  $goal_progress_stats = give_goal_progress_stats( $form );
  $income = $goal_progress_stats['raw_actual'];
  $goal   = $goal_progress_stats['raw_goal'];

  $form_currency = apply_filters( 'give_goal_form_currency', give_get_currency( $form_id ), $form_id );
  $income_format_args = apply_filters( 'give_goal_income_format_args', array(
    'sanitize' => false,
    'currency' => $form_currency,
    'decimal'  => false,
  ), $form_id );
        
  $goal_format_args = apply_filters( 'give_goal_amount_format_args', array(
    'sanitize' => false,
    'currency' => $form_currency,
    'decimal'  => false,
  ), $form_id );

  $income = give_human_format_large_amount( give_format_amount( $income, $income_format_args ), array( 'currency' => $form_currency ) );
  $goal   = give_human_format_large_amount( give_format_amount( $goal, $goal_format_args ), array( 'currency' => $form_currency ) );

  $goal_option = give_get_meta( $form_id, '_give_goal_option', true );
  
  if($goal_option == 'disabled' || !$goal_option){
    $goal = 'unlimited';
    $progress = 100;
    $income = give_currency_filter(give_format_amount( $income, array( 'sanitize' => false ) ));
  }
  if($goal == 'unlimited'){
    $progress_label = esc_html__( 'unlimited' , 'donatm' );
    $progress = 100;
  }else{
    $progress = apply_filters( 'give_goal_amount_funded_percentage_output', round( ( $income / $goal ) * 100, 1 ), $form_id, $form );
    $progress_label = $progress . '%';
    
  }
  if(!isset($excerpt_words)){
    $excerpt_words = donatm_get_option('give_excerpt_limit', 10);
  }
?> 
<div  class="give-block">
  <div <?php post_class(); ?>>
    <div class="form-image">
      <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php esc_url(the_permalink()) ?>"><?php the_post_thumbnail( 'medium' ); ?></a>
      <?php } else { ?>
       <a href="<?php esc_url(the_permalink()) ?>"><img src="<?php echo esc_url(get_template_directory_uri() . '/images/no-image.jpg'); ?>" alt="<?php echo the_title_attribute() ?>"/></a>
      <?php } ?>
      <div class="content-action"><a class="link" href="<?php esc_url(the_permalink()) ?>"><?php echo esc_html__( 'Donation now', 'donatm' ) ?></a></div>
      <?php get_template_part( 'give/part', 'gallery' ); ?>
      <?php get_template_part( 'give/part', 'video' ); ?>
    </div>

    <div class="form-content">
      
      <div class="funded">
        <div class="give__progress">
          <div class="give__progress-bar" data-progress-max="<?php echo esc_attr($progress)?>%">
            <?php if($progress > 75){ ?>
              <span class="percentage percentage-left"><?php echo esc_html($progress_label); ?></span>
            <?php }else{ ?>
              <span class="percentage"><?php echo esc_html($progress_label); ?></span>
            <?php } ?>  
          </div>
        </div>
      </div>

      <div class="form-content-inner clearfix">
        <div class="campaign-content-inner">
          <h2 class="title"><a href="<?php esc_url(the_permalink()) ?>"><?php the_title() ?></a></h2>
          <div class="desc"><?php echo donatm_limit_words( $excerpt_words, get_the_excerpt(), get_the_content() ); ?></div>
        </div>
        <div class="campaign-information clearfix">
          <div class="campaign-goal"> 
            <span class="c-label"><?php echo esc_html__('Goal: ', 'donatm') ?></span> 
            <span class="goal"><?php echo esc_html($goal) ?></span>
          </div>
          <div class="campaign-raised">
            <span class="c-label"><?php echo esc_html__('Raised: ', 'donatm') ?></span> 
            <span class="raised"><?php echo esc_html($income) ?></span>
          </div>
        </div>
        <div class="campaign-action"><a class="btn-give-theme" href="<?php esc_url(the_permalink()) ?>"><?php echo esc_html__('Read more', 'donatm') ?></a></div>
      </div>  
      
    </div>
  </div>
</div>

      
