<?php
	use Give\Helpers\Form\Template;
   use Give\Helpers\Form\Utils as FormUtils;
   
	$form_id = get_the_ID();
	$form = new Give_Donate_Form( $form_id );
	$goal = apply_filters( 'give_goal_amount_target_output', $form->goal, $form_id, $form );
	$goal_option = give_get_meta( $form_id, '_give_goal_option', true );
	$progress = 0;
	$income = apply_filters( 'give_goal_amount_raised_output', $form->get_earnings(), $form_id, $form );
	$income = empty($income) ? 0 : $income;

	if($goal_option == 'disabled' || !$goal_option){
		$goal = 'unlimited';
		$progress = 100;
		$income = give_currency_filter(give_format_amount( $income, array( 'sanitize' => false ) ));
	}

  if($goal == 'unlimited'){
		$progress = 100;
		$progress_label = $togo = esc_html__("Unlimited", 'donatm');
  }else{
		$progress = apply_filters( 'give_goal_amount_funded_percentage_output', round( ( $income / $goal ) * 100, 1 ), $form_id, $form );
		$progress_label = $progress . '%';
		$income = give_currency_filter(give_format_amount( $income, array( 'sanitize' => false ) ));
		$goal = give_currency_filter(give_format_amount( $goal, array( 'sanitize' => false ) ));
		if($progress > 100) $progress = 100;
  }

	$post_category = ''; $separator = ' '; $output = '';
	$item_cats = get_the_terms( get_the_ID(), 'give_forms_category' );
	if(!empty($item_cats) && !is_wp_error($item_cats)){
		foreach((array)$item_cats as $item_cat){
			$output .= '<a href="' . esc_url(get_category_link( $item_cat->term_id )) . '" title="' . esc_attr( sprintf( esc_attr__( "View all campaign in %s", 'donatm' ), $item_cat->name ) ) . '">'.$item_cat->name.'</a>'.$separator;
		}
		$post_category = trim($output, $separator);
	}
	$sale = give_get_meta( $form_id, '_give_form_sales', true );
	$sale = empty($sale) ? '0': $sale;
	$thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'donatm_medium';
	$excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : '30';
	$progress_class = $progress < 10 ? 'percent-small' : 'percent-default';

	// Image Featured
	$activeTemplate = FormUtils::isLegacyForm($form_id) ? 'legacy' : Template::getActiveID($form_id);
	/* @var \Give\Form\Template $formTemplate */
	$formTemplate = Give()->templates->getTemplate($activeTemplate);
	$imageSrc = $formTemplate->getFormFeaturedImage($form_id);
	$image_attr = '';
?> 


<div class="give-one__single">
		<div class="give-one__image">
			<?php 
				if($imageSrc){ 
			  		$image = wp_get_attachment_image(attachment_url_to_postid($imageSrc), $thumbnail, false, $image_attr);
					echo '<a class="link-content" href="'. get_the_permalink() . '">' . $image . '</a>';
				} else {
					echo '<a class="link-content" href="' . get_the_permalink() . '"><img src="' . get_template_directory_uri() . '/images/no-image.jpg' . '"/></a>';
				}
			 ?>

			<a href="<?php echo get_permalink(); ?>" class="give-one__overlay"></a>

			<div class="give-one__categories">
				<?php echo html_entity_decode($post_category) ?>
			</div> 

			<?php get_template_part( 'give/part', 'media' ); ?>

			<div class="give-one__progress <?php echo esc_attr($progress_class)?>">
				<div class="progress">
					<div class="progress-bar" data-progress-animation="<?php echo esc_attr($progress)?>%">
						<span class="percentage"><span></span></span>
					</div>
				</div>
			</div>
		</div>

		<div class="give-one__content">
			<?php if($goal == 'unlimited'){ ?>
				<div class="give-one__information unlimited">
					<div class="give-one__raised"> 
					  <span class="give-one__info-label"><?php echo esc_html__('Raised', 'donatm') ?></span> 
					  <span class="give-one__info-value"><?php echo esc_html($income) ?></span>
					</div>
					<div class="give-one__goal"> 
					  <span class="give-one__info-label"><?php echo esc_html__('Goal', 'donatm') ?></span> 
					  <span class="give-one__info-value"><?php echo esc_html($progress_label) ?></span>
					</div>
				</div>
		  <?php }else{ ?>
				<div class="give-one__information">
					<div class="give-one__raised"> 
					  <span class="give-one__info-label"><?php echo esc_html__('Raised', 'donatm') ?></span> 
					  <span class="give-one__info-value"><?php echo esc_html($income) ?></span>
					</div>
					<div class="give-one__funded">
					  <span class="give-one__pie-label"><?php echo esc_html($progress_label)?></span>
					</div>
					<div class="give-one__goal"> 
					  <span class="give-one__info-label"><?php echo esc_html__('Goal', 'donatm') ?></span> 
					  <span class="give-one__info-value"><?php echo esc_html($goal) ?></span>
					</div>
				</div>
		  <?php } ?>  

			<h2 class="give-one__title"><a href="<?php esc_url(the_permalink()) ?>"><?php the_title() ?></a></h2> 
			
			 <div class="give-one__desc">
				<?php echo donatm_limit_words( $excerpt_words, get_the_excerpt(), get_the_content() ); ?>  
			</div>

			<div class="give-one__button">
				<a class="btn-inline text-theme" href="<?php esc_url(the_permalink()) ?>">
					<?php echo esc_html__('Donate Now', 'donatm') ?>
				</a>
			</div>
		</div>
</div>

		
