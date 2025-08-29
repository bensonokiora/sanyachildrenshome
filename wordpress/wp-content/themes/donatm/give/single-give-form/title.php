<?php
/**
 * Single Give Form Title
 * 
 * Displays the main title for the single donation form - Override this template by copying it to yourtheme/give/single-give-form/title.php
 * 
 * @package     Give/Templates
 * @since       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
} ?>
<h1 itemprop="name" class="give-form-title entry-title"><?php the_title(); ?></h1>
