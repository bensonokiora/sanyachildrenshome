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

<div class="event-three__single">
	
	<div class="event-three__wrap">
		<div class="event-three__image">
			<?php echo tribe_event_featured_image( null, $thumbnail ); ?>
		</div>
		<div class="event-three__content">
			<div class="event-three__content-inner">
				
				<div class="event-three__schedule-details <?php echo esc_attr( $has_venue_address ); ?>">
					<div class="date">
						<span class="icon"><i class="dicon-calendar"></i></span>
						<?php echo tribe_get_start_date(get_the_ID(), false, 'd M y'); ?>
					</div>
					<div class="time">
						<span class="icon"><i class="dicon-clock"></i></span>
						<?php echo tribe_get_start_date(get_the_ID(), false, 'g:i A') . ' - ' . tribe_get_end_date(get_the_ID(), false, 'g:i A'); ?>
					</div>
				</div>

				<h3 class="event-three__title event-title">
					<a href="<?php echo esc_url( tribe_get_event_link() )  ?>">
						<?php the_title() ?>
					</a>
				</h3>

				<div class="event-three__summary">
					<?php echo donatm_limit_words($excerpt_words, get_the_excerpt(), get_the_content()); ?>
				</div>

				<?php if ( $venue_details ) : ?>
					<!-- Venue Display Info -->
					<div class="event-three__venue-details">
						<div class="venue-text"><?php echo esc_html__('Venue', 'donatm') ?></div>
						<?php
							$address_delimiter = empty( $venue_address ) ? ' ' : ', ';

							// These details are already escaped in various ways earlier in the process.
							echo wp_kses( $venue_details['address'], false);

							if ( tribe_show_google_map_link() ) {
								echo tribe_get_map_link_html();
							}
						?>
					</div> 
				<?php endif; ?>
			</div>

			<div class="event-three__right">
				<div class="event-three__action">
					<a class="btn-theme" href="<?php echo esc_url( tribe_get_event_link() ); ?>"><span><?php echo esc_html__('Event Details', 'donatm') ?></span></a>
				</div>
			</div>
		</div>
	</div>
	<a class="event-three__link-overlay" href="<?php echo esc_url( tribe_get_event_link() ); ?>"></a>

</div>