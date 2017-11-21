<?php
/**
 * Events Higlighted Information
 *
 * @package Aerospace
 */

?>

<div class="entry-higlights">
	<?php aerospace_event_dates( $post->ID ); ?>
	<?php aerospace_event_time( $post->ID ); ?>
	<?php aerospace_event_address( $post->ID ); ?>
	<?php aerospace_event_google_map( $post->ID ); ?>
</div>