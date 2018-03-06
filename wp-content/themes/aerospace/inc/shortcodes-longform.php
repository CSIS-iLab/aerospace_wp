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
			'image' => null,
			'theme' => 'dark'
	 	),
		$atts,
		'lf-section-header'
	);

	if ( $atts['image'] ) {
		$image_url = wp_get_attachment_url( $atts['image'] );
		$image_url_html = ' style="background-image:url(\'' . $image_url . '\');"';
		$image_caption = wp_get_attachment_caption( $atts['image'] );
		$image_caption_html = '<p class="thumbnail-caption">' . $image_caption . '</p>';
	}

	if ( 'light' == $atts['theme'] ) {
		$theme_class = ' section-light';
	} else {
		$theme_class = '';
	}

	return '<div class="longform-section-header"' . $image_url_html . '>
		<div class="section-overlay' . $theme_class . '" data-aos="fade" data-aos-delay="100" data-aos-easing="ease-in-quad" data-aos-anchor=".section-content" data-aos-offset="200" data-aos-duration="600"></div>
		<div class="section-content" data-aos="fade" data-aos-delay="300" data-aos-easing="ease-in-quad" data-aos-duration="600">
			<h2>' . $atts['title'] . '</h2>' . do_shortcode($content) . $image_caption_html . '
		</div>
	</div>';
}
add_shortcode( 'lf-section-header', 'longform_section_header' );

