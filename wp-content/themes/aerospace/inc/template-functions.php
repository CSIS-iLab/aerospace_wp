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
 * Change the default post query to show featured posts first except for events.
 *
 * @param  array $query Query object.
 */
function aerospace_custom_sort_posts( $query ) {
	if ( ! is_admin() && ( ( is_home() && get_option( 'page_for_posts' ) ) || is_category() || is_archive() ) && $query->is_main_query() && ! is_post_type_archive( 'events' ) && ! is_post_type_archive( 'data' ) && ! is_author() ) {
		$query->set( 'meta_key', '_post_is_featured' );

        if ( 'ASC' === get_query_var( 'order' ) ) {
            $sort_dir = 'ASC';
        } else {
            $sort_dir = 'DESC';
        }

        $tag_id = get_query_var( 'tid' );
        if ( $tag_id ) {
            $query->set( 'tag__in', array($tag_id) );
            add_filter( 'body_class', function( $classes ) {
                return array_merge( $classes, array( 'archive-filtered-results' ) );
            } );
        }

		$query->set( 'orderby', array(
			'meta_value_num' => 'DESC',
			'post_date' => $sort_dir,
		) );
	}
}
add_action( 'pre_get_posts', 'aerospace_custom_sort_posts' );

/**
 * Amend tag archives to include custom post types.
 *
 * @param  array $query Query object.
 */
function aerospace_cpt_tags_archive( $query ) {
    if ( ( $query->is_tag() ) && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'events', 'aerospace101', 'data' ) );
    }
}
add_action( 'pre_get_posts', 'aerospace_cpt_tags_archive' );

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
        $disable_icon = get_post_meta( $post->ID, '_post_disable_post_bottom_icon', true );
        if ( ! $disable_icon ) {
            $content .= do_shortcode('[aircraft]');
        }
    }
    return $content;
}
add_filter('the_content', 'aerospace_add_logo_to_post_content', 0);

/**
 * Fixes empty <p> and <br> tags showing before and after shortcodes in the
 * output content.
 */
function aerospace_the_content_shortcode_fix($content) {
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']',
        ']<br>'   => ']'
    );
    return strtr($content, $array);
}
add_filter('the_content', 'aerospace_the_content_shortcode_fix');

/**
 * Use relative URLs for images
 */
function aerospace_switch_to_relative_url($html, $id, $caption, $title, $align, $url, $size, $alt)
{
    $imageurl = wp_get_attachment_image_src($id, $size);
    $relativeurl = wp_make_link_relative($imageurl[0]);
    $html = str_replace($imageurl[0],$relativeurl,$html);

    return $html;
}
add_filter('image_send_to_editor','aerospace_switch_to_relative_url',10,8);

/**
 * Alter the titles of the archives for categories & tags.
 * @param  string $title Archive title
 * @return string        Modified archive title.
 */
function aerospace_archive_titles( $title ) {
    if( is_category() ) {
        $title = single_cat_title( '<span class="archive-label">Topic:</span> ', false );
    } elseif( is_tag() ) {
        $title = single_tag_title( '<span class="archive-label">Keyword:</span> ', false );
    } elseif( is_author() ) {
        $title = '<span class="archive-label">Author:</span> ' . get_the_author();
    }
    return $title;
}
add_filter( 'get_the_archive_title', 'aerospace_archive_titles' );

/**
 * Add custom query vars.
 * @param array $vars Query vars fed into WP_Query.
 */
function aerospace_add_query_vars_filter( $vars ){
  $vars[] = "tid";
  return $vars;
}
add_filter( 'query_vars', 'aerospace_add_query_vars_filter' );

if ( class_exists( 'easyFootnotes' ) ) {
    /**
     * Removes the easy footnotes from the content so we can display them separately elsewhere.
     * @param  string $content The post content.
     * @return string          The modified post content.
     */
    function aerospace_remove_easy_footnotes($content) {
        $content = preg_replace('#<ol[^>]*class="easy-footnotes-wrapper"[^>]*>.*?</ol>#is', '', $content);
        return $content;
    }
    add_filter('the_content', 'aerospace_remove_easy_footnotes', 20);
}

