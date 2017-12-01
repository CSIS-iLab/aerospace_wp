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
				'title' => null,
		 	),
			$atts,
			'view'
	 );
	 $title = $atts['title'];
	 $post_title = get_the_title($atts['id']);
	 $post_url = get_the_permalink($atts['id']);
	 $post_type = ucwords(get_post_type($atts['id']));

	 if (empty($title)) {
	 	if ($post_type == 'Post') {
	 		$title = 'Read';
	 	} elseif ($post_type == 'Data') {
	 		$title = 'Interact';
	 	} elseif ($post_type == 'Aerospace101') {
	 		$title = 'Learn';
	 	} elseif ($post_type == 'Events') {
			$title = 'Watch';
		}
	 }

	 return "<div class='view-post' ><a href='" . esc_url( $post_url ) . "'>" . esc_attr( $title ) . " " . esc_attr( $post_title ) . "</a></div>";

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

/**
 * Adds inline social sharing component to podcasts, stats, and interactives embedded in posts via shortcode
 * @param  string $title Title to be used by social media
 * @param  string $URL   URL to be used by social media
 * @return string        HTML of share button
 */
function aerospace_social_share($title = "", $URL = "") {
	$shareArgs = array(
		'linkname' => $title,
		'linkurl' => $URL
	);
	$output = '<div class="sharing-inline">';
	$output .= '<button class="btn btn-gray sharing-openShareBtn">Share <i class="icon icon-share"></i></button>';
	$output .= '<div class="sharing-shareBtns">';
	$output .= '<div class="post-title">'.$title.'</div>';
	ob_start();
    ADDTOANY_SHARE_SAVE_KIT($shareArgs);
    $output .= ob_get_contents();
    ob_end_clean();
    $output .= '<i class="icon icon-close-x"></i>';
    $output .= '</div>';
    $output .= '</div>';
    return $output;
}

/**
 * Shortcode for displaying Aerospace logo
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Logo
 */
function shortcode_aircraft( $atts ) {
	return '<img src="' . get_template_directory_uri() . '/img/aircraft-icon.svg" class="img-aircraft" alt="Aerospace" title="Aerospace" />';
}
add_shortcode( 'aircraft', 'shortcode_aircraft' );
