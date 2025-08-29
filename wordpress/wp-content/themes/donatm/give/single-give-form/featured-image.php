<?php
/**
 * Single Form Featured Image
 *
 * Displays the featured image for the single donation form - Override this template by copying it to yourtheme/give/single-give-form/featured-image.php
 * 
 * @package       Give/Templates
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$form_id = get_the_ID();
$form = new Give_Donate_Form( $form_id );
$progress_stats = give_goal_progress_stats($form);
$income = 0;
$goal = '';

$goal_option = give_get_meta( $form_id, '_give_goal_option', true );
if($goal_option == 'disabled' || !$goal_option){
	$goal = 'unlimited';
	$progress = 100;
	$income = isset($progress_stats['actual']) ? $progress_stats['actual'] : 0;
}

if($goal == 'unlimited'){
	$progress_label = esc_html__( 'unlimited' , 'donatm' );
	$progress = 100;
}else{
	$progress = isset($progress_stats['progress']) ? $progress_stats['progress'] : 100;
	$progress_label = $progress . '%';
	$income = isset($progress_stats['actual']) ? $progress_stats['actual'] : 0;
	$goal = isset($progress_stats['goal']) ? $progress_stats['goal'] : 0;
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

/**
 * Fires in single form template, before the form featured image.
 *
 * Allows you to add elements before the image.
 *
 * @since 1.0
 */
do_action( 'give_pre_featured_thumbnail' );
?>

<div class="give-images-content">
	<div class="give-image-featured">
		<?php 
		  if ( has_post_thumbnail() ) {
				$image  = get_the_post_thumbnail( $post->ID, 'full' );
				echo apply_filters( 'single_give_form_image_html', $image );
			} 
		?>
		<div class="give-form-category"><?php echo html_entity_decode($post_category) ?></div>
	</div>	
	<div class="give-progress-information">
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
		<div class="campaign-information clearfix">
			<div class="campaign-goal"> 
				<span class="value"><?php echo esc_html($goal) ?></span>
				<span class="label"><?php echo esc_html__('Goal', 'donatm') ?></span> 
			</div>
			<div class="campaign-raised">
				<span class="value"><?php echo esc_html($income) ?></span>
				<span class="label"><?php echo esc_html__('Raised', 'donatm') ?></span> 
			</div>
		</div>
	</div>   
</div>

<?php
/**
 * Fires in single form template, after the form featured image.
 *
 * Allows you to add elements after the image.
 *
 * @since 1.0
 */
do_action( 'give_post_featured_thumbnail' );
?>
