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

if ( ! function_exists( 'aerospace_post_format' ) ) :
    /**
     * Returns HTML with post format.
     *
     * @param int $id Post ID.
     */
    function aerospace_post_format( $id ) {
        $post_type = get_post_type();
        if ( in_array( $post_type, array( 'post', 'events', 'aerospace101', 'data' ), true ) ) {
            
            if ( 'post' === $post_type ) {
                $post_types = get_the_terms( $id, 'post_types' );
                if ( ! empty( $post_types ) && ! is_wp_error( $post_types ) ) {
                    $post_types = wp_list_pluck( $post_types, 'name' );
                    $post_format = $post_types[0];
                }
            }

            if ( ! $post_format ) {
                $obj = get_post_type_object( $post_type );
                $post_format = $obj->labels->name;
            }
            if ( $post_format ) {
                printf( '<p class="post-format">' . esc_html( '%2$s' ) . esc_html( '%1$s' ) . esc_html( '%3$s' ) . '</p>', $post_format, $is_featured, $is_nextgen ); // WPCS: XSS OK.
            }
        }
    }
endif;

if ( ! function_exists( 'aerospace_citation' ) ) :
    /**
     * Returns HTML with post citation.
     *
     * @param int $id Post ID.
     */
    function aerospace_citation() {
        if ( get_the_modified_date() ) {
            $modified_date = 'Updated ' . get_the_modified_date() . '. ';
        }

        $authors = coauthors( ',', null, null, null, false );

        printf( '<p class="entry-citation">' . esc_html( '%1$s. "%2$s," Aerospace Security, %3$s. %4$s Accessed %5$s. %6$s', 'aerospace' ) . '</p>', $authors, get_the_title(), get_the_date(), $modified_date, current_time('F j, Y'), get_the_permalink() ); // WPCS: XSS OK.
    }
endif;

if ( ! function_exists( 'aerospace_post_highlights' ) ) :
    /**
     * Returns HTML with post citation.
     *
     * @param int $id Post ID.
     */
    function aerospace_post_highlighted_info( $id ) {
        if ( 'post' === get_post_type() && has_term( 'Report', 'post_types' ) ) {
            get_template_part( 'components/highlights-reports' );
        } elseif ( 'post' === get_post_type() ) {
            aerospace_show_highlights( $id );
        }
    }
endif;

if ( ! function_exists( 'aerospace_show_highlights' ) ) :
    /**
     * Returns HTML with entry highlights, unless they have been disabled. If no highlights are given, default to the post excerpt.
     *
     * @param  int $id Post ID.
     */
    function aerospace_show_highlights( $id ) {
        $post_type = get_post_type();
        if ( 'post' === $post_type ) {
            $highlights = get_post_meta( $id, '_post_highlights', true );
            $excerpt = get_the_excerpt();
            $disable_highlights = get_post_meta( $id, '_post_disable_highlights', true );
            
            if ( $disable_highlights ) {
                return;
            }

            if ( '' !== $highlights ) {
                printf( '<div class="entry-highlights">%1$s</div>', $highlights); // WPCS: XSS OK.
            } else {
                printf( '<div class="entry-highlights">%1$s</div>', $excerpt); // WPCS: XSS OK.
            }
        }
    }
endif;

if ( ! function_exists( 'aerospace_report_download' ) ) :
    /**
     * Returns HTML with download & view report links.
     *
     * @param  int $id Post ID.
     */
    function aerospace_report_download( $id ) {
        if ( 'post' === get_post_type() && has_term( 'Report', 'post_types' ) ) {
            $download_url = get_post_meta( $id, '_post_download_url', true );
            $view_url = get_post_meta( $id, '_post_view_url', true );
            if ( '' !== $download_url ) {
                $download = '<p><a href="' . esc_url( $download_url ) . '" download="PONIReport"><i class="icon-download"></i>' . esc_html( 'Download', 'aerospace' ) . '</a></p>';
            }
            if ( '' !== $view_url ) {
                $view = '<p><a href="' . esc_url( $view_url ) . '" target="_blank"><i class="icon-file-pdf"></i>' . esc_html( 'View', 'aerospace' ) . '</a></p>';
            }
            printf( '<div class="post-report">%1$s%2$s</div>', $download, $view ); // WPCS: XSS OK.
        }
    }
endif;
