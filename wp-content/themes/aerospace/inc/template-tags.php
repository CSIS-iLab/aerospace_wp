<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Aerospace
 */


if (! function_exists('aerospace_posted_on') ) :
    /**
     * Prints HTML with published date..
     */
    function aerospace_posted_on()
    {
        $time_string = '<span class="meta-label">Published</span><time class="entry-date published" datetime="%1$s">%2$s</time>';
        
        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() )
        );
        echo '<div class="posted-on">' . $time_string . '</div>'; // WPCS: XSS OK.

    }
endif;

if (! function_exists('aerospace_last_updated') ) :
    /**
     * Prints HTML with last updated information.
     */
    function aerospace_last_updated()
    {
        $time_string = '<span class="meta-label">Last Updated</span><time class="entry-date updated" datetime="%1$s">%2$s</time>';
        
        $time_string = sprintf( $time_string,
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );
        echo '<div class="posted-on">' . $time_string . '</div>'; // WPCS: XSS OK.

    }
endif;

if ( ! function_exists( 'aerospace_post_is_featured' ) ) :
	/**
	 * Check to see if post is featured.
	 *
	 * @param int $id Post ID.
	 */
	function aerospace_post_is_featured ( $id ) {
		$post_type = get_post_type();
		if ( in_array( $post_type, array( 'aerospace101', 'data', 'events', 'post' ), true ) ) {
			$is_featured = get_post_meta( $id, '_post_is_featured', true );
			if ( 1 == $is_featured ) {
				printf( '<p class="post-is-featured">' . esc_html( 'Featured', 'aerospace' ) . '</p>');
			}
        }
	}
endif;

if ( ! function_exists( 'aerospace_entry_tags' ) ) :
    /**
     * Prints HTML with meta information for the tags.
     */
    function aerospace_entry_tags() {
        // Hide category and tag text for pages.
        if ( in_array( get_post_type(), array( 'post', 'events', 'aerospace101', 'data' ), true ) ) {
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '<ul><li>','</li><li>','</li></ul>' );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<div class="post-tags-container col-xs-12">' . esc_html__( 'Related Topics %1$s', 'aerospace' ) . '</div>', $tags_list ); // WPCS: XSS OK.
            }
        }
    }
endif;

if ( ! function_exists( 'aerospace_entry_categories' ) ) :
    /**
     * Prints HTML with meta information for the categories.
     */
    function aerospace_entry_categories() {
        // Hide category and tag text for pages.
        if ( in_array( get_post_type(), array( 'post', 'events', 'aerospace101', 'data' ), true ) ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list();
            if ( 'Uncategorized' === $categories_list ) {
                return;
            }
            if ( $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<div class="cat-links">' . esc_html( '%1$s' ) . '</div>', $categories_list ); // WPCS: XSS OK.
            }
        }
    }
endif;

if ( ! function_exists( 'aerospace_authors_list' ) ) :
	/**
	 * Return short list of authors, separated by a comma.
	 */
	function aerospace_authors_list() {
		if ( function_exists( 'coauthors_posts_links' ) ) {
			$prefix = $authors = '';
			foreach ( get_coauthors() as $coauthor ) :
				$authors .= '<a href="' . get_author_posts_url( $coauthor->ID, $coauthor->user_nicename ) . '">' . $prefix . $coauthor->display_name . '</a>';
                $prefix = ', ';
			endforeach;
		} else {
			$authors = the_author_posts_link();
		}
		echo '<div class="authors-list"><span class="meta-label">By</span> ' . $authors . '</div>';
	}
endif;

if ( ! function_exists( 'aerospace_authors_list_extended' ) ) :
    /**
     * Prints HTML with short author list.
     */
    function aerospace_authors_list_extended() {
        if ( function_exists( 'coauthors_posts_links' ) ) {
            $authors = '';
            foreach ( get_coauthors() as $coauthor ) :
                $authors .= '<div class="entry-author row">
                <div class="author-img col-xs-12 col-md-3">
                ' . coauthors_get_avatar( $coauthor, 150 ) . '
                </div>
                <div class="author-bio col-xs-12 col-md">
                    <p> ' . $coauthor->description . '</p>
                    <div class="author-read-more">' . esc_html_x('More articles by', 'aerospace') . ' <a href="' . get_author_posts_url( $coauthor->ID, $coauthor->user_nicename ) . '">' . $coauthor->display_name . '</a>
                    </div>
                </div></div>';
            endforeach;
        } else {
            $authors = the_author_posts_link();
        }
        echo '<div class="authors-list-extended">' . $authors . '</div>';
    }
endif;
