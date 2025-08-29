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
<div class="event-two__single">
	
	<div class="event-two__wrap">
		<div class="event-two__image hidden">
			<?php echo tribe_event_featured_image( null, $thumbnail ); ?>
		</div>
		<div class="event-two__content">
			<div class="event-two__schedule-details <?php echo esc_attr( $has_venue_address ); ?>">
				<div class="time">
					<span class="icon"><i class="far fa-clock"></i></span>
					<?php echo tribe_get_start_date(get_the_ID(), false, 'g:i A') . ' - ' . tribe_get_end_date(get_the_ID(), false, 'g:i A'); ?>
				</div>
				<div class="date">
					<?php echo tribe_get_start_date(get_the_ID(), false, 'd M'); ?>
				</div>
			</div>
			<div class="event-two__content-inner">
				<h3 class="event-two__title event-title">
					<a href="<?php echo esc_url( tribe_get_event_link() )  ?>">
						<?php the_title() ?>
					</a>
				</h3>
				<div class="event-two__summary">
					<?php echo donatm_limit_words($excerpt_words, get_the_excerpt(), get_the_content()); ?>
				</div>
				<div class="event-two__bottom">
					<div class="event-two__organizer">
						<div class="text"><?php echo esc_html__('Organizer', 'donatm') ?></div>
						<?php
						$organizer_id = tribe_get_organizer_id(); 
						if ( $organizer_id ) {
						    echo tribe_get_organizer( $organizer_id ); 
						}
						?>
					</div>
					<?php if ( $venue_details ) : ?>
						<!-- Venue Display Info -->
						<div class="event-two__venue-details">
							<div class="text">
								<i class="fa-solid fa-location-dot"></i>
								<?php echo esc_html__('Venue', 'donatm') ?>
								<?php 
									if ( tribe_show_google_map_link() ) {
										echo tribe_get_map_link_html();
									}
								?>
							</div>
							<?php
								$address_delimiter = empty( $venue_address ) ? ' ' : ', ';
								// These details are already escaped in various ways earlier in the process.
								echo wp_kses( $venue_details['address'], false);
							?>
						</div> 
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<a class="event-two__link-overlay" href="<?php echo esc_url( tribe_get_event_link() ); ?>"></a>

</div>
