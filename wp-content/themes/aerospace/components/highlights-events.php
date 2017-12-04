<?php
/**
 * Events Higlighted Information
 *
 * @package Aerospace
 */

?>

<div class="entry-highlights">
	<?php
	if ( aerospace_event_is_past( $post->ID ) == false ) {
		aerospace_event_register( $post->ID );
	}
	?>
	<div class="entry-highlights-title">
		<i class="icon-arrow-right"></i> 
		<?php esc_html_e( 'Event Details', 'aerospace' ); ?>
	</div>
	<div class="entry-highlights-content">
		<?php aerospace_event_dates( $post->ID ); ?>
		<?php aerospace_event_time( $post->ID ); ?>
		<?php aerospace_event_address( $post->ID, true ); ?>
	</div>
</div>