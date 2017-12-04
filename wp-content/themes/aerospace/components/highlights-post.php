<?php
/**
 * Post Highlights
 *
 * @package Aerospace
 */

$highlights = get_post_meta( $id, '_post_highlights', true );
$excerpt = get_the_excerpt();

if ( '' != $highlights ) {
	$content = $highlights;
} else {
	$content = $excerpt;
}
$content = apply_filters('meta_content', $content);

?>

<div class="entry-highlights">
	<?php aerospace_report_download( $id ); ?>
	<div class="entry-highlights-title">
		<i class="icon-arrow-right"></i> 
		<?php esc_html_e( 'Highlights', 'aerospace' ); ?>
	</div>
	<div class="entry-highlights-content">
		<?php echo $content; ?>
	</div>
</div>