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
			'toc' => null,
			'image' => null,
			'theme' => 'dark'
	 	),
		$atts,
		'lf-section-header'
	);

	$id = '';
	if ( $atts['id'] ) {
		$id = ' id="' . $atts['id'] . '"';
	}

	if ( $atts['image'] ) {
		$image_url = wp_get_attachment_url( $atts['image'] );
		$image_url_html = ' style="background-image:url(\'' . $image_url . '\');"';
		$image_caption = wp_get_attachment_caption( $atts['image'] );
		$image_caption_html = '<p class="thumbnail-caption">' . esc_html_x( 'Image Source: ', 'aerospace' ) . $image_caption . '</p>';
	}

	if ( 'light' == $atts['theme'] ) {
		$theme_class = ' section-light';
	} else {
		$theme_class = '';
	}

	$toc = '';
	if ( $atts['toc'] ) {
		$toc = '<span class="toc-title">' . $atts['toc'] . '</span>';
	}

	return '<div class="longform-section-header' . $theme_class . '"' . $id . $image_url_html . '>
		<div class="longform-section-overlay" data-aos="fade" data-aos-delay="100" data-aos-easing="ease-in-quad" data-aos-offset="200" data-aos-duration="600"></div>
		<div class="section-content">
			<h2 class="section-title toc-link">' . esc_html( $atts['title'] ) . $toc . '</h2>' . do_shortcode($content) . $image_caption_html . '
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
			'theme' => 'dark',
			'toc' => false
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
			$image_caption = '<figcaption class="wp-caption-text">' . esc_html_x( 'Image Source: ', 'aerospace' ) . $atts['source'] . '</figcaption>';
		}

		$image_html = '<figure class="section-img" data-aos="fade" data-aos-duration="200">' . wp_get_attachment_image( $atts['image'], 'full', false, $image_attrs) . $image_caption . '</figure>';
	}

	if ( 'left' == $atts['align'] ) {
		$section_alignment = ' section-left';
	} elseif ( 'right' == $atts['align'] ) {
		$section_alignment = ' section-right';
	}

	$heading_class = 'section-title';
	if ( $atts['toc'] ) {
		$heading_class .= ' toc-link';
	}

	return '<div class="longform-section-explainer' . $section_alignment . $theme_class . '"' . $id . '>
		<div class="longform-section-overlay" data-aos="fade" data-aos-delay="100" data-aos-easing="ease-in-quad" data-aos-offset="200" data-aos-duration="600"></div>
		<div class="section-content content-padding">' . $image_html . '
			<div class="section-text">
				<h3 class="' . $heading_class . '">' . $atts['title'] . '</h3>' . do_shortcode($content)  . '
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

	$id = '';
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
		$image_caption_html = '<p class="thumbnail-caption">' . esc_html_x( 'Image Source: ', 'aerospace' ) . $image_caption . '</p>';
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

/**
 * Shortcode for longform table of contents.
 * @param  array $atts    Modifying arguments
 * @param  string $content Embedded content
 * @return string          Longform Table of Contents
 */
function longform_table_of_contents( $atts , $content = null ) {
	global $post;
	$atts = shortcode_atts(
	 	array(
	 		'main' => null,
			'chapters' => null,
			'heading' => 'Chapter Navigation'
	 	),
		$atts,
		'lf-toc'
	);

	if ( !$atts['main'] && !$atts['chapters'] ) {
		return;
	}

	$main_html = '';
	if ( $atts['main'] ) {
		$main_title = get_the_title($atts['main']);
		$main_url = get_the_permalink($atts['main']);
		$main_image = get_the_post_thumbnail($atts['main'], 'large');
		$report_url = get_post_meta( $atts['main'], '_post_longform_report_url', true );

		if ( $report_url ) {
			$report_html = esc_html_x( 'Read the', 'aerospace' ) . ' <a href="' . esc_url( $report_url ) . '">' . esc_html_x( 'Full Report', 'aerospace' ) . '</a>';
		}

		$main_html = '<div class="longform-toc-main col-xs-12 col-sm-5">
			<a href="' . esc_url( $main_url ) . '">' . $main_image . '</a>
			<a href="' . esc_url( $main_url ) . '" class="main-title">' . $main_title . '</a>
		' . $report_html . '
		</div>';
	}

	$chapters_container_html = '';
	if ( $atts['chapters'] ) {
		$chapter_ids = explode( ',', $atts['chapters'] );
		$chapters_html = '';
		foreach( $chapter_ids as $id ) {
			$active = '';
			if ( $id == $post->ID ) {
				$active = ' class="active"';
			}

			$title = get_post_meta( $id, '_post_longform_chapter_title', true );
			if (!$title) {
				$title = get_the_title( $id );
			}

			$chapters_html .= '<li><a href="' . esc_url( get_permalink( $id ) ) . '"' . $active . '>' . $title . '</a></li>';
		}

		$chapters_container_html = '<div class="longform-toc-chapters col-xs-12 col-sm">
			<span class="meta-label">' . esc_html_x( $atts['heading'], 'aerospace' ) . '</span>
			<ul class="longform-toc-chapters-list">' . $chapters_html . '</ul>
		</div>';
	}


	return '<div class="longform-toc row">
		' . $main_html . $chapters_container_html . '
	</div>';
}
add_shortcode( 'lf-toc', 'longform_table_of_contents' );

