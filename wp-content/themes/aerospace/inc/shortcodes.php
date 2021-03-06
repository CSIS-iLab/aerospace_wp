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
 * Adds styled link to specific post
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Styled Link
 */
 function shortcode_view( $atts ) {
	// Attributes
	$atts = shortcode_atts(
	 	array(
		 	'id' => null,
			'title' => null,
			'window' => null,
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

	$window = '';
	if ( $atts['window'] ) {
		$window = ' target="_blank"';
	}

	return "<div class='view-post'><i class='icon-eye'></i><a href='" . esc_url( $post_url ) . "'" . $window . "><span class='view-post-verb'>" . esc_attr( $title ) . "</span> \"" . esc_attr( $post_title ) . "\"</a></div>";

}
add_shortcode( 'view', 'shortcode_view' );

/**
 * Adds styled link to provided URL
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Styled Link
 */
 function shortcode_explore( $atts ) {
	// Attributes
	$atts = shortcode_atts(
		 	array(
				'title' => null,
				'url' => null,
				'verb' => 'Explore',
				'window' => null
		 	),
			$atts,
			'explore'
	);

	$window = '';
	if ( $atts['window'] ) {
		$window = ' target="_blank"';
	}

	return "<div class='view-post view-more'><a href='" . esc_url( $atts['url'] ) . "'" . $window . "><span class='view-post-verb'>" . esc_attr( $atts['verb'] ) . "</span> " . esc_attr( $atts['title'] ) . "<i class='icon-long-arrow-right'></i></a></div>";

}
add_shortcode( 'explore', 'shortcode_explore' );

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
			'sharing' => true, // Include share component,
			'align' => null // Whether to align the iframe to either the left or right.
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
	$fallbackImgDisabled = get_post_meta( $atts['id'], '_data_fallback_img_disabled', true );

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

	if ( $atts['align'] ) {
		$align = "align" . $atts['align'];
	} else {
		$align = null;
	}

	return aerospace_data_display_iframe($data_url, $width, $height, $fallback_img, $iframe_resize_disabled, $align).$sharing;

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

/**
 * Adds link to external publication.
 * @param  string $title Title of publication.
 * @param  string $URL   URL of publication.
 * @return string        HTML of link.
 */
function shortcode_publication( $atts ) {
	// Attributes
	$atts = shortcode_atts(
	 	array(
		 	'url' => null,
			'title' => null,
	 	),
		$atts,
		'publication'
	);
	$title = $atts['title'];
	$url = $atts['url'];

	return '<div class="post-external-publication"><a href="' . esc_url( $url ) . '" target="_blank" rel="nofollow">' . esc_html( 'Read the full article in', 'aerospace') . ' <span class="post-external-publication-title">' . esc_attr( $title ) . '</span><i class="icon-external-open"></i></a></div>';
}
add_shortcode( 'publication', 'shortcode_publication' );

/**
 * Adds button to download PDF
 * @return string        HTML of link.
 */
function shortcode_download( $atts ) {
	// Attributes
	$atts = shortcode_atts(
	 	array(
		 	'label' => 'Download PDF',
			'url' => null,
	 	),
		$atts,
		'download'
	);
	$label = $atts['label'];
	$url = $atts['url'];

	return '<a href="' . esc_url( $url ) . '" download="Aerospace-Report" class="btn btn-gray btn-download"><i class="icon-download"></i> ' . $label . '</a>';
}
add_shortcode( 'download', 'shortcode_download' );

/**
 * Shortcode for displaying an aside block in posts.
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Aside block
 */
function shortcode_aside( $atts, $content = null ) {
	$atts = shortcode_atts(
	 	array(
			'align' => 'left',
	 	),
		$atts,
		'aside'
	);

	if ( 'right' == $atts['align'] ) {
		$align_class = ' alignright';
	} elseif ( 'left' == $atts['align'] ) {
		$align_class = ' alignleft';
	} elseif ( 'center' == $atts['align'] ) {
		$align_class = ' aligncenter';
	}

	return '<aside class="post-aside' . $align_class . '">' . do_shortcode( $content ) . '</aside>';
}
add_shortcode( 'aside', 'shortcode_aside' );

/**
 * Shortcode for displaying link to external analysis in posts.
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          External analysis block
 */
function shortcode_external_analysis( $atts ) {
	$atts = shortcode_atts(
	 	array(
			'align' => 'left',
			'organization' => null,
			'title' => null,
			'url' => null
	 	),
		$atts,
		'external-analysis'
	);

	if ( ! $atts['title'] || ! $atts['url'] ) {
		return;
	}

	if ( 'right' == $atts['align'] ) {
		$align_class = ' alignright';
	} elseif ( 'left' == $atts['align'] ) {
		$align_class = ' alignleft';
	} elseif ( 'center' == $atts['align'] ) {
		$align_class = ' aligncenter';
	}

	$organization = esc_html( 'Read more about this topic', 'aerospace' );
	if ( $atts['organization'] ) {
		$organization .= esc_html( ' via ', 'aerospace' ) . $atts['organization'];
	}

	$link = '<a href="' . esc_url( $atts['url'] ) . '" target="_blank" class="external-link">"' . esc_html( $atts['title'] ) . '"</a>';

	return '<aside class="external-analysis' . $align_class . '"><p>' . $organization . '</p><p class="external-link">' . $link . '</p></aside>';
}
add_shortcode( 'external-analysis', 'shortcode_external_analysis' );
