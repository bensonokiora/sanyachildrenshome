<?php
/**
 * Single Give Form Sidebar
 *
 * Adds a dynamic sidebar to single Give Forms (singular post type for give_forms) - Override this template by copying it to yourtheme/give/single-give-form/sidebar.php
 * 
 * @package     Give/Templates
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( is_active_sidebar( 'give-forms-sidebar' ) ) {
	dynamic_sidebar( 'give-forms-sidebar' );
}