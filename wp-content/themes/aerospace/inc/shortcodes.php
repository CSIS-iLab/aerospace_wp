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
 ?>
