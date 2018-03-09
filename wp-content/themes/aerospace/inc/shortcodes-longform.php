<?php

/**
 * Custom shortcodes for Longform Template
 *
 * @package Aerospace
 */

/**
 * Shortcode for a section header
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Section header
 */
function longform_section_header( $atts , $content = null ) {
	$atts = shortcode_atts(
	 	array(
	 		'id' => null,
			'title' => null,
			'image' => null,
			'theme' => 'dark'
	 	),
		$atts,
		'lf-section-header'
	);

	if ( $atts['id'] ) {
		$id = ' id="' . $atts['id'] . '"';
	}

	if ( $atts['image'] ) {
		$image_url = wp_get_attachment_url( $atts['image'] );
		$image_url_html = ' style="background-image:url(\'' . $image_url . '\');"';
		$image_caption = wp_get_attachment_caption( $atts['image'] );
		$image_caption_html = '<p class="thumbnail-caption">' . esc_html_x( 'Source: ', 'aerospace' ) . $image_caption . '</p>';
	}

	if ( 'light' == $atts['theme'] ) {
		$theme_class = ' section-light';
	} else {
		$theme_class = '';
	}

	return '<div class="longform-section-header"' . $id . $image_url_html . '>
		<div class="longform-section-overlay' . $theme_class . '" data-aos="fade" data-aos-delay="100" data-aos-easing="ease-in-quad" data-aos-anchor=".section-content" data-aos-offset="200" data-aos-duration="600"></div>
		<div class="section-content">
			<h2 class="section-title toc-link">' . $atts['title'] . '</h2>' . do_shortcode($content) . $image_caption_html . '
		</div>
	</div>';
}
add_shortcode( 'lf-section-header', 'longform_section_header' );

/**
 * Shortcode for section explainer
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Section explainer
 */
function longform_section_explainer( $atts , $content = null ) {
	$atts = shortcode_atts(
	 	array(
	 		'id' => null,
			'title' => null,
			'image' => null,
			'image_classes' => null,
			'source' => null,
			'align' => null,
			'theme' => 'dark'
	 	),
		$atts,
		'lf-section-explainer'
	);

	if ( $atts['id'] ) {
		$id = ' id="' . $atts['id'] . '"';
	}

	if ( 'light' == $atts['theme'] ) {
		$theme_class = ' section-light';
	} else {
		$theme_class = '';
	}

	$image_attrs = array();
	if ( $atts['image_classes'] ) {
		$image_attrs['class'] = $atts['image_classes'];
	}

	if ( $atts['image'] ) {
		if ( $atts['source'] ) {
			$image_caption = '<figcaption class="wp-caption-text">' . esc_html_x( 'Source: ', 'aerospace' ) . $atts['source'] . '</figcaption>';
		}

		$image_html = '<figure class="section-img" data-aos="fade" data-aos-duration="200">' . wp_get_attachment_image( $atts['image'], 'full', false, $image_attrs) . $image_caption . '</figure>';
	}

	if ( 'left' == $atts['align'] ) {
		$section_alignment = ' section-left';
	} elseif ( 'right' == $atts['align'] ) {
		$section_alignment = ' section-right';
	}

	return '<div class="longform-section-explainer' . $section_alignment . $theme_class . '"' . $id . '>
		<div class="longform-section-overlay" data-aos="fade" data-aos-delay="100" data-aos-easing="ease-in-quad" data-aos-offset="200" data-aos-duration="600"></div>
		<div class="section-content content-padding">' . $image_html . '
			<div class="section-text">
				<h3 class="section-title">' . $atts['title'] . '</h3>' . do_shortcode($content)  . '
			</div>
		</div>
	</div>';
}
add_shortcode( 'lf-section-explainer', 'longform_section_explainer' );

/**
 * Shortcode for section with text overlaying the background with internal scrolling.
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Text overlay section
 */
function longform_section_text_overlay( $atts , $content = null ) {
	$atts = shortcode_atts(
	 	array(
	 		'id' => null,
			'image' => null,
			'align' => null,
			'theme' => 'dark'
	 	),
		$atts,
		'lf-text-overlay'
	);

	if ( $atts['id'] ) {
		$id = ' id="' . $atts['id'] . '"';
	}

	if ( 'light' == $atts['theme'] ) {
		$theme_class = ' section-light';
	} else {
		$theme_class = '';
	}

	if ( $atts['image'] ) {
		$image_url = wp_get_attachment_url( $atts['image'] );
		$image_url_html = ' style="background-image:url(\'' . $image_url . '\');"';
		$image_caption = wp_get_attachment_caption( $atts['image'] );
		$image_caption_html = '<p class="thumbnail-caption">' . esc_html_x( 'Source: ', 'aerospace' ) . $image_caption . '</p>';
	}

	if ( 'left' == $atts['align'] ) {
		$section_alignment = ' section-left';
	} elseif ( 'right' == $atts['align'] ) {
		$section_alignment = ' section-right';
	}

	return '<div class="longform-text-overlay"' . $id . $image_url_html . '>
		<div class="section-content' . $theme_class  . $section_alignment . '">' . do_shortcode($content) . $image_caption_html . '
		</div>
	</div>';
}
add_shortcode( 'lf-text-overlay', 'longform_section_text_overlay' );

