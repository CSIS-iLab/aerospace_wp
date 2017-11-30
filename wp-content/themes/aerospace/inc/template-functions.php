<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Aerospace
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param  array $classes Classes for the body element.
 * @return array
 */
function aerospace_body_classes( $classes ) 
{
    // Adds a class of hfeed to non-singular pages.
    if (! is_singular() ) {
        $classes[] = 'hfeed';
    }

    return $classes;
}
add_filter('body_class', 'aerospace_body_classes');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function aerospace_pingback_header() 
{
    if (is_singular() && pings_open() ) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}
add_action('wp_head', 'aerospace_pingback_header');

/**
 * Change the default post query to show featured posts first.
 *
 * @param  array $query Query object.
 */
function aerospace_custom_sort_posts( $query ) {
	if ( ( ( is_home() && get_option( 'page_for_posts' ) ) || is_category() || is_archive()) && $query->is_main_query() ) {
		$query->set( 'meta_key', '_post_is_featured' );
		$query->set( 'orderby', array(
			'meta_value_num' => 'DESC',
			'post_date' => 'DESC',
		) );
	}
}
add_action( 'pre_get_posts', 'aerospace_custom_sort_posts' );

/**
 * Check a given date to ensure it is valid.
 *
 * @param  string $date Date string in YYYY-MM-DD format.
 * @return [type]       [description]
 */
function aerospace_check_date( $date ) {
    $date_array = explode( '-', $date );
    if ( wp_checkdate( $date_array[1], $date_array[2], $date_array[0], $date ) ) {
        return $date_array;
    } else {
        return false;
    }
}

/**
 * Filter to replace the [caption] shortcode text with HTML5 compliant code
 *
 * @return text HTML content describing embedded figure
 **/
function aerospace_img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) )
        return $val;

    $capid = '';
    if ( $id ) {
        $id = esc_attr($id);
        $capid = 'id="figcaption_'. $id . '" ';
        $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
    }

    return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
    . do_shortcode( $content ) . '<figcaption ' . $capid 
    . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}
add_filter('img_caption_shortcode', 'aerospace_img_caption_shortcode_filter',10,3);

/**
 * Add Aerospace logo shortcode to end of posts.
 *
 * @param  string $content The post content.
 * @return string          The modified post content.
 */
function aerospace_add_logo_to_post_content( $content ) {
    global $post;
    if ( $post->post_type == 'post' ) {
        $content .= do_shortcode('[aircraft]');
    }
    return $content;
}
add_filter('the_content', 'aerospace_add_logo_to_post_content', 0);

/**
 * Load a template part into a template
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param array $params Any extra params to be passed to the template part.
 */
function get_template_part_extended( $slug, $name = null, $params = array() ) {
    if ( ! empty( $params ) ) {
        foreach ( (array) $params as $key => $param ) {
            set_query_var( $key, $param );
        }
    }
    get_template_part( $slug, $name );
}