/**
 * Custom page titles for Guest Authors with WordPress SEO
 * Returns "[author name]&#39;s articles on [site name]".
 *
 * @param  string $title Author's name.
 */
function nuclearnetwork_co_author_wseo_title( $title ) {
    // Only filter title output for author pages.
    if ( is_author() && function_exists( 'get_coauthors' ) ) {
        $qo = get_queried_object();
        $author_name = $qo->display_name;
        return $author_name . '&#39;s articles on ' . get_bloginfo( 'name' );
    }
    return $title;
}
add_filter( 'wpseo_title', 'nuclearnetwork_co_author_wseo_title' );

/**
 * Set default attributes for the accordion shortcode.
 * @param array $atts Shortcode attributes.
 */
function set_accordion_shortcode_defaults($atts) {
    // Override the openfirst setting here
    $atts['scroll'] = 80;
    $atts['autoclose'] = false;
    $atts['clicktoclose'] = true;

    return $atts;
}
add_filter('shortcode_atts_accordion', 'set_accordion_shortcode_defaults', 10, 3);


/**
 * Make links pushed to Algolia relative.
 *
 * @param array   $shared_attributes Attributes to push.
 * @param WP_Post $post Post object.
 * @return array Updated Attributes array.
 */
function aerospace_algolia_shared_attributes( array $shared_attributes, WP_Post $post ) {

    $shared_attributes['permalink'] = wp_make_link_relative( get_post_permalink( $post ) );
    if ( has_post_thumbnail( $post ) ) {
        $shared_attributes['images']['thumbnail']['url'] = wp_make_link_relative( get_the_post_thumbnail_url( $post ) );
    }
    return $shared_attributes;
}
add_filter( 'algolia_post_shared_attributes', 'aerospace_algolia_shared_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_shared_attributes', 'aerospace_algolia_shared_attributes', 10, 2 );

add_filter( 'coauthors_guest_author_fields', 'aerospace_filter_guest_author_fields', 10, 2 );
/**
 * Add fields for Guest Author names.
 */
function aerospace_filter_guest_author_fields( $fields_to_return, $groups ) {
    if ( in_array( 'all', $groups ) || in_array( 'contact-info', $groups ) ) {
        $fields_to_return[] = array(
            'key'      => 'twitter',
            'label'    => 'Twitter',
            'group'    => 'contact-info',
        );
    }
    return $fields_to_return;
}

function aerospace_algolia_author_shared_attributes( array $shared_attributes, WP_Post $post ) {

    $shared_attributes['permalink'] = wp_make_link_relative( get_post_permalink( $post ) );
    return $shared_attributes;
}
add_filter( 'algolia_post_guest-author_shared_attributes', 'aerospace_algolia_author_shared_attributes', 10, 2 );
add_filter( 'algolia_searchable_post_guest-author_shared_attributes', 'aerospace_algolia_author_shared_attributes', 10, 2 );

/**
 * Only use Photon for images belonging to our site.
 *
 * @see https://wordpress.org/support/?p=8513006
 *
 * @param bool         $skip      Should Photon ignore that image.
 * @param string       $image_url Image URL.
 * @param array|string $args      Array of Photon arguments.
 * @param string|null  $scheme    Image scheme. Default to null.
 */
function jeherve_photon_only_allow_local( $skip, $image_url, $args, $scheme ) {
    // Get the site URL, without any protocol.
    $site_url = preg_replace( '~^(?:f|ht)tps?://~i', '', get_site_url() );

    /**
     * If the image URL is from our site,
     * return default value (false, unless another function overwrites).
     * Otherwise, do not use Photon with it.
     */
    if ( strpos( $image_url, $site_url ) ) {
        return $skip;
    } else {
        return true;
    }
}
add_filter( 'jetpack_photon_skip_for_url', 'jeherve_photon_only_allow_local', 9, 4 );
