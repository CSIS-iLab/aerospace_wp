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
	 // Attributes
	 $atts = shortcode_atts(
		 	array(
			 	'id' => null,
		 	),
			$atts,
			'view'
	 );
	 $post_title = get_the_title($atts['id']);
	 $post_url = get_the_permalink($atts['id']);
	 $post_type = ucwords(get_post_type($atts['id']));

	 if (empty($post_title)) {
	 	if ($post_type == 'Post') {
	 		$post_title = '"Read"';
	 	} elseif ($post_type == 'Data') {
	 		$post_title = '"Learn"';
	 	} elseif ($post_type == 'Aerospace101') {
	 		$post_title = '"Interact"';
	 	} elseif ($post_type == 'Events') {
			$post_title = '"Watch"';
		}
	 }

	 return "<div class='view-post' title='" . esc_attr( $post_title ) . "'><a href='" . esc_url( $post_url ) . "'>" . esc_attr( $post_type ) . ": " . esc_attr( $post_title ) . "</a></div>";

}
add_shortcode( 'view', 'shortcode_view' );

/**
 * Shortcode for displaying enclosed content at the full width of the browser
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Full width embedded content
 */
function shortcode_fullWidth( $atts , $content = null ) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'width' => '' // Max Width of the container
		),
		$atts,
		'fullWidth'
	);
	if($atts['width']) {
		$mod_content = '<div class="fullWidthInner" style="max-width:'.$atts['width'].';">'.do_shortcode($content).'</div>';
	}
	else {
		$mod_content = do_shortcode($content);
	}
	return "<div class='fullWidthFeatureContent'>".$mod_content."</div>";
}
add_shortcode( 'fullWidth', 'shortcode_fullWidth' );

/**
 * Shortcode for displaying embedded interactive
 * @param  array $atts    Modifying arguments
 * @return string          Embedded interactive
 */
function aerospace_shortcode_interactive( $atts ) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'id' => '', // ID of Interactive Post
			'width' => '', // Width of Interactive
			'height' => '', // Height of Interactive,
		),
		$atts,
		'interactive'
	);
	$interactiveURL = get_post_meta( $atts['id'], '_data_url', true );
	$width = get_post_meta( $atts['id'], '_data_width', true );
	$height = get_post_meta( $atts['id'], '_data_height', true );
	$iframeResizeDisabled = get_post_meta( $atts['id'], '_data_iframeResizeDisabled', true );
	// Fallback Image
	$fallbackImgDisabled = get_post_meta( $atts['id'], '_data_fallbackImgDisabled', true );
	if(!$fallbackImgDisabled) {
		$fallbackImg = get_the_post_thumbnail($atts['id'], 'full');
	}
	$title = get_the_title($atts['id']);
	$sanitizedTitle = sanitize_title($title);
	$URL = get_permalink()."#".$sanitizedTitle;
	$heading = '<h2 class="interactive-heading" id="'.$sanitizedTitle.'">'.$title.'</h2>';
	return $heading.aerospace_data_display_iframe($interactiveURL, $width, $height, $fallbackImg, $iframeResizeDisabled);
}
add_shortcode( 'interactive', 'aerospace_shortcode_interactive' );


 ?>
