<?php

/**
 * Custom shortcodes for the theme
 *
 * @package Aerospace
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
 * Shortcode for displaying embedded interactive
 * @param  array $atts    Modifying arguments
 * @return string          Embedded interactive
 */
function aerospace_shortcode_data( $atts ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '', // ID of Interactive Post
			'width' => '', // Width of Interactive
			'height' => '', // Height of Interactive,
			'sharing' => true, // Include share component
			'toc' => true // Include in Table of Contents
		),
		$atts,
		'data'
	);

	$data_url = get_post_meta( $atts['id'], '_data_url', true );
	$width = get_post_meta( $atts['id'], '_data_width', true );
	$height = get_post_meta( $atts['id'], '_data_height', true );
	$iframe_resize_disabled = get_post_meta( $atts['id'], '_data_iframeResizeDisabled', true );

	// Fallback Image
	$fallbackImgDisabled = get_post_meta( $atts['id'], '_data_fallbackImgDisabled', true );

	if(!$fallbackImgDisabled) {
		$fallback_img = get_the_post_thumbnail($atts['id'], 'full');
	}

	$title = get_the_title($atts['id']);
	$sanitizedTitle = sanitize_title($title);
	$URL = get_permalink()."#".$sanitizedTitle;

	if($atts['toc'] === true || $atts['toc'] == 'true') {
		$heading = '<h2 class="interactive-heading" id="'.$sanitizedTitle.'">'.$title.'</h2>';
	}

	if($atts['sharing'] === true || $atts['sharing'] == 'true') {
		$sharing = aerospace_social_share($title, $URL);
	}

	return $heading.aerospace_data_display_iframe($data_url, $width, $height, $fallback_img, $iframe_resize_disabled).$sharing;

}
add_shortcode( 'data', 'aerospace_shortcode_data' );

 ?>
