<?php

/**
 * Custom shortcodes for Longform Template
 *
 * @package Aerospace
 */

/**
 * Shortcode for displaying post-first-sentence
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Full width embedded content
 */
function longform_section_header( $atts , $content = null ) {
	$atts = shortcode_atts(
	 	array(
			'title' => null,
	 	),
		$atts,
		'lf-section-header'
	);

	return '<div class="longform-section-header">
		<div class="section-overlay" data-aos="fade" data-aos-delay="100" data-aos-easing="ease-in-quad" data-aos-anchor=".section-content" data-aos-offset="200" data-aos-duration="600"></div>
		<div class="section-content">
			<h2>' . $atts['title'] . '</h2>' . do_shortcode($content) . '
		</div>
	</div>';
}
add_shortcode( 'lf-section-header', 'longform_section_header' );

