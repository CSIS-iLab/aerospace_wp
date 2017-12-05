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

	 return "<div class='view-post'><i class='icon-eye'></i><a href='" . esc_url( $post_url ) . "'><span class='view-post-verb'>" . esc_attr( $title ) . "</span> \"" . esc_attr( $post_title ) . "\"</a></div>";

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
		),
		$atts,
		'data'
	);

	$data_url = get_post_meta( $atts['id'], '_data_url', true );
	$width = get_post_meta( $atts['id'], '_data_width', true );
	$height = get_post_meta( $atts['id'], '_data_height', true );
	$iframe_resize_disabled = get_post_meta( $atts['id'], '_data_iframeResizeDisabled', true );
	$iframe_twitter_pic_url = get_post_meta( $atts['id'], '_data_twitter_pic_url', true );
	$data_img_url = get_post_meta( $atts['id'], '_data_img_url', true );

	$title = get_the_title($atts['id']);
	$URL = get_permalink();
	$data_post_url = get_permalink( $atts['id'] );

	// Fallback Image
	$fallbackImgDisabled = get_post_meta( $atts['id'], '_data_fallbackImgDisabled', true );

	if( $fallbackImgDisabled ) {
		$fallback_img = null;
	} elseif ( '' !== $data_img_url ) {
		$fallback_img = '<img src="' . esc_attr( $data_img_url ) . '" alt="' . $title . '" title="' . $title . '" />';
	} else {
		$fallback_img = get_the_post_thumbnail($atts['id'], 'full');
	}

	if($atts['sharing'] === true || $atts['sharing'] == 'true') {
		$sharing = aerospace_social_share($title, $URL, $data_post_url, $iframe_twitter_pic_url);
	}

	return aerospace_data_display_iframe($data_url, $width, $height, $fallback_img, $iframe_resize_disabled).$sharing;

}
add_shortcode( 'data', 'aerospace_shortcode_data' );

/**
 * Adds inline social sharing component to podcasts, stats, and interactives embedded in posts via shortcode
 * @param  string $title Title to be used by social media
 * @param  string $post_url   URL to be used by social media
 * @param  string $data_post_url URL to the data repo post.
 * @return string        HTML of share button
 */
function aerospace_social_share($title = "", $post_url = "", $data_post_url = "", $twitter_pic_url = null) {
	$shareArgs = array(
		'linkname' => $title . ' ' . $twitter_pic_url,
		'linkurl' => $post_url
	);
	echo $URL;
	$output = '<div class="sharing-inline">';
	$output .= '<div class="col-xs-12 col-md-6 sharing-inline-share"><span class="meta-label">Share</span>';
	ob_start();
    ADDTOANY_SHARE_SAVE_KIT($shareArgs);
    $output .= ob_get_contents();
    ob_end_clean();
    $output .= '</div><div class="col-xs-12 col-md-6 sharing-inline-view">View in the <a href="' . esc_url( $data_post_url ) . '">Data Repository</a></div>';
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
