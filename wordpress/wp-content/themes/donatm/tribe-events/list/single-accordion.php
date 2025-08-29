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

<?php
   echo '<div class="event-accordion__bg">';
   	if( has_post_thumbnail() ){
   		the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
   	}
   	echo '<h4 class="event-accordion__bg-title">';
			the_title();
		echo '</h4>';
		echo '<span class="event-accordion__arrow"><i class="fas fa-angle-double-right"></i></span>';
		echo '<a class="overlay-control" href="#"></a>';
   echo '</div>';
?>

<div class="event-accordion">
	<div class="event-accordion__main">
   	
   	<div class="event-accordion__image">
   		<?php echo tribe_event_featured_image( null, $thumbnail ); ?>
   		<div class="event-accordion__schedule">
				<span class="icon"><i class="far fa-clock"></i></span>
				<?php echo tribe_get_start_date(get_the_ID(), false, 'd F') . ' - ' . tribe_get_start_date(get_the_ID(), false, 'g:i A'); ?>
			</div>
  		</div>

		<div class="event-accordion__right">
			<div class="event-accordion__right-content">
	         <?php 
					echo '<h4 class="event-accordion__title">';
						echo '<a href="' . esc_url( tribe_get_event_link() ) . '">';
							the_title();
						echo '</a>';
					echo '</h4>';

					echo '<div class="event-accordion__desc">';
						echo donatm_limit_words($excerpt_words, get_the_excerpt(), get_the_content());
					echo '</div>';
				?>	

				<?php if ( $venue_details ) : ?>
					<!-- Venue Display Info -->
					<div class="event-accordion__venue">
						<div class="text"><?php echo esc_html__('Venue', 'donatm') ?></div>
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

				<div class="event-accordion__action">
					<a class="btn-theme" href="<?php echo esc_url( tribe_get_event_link() ) ?>">
						<?php echo esc_html__('Event Details', 'donatm') ?>
					</a>
				</div>
			</div>	
		</div>

	</div>
</div>