<?php

/**
 * Custom shortcodes for the theme
 *
 * @package aerospace
 */

/**
 * Shortcode for displaying post-first-sentence
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Full width embedded content
 */
function shortcode_first( $atts , $content = null ) {
	return "<span class='post-first-sentence'>".do_shortcode($content)."</span>";
}
add_shortcode( 'first', 'shortcode_first' );

/**
 * Adds inline social sharing component to podcasts, stats, and interactives embedded in posts via shortcode
 * @param  string $title Title to be used by social media
 * @param  string $URL   URL to be used by social media
 * @return string        HTML of share button
 */
 function shortcode_view( $atts ) {
	 $atts = shortcode_atts(
		 	array(
			 	'id' => null,
		 	),
			$atts,
			'view'
	 );
	 $post_title = get_the_title($atts['id']);
	 $post_url = get_the_permalink($atts['id']);
	 return "<div class='view-post'><a href='" . esc_url( $post_url ) . "'>" . esc_attr( $post_title ) . "</a></div>";
}
add_shortcode( 'view', 'shortcode_view' );
 ?>
