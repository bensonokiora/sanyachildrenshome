<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.19
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$excerpt_words = 20;

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

$thumbnail = (isset($thumbnail_size) && $thumbnail_size) ? $thumbnail_size : 'post-thumbnail';

$item_cats = get_the_terms(get_the_ID(), 'tribe_events_cat');
$post_category = ''; $separator = ', '; $output = '';
if(!empty($item_cats) && !is_wp_error($item_cats)){
   foreach((array)$item_cats as $item_cat){
      $output .= $item_cat->name . $separator;
   }
   $post_category = trim($output, $separator);
}

?>

<div class="event-four__single">
	<div class="event-four__wrap">
		<div class="event-four__content">
			<div class="event-four__content-inner">
				<div class="event-four__time">
					<span class="icon"><i class="far fa-clock"></i></span>
					<?php echo tribe_get_start_date(get_the_ID(), false, 'd M') . ' - ' . tribe_get_start_date(get_the_ID(), false, 'g:i A'); ?>
				</div>
				<h3 class="event-four__title event-title">
					<a href="<?php echo esc_url( tribe_get_event_link() )  ?>">
						<?php the_title() ?>
					</a>
				</h3>
				<div class="event-four__summary">
					<?php echo donatm_limit_words($excerpt_words, get_the_excerpt(), get_the_content()); ?>
				</div>
				<div class="event-four__action">
					<a class="btn-theme" href="<?php echo esc_url( tribe_get_event_link() ); ?>"><span><?php echo esc_html__('Event Details', 'donatm') ?></span></a>
				</div>
				<div class="event-four__organizer">
					<span>
						<?php 
							if($post_category){
								echo wp_kses($post_category, true);
							}
						?>
					</span>
				</div>
			</div>
		</div>
		<div class="event-four__image">
			<?php echo tribe_event_featured_image( null, $thumbnail ); ?>
			<div class="event-four__date">
				<?php echo tribe_get_start_date(get_the_ID(), false, 'd M'); ?>
			</div>
		</div>
	</div>
	<a class="event-four__link-overlay" href="<?php echo esc_url( tribe_get_event_link() ); ?>"></a>

</div>