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

?>

<div class="event-one__single">
	<div class="event-one__wrap">
		<div class="event-one__image">
			<?php echo tribe_event_featured_image( null, $thumbnail ); ?>
			<div class="event-one__schedule-details <?php echo esc_attr( $has_venue_address ); ?>">
				<span class="icon"><i class="far fa-clock"></i></span>
				<?php echo tribe_get_start_date(get_the_ID(), false, 'd M') . ' - ' . tribe_get_start_date(get_the_ID(), false, 'g:i A'); ?>
			</div>
		</div>
		<div class="event-one__content">
			<!-- Event Title -->
			<h3 class="event-one__title">
				<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
					<?php the_title() ?>
				</a>
			</h3>

			<!-- Event Content -->
			<div class="event-one__summary">
				<?php echo donatm_limit_words($excerpt_words, get_the_excerpt(), get_the_content()); ?>
			</div>
			<?php if ( $venue_details ) : ?>
				<!-- Venue Display Info -->
				<span class="event-one__venue-details">
					<span class="icon"><i class="fas fa-map-marker-alt"></i></span>
					<?php
						$address_delimiter = empty( $venue_address ) ? ' ' : ', ';

						// These details are already escaped in various ways earlier in the process.
						echo wp_kses( $venue_details['address'], false);

						if ( tribe_show_google_map_link() ) {
							echo tribe_get_map_link_html();
						}
					?>
				</span> 
			<?php endif; ?>
			<div class="event-one__action">
				<a class="btn-inline" href="<?php echo esc_url( tribe_get_event_link() ); ?>"><span><?php echo esc_html__('Event Details', 'donatm') ?></span></a>
			</div>
		</div>
	</div>
</div>