<?php
/**
 * Events Higlighted Information
 *
 * @package Aerospace
 */

?>

<div class="entry-higlights">
	<?php
	if ( aerospace_event_is_past( $post->ID ) == false ) {
		aerospace_event_register( $post->ID );
	}
	?>
	<?php aerospace_event_dates( $post->ID ); ?>
	<?php aerospace_event_time( $post->ID ); ?>
	<?php aerospace_event_address( $post->ID ); ?>
	<?php aerospace_event_google_map( $post->ID ); ?>
</div>