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
		if ( in_array( $post_type, array( 'aerospace101', 'post' ), true ) ) {
			$is_featured = get_post_meta( $id, '_post_is_featured', true );
			$svg = '<svg id="asp" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6.9 17"><path class="st0" d="M1.3 0L0 1.2l2.8 4L.4 8.5l2.4 3.4L0 15.8 1.3 17l5.6-8.5z"/></svg>';
			if ( 1 == $is_featured ) {
				printf( '<p class="post-is-featured">' . esc_html( 'Featured', 'aerospace' ) . '%1$s</p>', $svg );
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
			$tags_list = get_the_tag_list( '<ul class="entry-tags"><li>','</li><li>','</li></ul>' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="post-tags-container col-xs-12"><h3 class="subheading-lg">' . esc_html__( 'Explore More', 'aerospace' ) . '</h3><span class="subheading">' . esc_html__( 'Related Keywords', 'aerospace' ) . '</span>%1$s</div>', $tags_list ); // WPCS: XSS OK.

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

if ( ! function_exists( 'aerospace_entry_data_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories.
	 */
	function aerospace_entry_data_categories() {
		// Hide category and tag text for pages.
		if ( in_array( get_post_type(), array( 'post', 'events', 'aerospace101', 'data' ), true ) ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list();
			if ( 'Uncategorized' === $categories_list ) {
					return;
			}
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<div class="cat-links">' . esc_html( 'Categories %1$s' ) . '</div>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'exclude_post_categories' ) ) :
		/**
		 * Creates function to filter out primary category id from catlist
		 */
		function exclude_post_categories($excl='', $spacer='') {
			$categories = get_the_category($post->ID);
			if (!empty($categories)) {
				$exclude = $excl;
				$exclude = explode(",", $exclude);
				$thecount = count(get_the_category()) - count($exclude);
				foreach ($categories as $cat) {
					$html = '';
					if (!in_array($cat->cat_ID, $exclude)) {
						if ($thecount > 0) {
							$html .= $spacer;
						}
						$html .= '<li><a href="' . get_category_link($cat->cat_ID) . '" ';
						$html .= 'title="' . $cat->cat_name . '">' . $cat->cat_name . '</a></li>';
						$thecount--;
						echo $html;
					}
				}
			}
		}
endif;

if ( ! function_exists( 'aerospace_entry_primary_cats' ) ) :
	/**
	 * Show Yoast Primary Category first in category list.
	 */
	function aerospace_entry_primary_cats() {
		$category = get_the_category();
		$useCatLink = true;
		// If post has a category assigned.
		if ($category) {
			$category_display = '';
			$category_link = '';
			if ( class_exists('WPSEO_Primary_Term') ) {
				// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
				$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
				$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
				$term = get_term( $wpseo_primary_term );
				if (is_wp_error($term)) {
				// Default to first category (not Yoast) if an error is returned
				$category_display = $category[0]->name;
				$category_link = get_category_link( $category[0]->term_id );
			} else {
				// Yoast Primary category
				$category_display = $term->name;
				$category_link = get_category_link( $term->term_id );
				}
			} else {
				// Default, display the first category in WP's list of assigned categories
				$category_display = $category[0]->name;
				$category_link = get_category_link( $category[0]->term_id );
				}
				// Display category
				if ( !empty($category_display) ) {
					echo '<div class="cat-links"><ul>';
					if ( $useCatLink == true && !empty($category_link) ) {
						echo '<li><a href="'.$category_link.'">'.htmlspecialchars($category_display).'</a></li>';
						echo exclude_post_categories($wpseo_primary_term);
					} else {
						echo htmlspecialchars($category_display);
					}
					echo '</ul></div>';
				}
			}
		}
endif;

if ( ! function_exists( 'aerospace_authors_list' ) ) :
	/**
	 * Return short list of authors, separated by a comma.
	 */
	function aerospace_authors_list() {
		if ( in_array( get_post_type(), array( 'post', 'aerospace101' ), true ) ) {
			if ( function_exists( 'coauthors_posts_links' ) ) {
				$prefix = $authors = '';
				foreach ( get_coauthors() as $coauthor ) :
					$authors .= $prefix . '<a href="' . get_author_posts_url( $coauthor->ID, $coauthor->user_nicename ) . '">' . $coauthor->display_name . '</a>';
									$prefix = ', ';
				endforeach;
			} else {
				$authors = the_author_posts_link();
			}
			echo '<div class="authors-list"><span class="meta-label">By</span> ' . $authors . '</div>';
		}
	}
endif;

if ( ! function_exists( 'aerospace_authors_list_extended' ) ) :
	/**
	 * Prints HTML with short author list.
	 */
	function aerospace_authors_list_extended() {
		if ( function_exists( 'coauthors_posts_links' ) ) {
			$authors = '<h3 class="subheading-lg">' . esc_html__( 'About the Authors' , 'aerospace' ) . '</h3>';
			foreach ( get_coauthors() as $coauthor ) :
				$authors .= '<div class="entry-author row">
				<div class="author-img col-xs-3 col-md-2">
				' . coauthors_get_avatar( $coauthor, 150 ) . '
				</div>
				<div class="author-bio col-xs">
					<div class="author-img-mobile">
					' . coauthors_get_avatar( $coauthor, 150 ) . '
					</div>
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
		if ( in_array( $post_type, array( 'post', 'events', 'aerospace101', 'data', 'page' ), true ) ) {

			if ( 'post' === $post_type ) {
				$post_types = get_the_terms( $id, 'post_types' );
				if ( ! empty( $post_types ) && ! is_wp_error( $post_types ) ) {
					$post_types = wp_list_pluck( $post_types, 'name' );
					$post_format = $post_types[0];
				}
			} elseif ( 'data' === $post_type ) {
				$post_format = 'Data Repository';
			}

			if ( ! $post_format ) {
				$obj = get_post_type_object( $post_type );
				$post_format = $obj->labels->name;
			}
			if ( $post_format ) {
				printf( '<div class="post-format">' . esc_html( '%2$s' ) . esc_html( '%1$s' ) . esc_html( '%3$s' ) . '</div>', $post_format, $is_featured, $is_nextgen ); // WPCS: XSS OK.
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
		$year = get_the_date( 'Y' );

		$authors = coauthors( ', ', null, null, null, false );

		printf( '<span class="meta-label">Cite this Page</span><p class="citation">' . esc_html( '%1$s,', 'aerospace') . ' <em>%2$s</em> ' . esc_html( '(Washington D.C.: Center for Strategic and International Studies, %3$s), %4$s', 'aerospace' ) . '</p><button id="btn-copy" class="btn btn-gray" data-clipboard-target=".citation" aria-label="Copied!">Copy</button>', $authors, get_the_title(), $year, get_the_permalink() ); // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'aerospace_post_highlights' ) ) :
		/**
		 * Returns HTML with post citation.
		 *
		 * @param int $id Post ID.
		 */
		function aerospace_post_highlighted_info( $id ) {
				if ( 'post' === get_post_type() ) {
						aerospace_show_highlights( $id );
				} elseif ( 'events' === get_post_type() ) {
						get_template_part( 'components/highlights-events' );
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
						$disable_highlights = get_post_meta( $id, '_post_disable_highlights', true );

						if ( $disable_highlights ) {
								return;
						}
						get_template_part( 'components/highlights-post' );
				}
		}
endif;

if ( ! function_exists( 'aerospace_show_featured_img' ) ) :
		/**
		 * Returns HTML with featured image and caption.
		 *
		 * @param  int $id Post ID.
		 */
		function aerospace_show_featured_img( $id ) {
				$post_type = get_post_type();
				$disable_feature_img = get_post_meta( $id, '_post_disable_feature_img', true );
				if ( in_array( $post_type, array( 'post', 'aerospace101' ), true ) && has_post_thumbnail() && ! $disable_feature_img && ! has_term( 'Report', 'post_types' ) ) {
						$caption = get_post( get_post_thumbnail_id() )->post_excerpt;
						if ( $caption ) {
								$caption = '<figcaption class="wp-caption-text">' . $caption . '</figcaption>';
						}

						printf( '<figure class="entry-thumbnail wp-caption">
						%1$s%2$s
						</figure>', get_the_post_thumbnail(null, 'full'), $caption); // WPCS: XSS OK.
				}
		}
endif;

if ( ! function_exists( 'aerospace_post_sources' ) ) :
	/**
	 * Returns HTML with source info if it exists.
	 *
	 * @param  int $id Post ID.
	 */
	function aerospace_post_sources( $id ) {
		$post_type = get_post_type();
		if ( in_array( $post_type, array( 'post', 'aerospace101' ), true ) ) {
			$sources = get_post_meta( $id, '_post_sources', true );

			if ( '' !== $sources ) {
				$sources = apply_filters('meta_content', $sources);
				printf( '<div class="entry-sources col-xs-12 col-md"><h4 class="subheading">' . esc_html( 'Sources', 'aerospace') . '</h4>%1$s</div>', $sources); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'aerospace_post_footnotes' ) ) :
		/**
		 * Returns HTML with post footnotes if they exist.
		 *
		 */
		function aerospace_post_footnotes() {
				global $footnoteCopy;
				$post_type = get_post_type();
				if ( in_array( $post_type, array( 'post', 'aerospace101' ), true ) && $footnoteCopy != '' ) {

						printf( '<div class="entry-footnotes col-xs-12 col-md"><h4 class="subheading">' . esc_html( 'Footnotes', 'aerospace') . '</h4><ol class="easy-footnotes-wrapper">%1$s</ol></div>', $footnoteCopy); // WPCS: XSS OK.
				}
		}
endif;

if ( ! function_exists( 'aerospace_related_content' ) ) :
	/**
	 * Displays related content to the current post
	 * @param  Array $rel Array of related posts
	 * @return String      HTML of related posts
	 */
	function aerospace_related_content(){
		global $related;
		$rel = $related->show( get_the_ID(), true );
		// Display the title and excerpt of each related post
		if ( is_array( $rel ) && count( $rel ) > 0 ) {
			global $post;
			echo '<div class="related-posts col-xs-12 row">';
			foreach( $rel as $post ) : setup_postdata($post);
				if ($post->post_status != 'trash') {
					echo '<div class="related-post col-xs-12 col-md">';
					echo '<div class="related-post-img"><a href="'.get_permalink().'">';
					the_post_thumbnail('medium-large');
					echo '</a></div><div class="related-post-content">';
					echo '<a href="'.get_permalink().'" class="related-post-title">';
					the_title();
					echo '</a>';
					aerospace_authors_list();
					aerospace_posted_on();
					echo '</div></div>';
				}
			endforeach;
			wp_reset_postdata();
			echo '</div>';
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
				if ( 'post' === get_post_type() ) {
						$report_cover_url = get_post_meta( $id, '_post_report_cover_url', true );
						$download_url = get_post_meta( $id, '_post_download_url', true );
						$view_url = get_post_meta( $id, '_post_view_url', true );

						if ( '' !== $download_url ) {
								$download = '<a href="' . esc_url( $download_url ) . '" download="Aerospace-Report" class="btn btn-gray btn-download"><i class="icon-download"></i>' . esc_html( 'Download PDF', 'aerospace' ) . '</a>';
						}

						if ( '' !== $view_url && has_term( 'Report', 'post_types' ) ) {

							if ( '' !== $report_cover_url ) {
								$report_cover = '<img src="' . esc_attr( $report_cover_url ) . '" class="attachment-full size-full wp-post-image" title="View the Report" alt="View the Report" />';
							} elseif ( has_post_thumbnail() ) {
								$report_cover = get_the_post_thumbnail( null, 'full', array( 'title' => 'View the Report' ) );
							} else {
								$report_cover = '';
							}

							$view = '<div class="entry-report-thumbnail"><a href="' . esc_url( $view_url ) . '" target="_blank"> ' . $report_cover . '</a></div>';
						}
						printf( '<div class="post-report">%1$s%2$s</div>', $view, $download ); // WPCS: XSS OK.
				}
		}
endif;

if ( ! function_exists( 'aerospace_event_is_past' ) ) :
	/**
	 * Checks the event end date to determine if the event has past or not.
	 *
	 * @param  int $id Post ID.
	 */
	function aerospace_event_is_past( $id ) {
		if ( 'events' === get_post_type() ) {
			$current_date = date( 'Y-m-d' );
			$end_date = get_post_meta( $id, '_events_end_date', true );

			if ( $current_date > $end_date ) {
					return true;
			} else {
					return false;
			}
		}
	}
endif;

if ( ! function_exists( 'aerospace_event_dates' ) ) :
	/**
	 * Returns HTML with event dates.
	 *
	 * @param  int $id Post ID.
	 * @param  bool $start_only Whether to only show the start date.
	 */
	function aerospace_event_dates( $id, $start_only = false ) {
		if ( 'events' === get_post_type() && null !== get_post_meta( $id, '_events_start_date', true ) ) {
			$start_date = get_post_meta( $id, '_events_start_date', true );
			$start_date_array = aerospace_check_date( $start_date );
			if ( $start_date_array ) {
				$start_date_formatted = date( get_option( 'date_format' ), mktime( 0, 0, 0, $start_date_array[1], $start_date_array[2], $start_date_array[0] ) );
			}
			$end_date = get_post_meta( $id, '_events_end_date', true );


			if ( $start_only ) {
				$label = 'Date';
				$end_date_formatted = null;
			} elseif ( $end_date && $end_date !== $start_date ) {
				$label = 'Dates';
				$end_date_array = aerospace_check_date( $end_date );
				if ( $end_date_array ) {
					$end_date_formatted = ' - ' . date( get_option( 'date_format' ), mktime( 0, 0, 0, $end_date_array[1], $end_date_array[2], $end_date_array[0] ) );
				}
			}
			printf( '<div class="post-event-dates"><span class="meta-label">' . esc_html_x( '%1$s', 'aerospace' ) . '</span>%2$s%3$s</div>', $label, $start_date_formatted, $end_date_formatted ); // WPCS: XSS OK.
		}
	}
endif;

if ( ! function_exists( 'aerospace_posted_on_calendar' ) ) :
	/**
	 * Prints HTML of posted on date in calendar form.
	 */
	function aerospace_posted_on_calendar( $id ) {
		if ( 'events' === get_post_type() ) {
				$start_date = get_post_meta( $id, '_events_start_date', true );
				$start_date_array = aerospace_check_date( $start_date );
				$month_time = mktime(0, 0, 0, $start_date_array[1], 1);
				$month = date( 'M', $month_time );
				$day = $start_date_array[2];
		} else {
				$month = get_the_date( 'M' );
				$day = get_the_date( 'j' );
		}
		$date_string = '<span class="month">%1$s</span><span class="day">%2$s</span>';
		$date_string = sprintf( $date_string,
				esc_attr( $month ),
				esc_html( $day )
		);

		if ( aerospace_event_is_past( $id ) ) {
				$class = ' past';
		} else {
				$class = null;
		}

		echo '<div class="calendar-container' . $class . '"><a href="' . esc_url( get_permalink() ) . '">' . $date_string . '</a></div>'; // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'aerospace_event_time' ) ) :
	/**
	 * Returns HTML with the time of the event.
	 *
	 * @param  int $id Post ID.
	 */
	function aerospace_event_time( $id ) {
		if ( 'events' === get_post_type() ) {
			$time = get_post_meta( $id, '_events_time', true );

			if ( '' !== $time ) {
				printf( '<div class="entry-time"><span class="meta-label">' . esc_html( 'Time', 'aerospace') . '</span>%1$s</div>', $time); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'aerospace_event_location' ) ) :
		/**
		 * Returns HTML with the location of the event.
		 *
		 * @param  int $id Post ID.
		 */
		function aerospace_event_location( $id, $map = false ) {
				if ( 'events' === get_post_type() ) {
						$location = get_post_meta( $id, '_events_location', true );

						if ( $map ) {
								$mapHTML = aerospace_event_google_map( $id, false );
						}

						if ( '' !== $location ) {
								printf( '<div class="entry-location"><span class="meta-label">' . esc_html( 'Location', 'aerospace') . '</span>%1$s%2$s</div>', $location, $mapHTML); // WPCS: XSS OK.
						}
				}
		}
endif;

if ( ! function_exists( 'aerospace_event_address' ) ) :
		/**
		 * Returns HTML with the address of the event.
		 *
		 * @param  int $id Post ID.
		 */
		function aerospace_event_address( $id, $map = false ) {
				if ( 'events' === get_post_type() ) {
						$address = get_post_meta( $id, '_events_address', true );

						if ( $map ) {
								$mapHTML = aerospace_event_google_map( $id, false );
						}

						if ( '' !== $address ) {
								$address = nl2br( $address );
								printf( '<div class="entry-address"><span class="meta-label">' . esc_html( 'Address', 'aerospace') . '</span>%1$s%2$s</div>', $address, $mapHTML ); // WPCS: XSS OK.
						}
				}
		}
endif;

if ( ! function_exists( 'aerospace_event_google_map' ) ) :
		/**
		 * Returns HTML with Google Map button based on address.
		 *
		 * @param  int $id Post ID.
		 */
		function aerospace_event_google_map( $id, $echo = true ) {
				if ( 'events' === get_post_type() ) {
						$address = get_post_meta( $id, '_events_address', true );

						if ( '' !== $address ) {
								$url = esc_url( 'https://www.google.com/maps/search/?api=1&query=' . urlencode( $address ) );
								if ( $echo ) {
										printf( '<a href="%1$s" class="btn btn-xs btn-gray btn-map" target="_blank" rel="nofollow">' . esc_html( 'Map', 'aerospace') . '</a>', $url); // WPCS: XSS OK.
								} else {
										return sprintf( '<a href="%1$s" class="btn btn-xs btn-gray btn-map" target="_blank" rel="nofollow">' . esc_html( 'Map', 'aerospace') . '</a>', $url); // WPCS: XSS OK.
								}
						}
				}
		}
endif;

if ( ! function_exists( 'aerospace_event_hosted_by' ) ) :
	/**
	 * Returns HTML with the host of the event.
	 *
	 * @param  int $id Post ID.
	 */
	function aerospace_event_hosted_by( $id ) {
		if ( 'events' === get_post_type() ) {
			$host = get_post_meta( $id, '_events_hosted_by', true );

			if ( '' !== $host ) {
				printf( '<div class="entry-host"><span class="meta-label">' . esc_html( 'Hosted By', 'aerospace') . '</span>%1$s</div>', $host); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'aerospace_event_register' ) ) :
		/**
		 * Returns HTML with the Register for the event link.
		 *
		 * @param  int $id Post ID.
		 */
		function aerospace_event_register( $id, $subheading = false ) {
				if ( 'events' === get_post_type() ) {
						$url = get_post_meta( $id, '_events_register_url', true );

						if ( $subheading ) {
								$subheading = '<span class="meta-label">' . esc_html__( 'Go to the Event', 'aerospace' ) . '</span>';
						}

						if ( '' !== $url ) {
								$url = esc_url( $url );
								printf( '%2$s<a href="%1$s" class="btn btn-lg btn-orange btn-register" target="_blank" rel="nofollow">' . esc_html( 'Register', 'aerospace') . ' <i class="icon-external-open"></i></a>', $url, $subheading); // WPCS: XSS OK.
						}
				}
		}
endif;

if ( ! function_exists( 'aerospace_event_watch' ) ) :
	/**
	 * Returns HTML with the Watch event block.
	 *
	 * @param  int $id Post ID.
	 */
	function aerospace_event_watch( $id ) {
		if ( 'events' === get_post_type() ) {
			$url = get_post_meta( $id, '_events_video_url', true );

			if ( '' !== $url ) {
				$url = esc_url( $url );
				printf( '<a href="%1$s" class="btn btn-xl btn-gray btn-watch" target="_blank" rel="nofollow"><i class="icon-play icon-ion-ios-play"></i><span>' . esc_html( 'Watch the event', 'aerospace') . '<i class="icon-external-open"></i></span></a>', $url); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'aerospace_post_num' ) ) :
	/**
	 * Returns HTML with total # of posts returned and the current page the user is on.
	 */
	function aerospace_post_num() {
		global $wp_query;
		// Current page.
		$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
		/* translators: 1: number of pages. */
		printf( '<div class="pagination-totals"><span class="meta-label">' . esc_html_x( 'Page', 'aerospace' ) . '</span>' . esc_html_x( '%2$s / %3$s', 'aerospace' ) . '</div>', $wp_query->found_posts, $paged, $wp_query->max_num_pages ); // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'aerospace_return_to_archive' ) ) :
	/**
	 * Returns HTML with link to return to archive of the current post.
	 */
	function aerospace_return_to_archive() {
		$post_type = get_post_type();
		$url = get_post_type_archive_link( $post_type );
		$post_type_obj = get_post_type_object( $post_type );
		$title = apply_filters('post_type_archive_title', $post_type_obj->labels->name );
		/* translators: 1: number of pages. */
		printf( '<div class="return-to-archive"><i class="icon-long-arrow-left"></i> ' . esc_html_x( 'Return to the ', 'aerospace' ) . '<a href="%2$s">%1$s Archive</a></div>', $title, $url ); // WPCS: XSS OK.
	}
endif;

if ( ! function_exists( 'aerospace_data_source' ) ) :
	/**
	 * Returns HTML with data source info and URL if it exists.
	 *
	 * @param  int $id Post ID.
	 */
	function aerospace_data_source( $id ) {
		$post_type = get_post_type();
		if ( 'data' === $post_type ) {
			$sources = get_post_meta( $id, '_data_source', true );
			$url = get_post_meta( $id, '_data_source_url', true );

			if ( '' !== $url ) {
				$url = '<a href="' . esc_url( $url ) . '" class="data-sources-view">' . esc_html__( 'View', 'aerospace' ) . '<i class="icon-external-open"></i></a>';
			}

			if ( '' !== $sources ) {
				printf( '<div class="data-sources"><span class="meta-label">' . esc_html( 'Data Source', 'aerospace') . '</span><p>%1$s%2$s</p></div>', $sources, $url ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'aerospace_sort_filter' ) ) :
	/**
	 * Returns HTML with Sort options for archives and search.
	 */
	function aerospace_sort_filter() {
		global $wp;
		if ( is_search() ) {
			$search = '?s=' . $wp->query_vars['s'];

			if ( $wp->query_vars['cat'] ) {
				$cat = '&cat=' . $wp->query_vars['cat'];
			}

			if ( $wp->query_vars['post_type'] ) {
				$post_type = implode( '&post_type[]=', $wp->query_vars['post_type'] );
				$post_type = '&post_type[]=' . $post_type;
			}

			$url = home_url( $search . $cat . $post_type );
			$param_prefix = '&';
		} else {
			$url = home_url( $wp->request );
			$param_prefix = '?';
		}

		if ( $wp->query_vars['order'] == 'ASC' ) {
			$asc_active = 'active';
			$desc_active = '';
		} else {
			$asc_active = '';
			$desc_active = 'active';
		}

		/* translators: 1: Sort direction. */
		printf( '<div class="sort-filter"><span class="meta-label">' . esc_html_x( 'Sort By:', 'aerospace' ) . '</span><a href="%1$s%2$sorder=DESC" class="%3$s">' . esc_html_x( 'Newest', 'aerospace' ) . '</a><span class="sort-filter-divider">|</span><a href="%1$s%2$sorder=ASC" class="%4$s">' . esc_html_x( 'Oldest', 'aerospace' ) . '</a></div>', $url, $param_prefix, $desc_active, $asc_active ); // WPCS: XSS OK.
	}
endif;

/* get terms limited to post type
 @ $taxonomies - (string|array) (required) The taxonomies to retrieve terms from.
 @ $args  -  (string|array) all Possible Arguments of get_terms http://codex.wordpress.org/Function_Reference/get_terms
 @ $post_type - (string|array) of post types to limit the terms to
 @ $fields - (string) What to return (default all) accepts ID,name,all,get_terms.
 if you want to use get_terms arguments then $fields must be set to 'get_terms'
*/
function get_terms_by_post_type( $taxonomies, $post_type, $fields = 'all' ){
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1
    );
    $query = new WP_Query( $args );
    $terms = array();
    $terms_ids = array();
    while ( $query->have_posts() ) {
        $query->the_post();
        $current_terms = wp_get_post_terms( $query->post->ID, $taxonomies, array("fields" => $fields ) );
        foreach ($current_terms as $t){
		    //avoid duplicates
		    if ( in_array( $t->term_id, $terms_ids ) ){
		    	$terms[$t->term_id]->count = $terms[$t->term_id]->count + 1;
		    } else {
		        $t->count = 1;
		        $terms[$t->term_id] = $t;
		        $terms_ids[] = $t->term_id;

		    }

		}
    }
   	wp_reset_postdata();

    //return array of term objects
    if ($fields == "all")
        return $terms;
    //return array of term ID's
    if ($fields == "ids"){
        foreach ($terms as $t){
            $re[] = $t->term_id;
        }
        return $re;
    }
    //return array of term names
    if ($fields == "name"){
        foreach ($terms as $t){
            $re[] = $t->name;
        }
        return $re;
    }
    // get terms with get_terms arguments
    if ($fields == "get_terms"){
        $terms2 = get_terms( $taxonomies, $args );
        foreach ($terms as $t){
            if (in_array($t,$terms2)){
                $re[] = $t;
            }
        }
        return $re;
    }
}

if (! function_exists('aerospace_data_last_updated') ) :
	/**
	 * Prints last updated information timestamp only. This is used to sort the Data Repo.
	 */
	function aerospace_data_last_updated()
	{
		$time_string = '%1$s';
		$time_string = sprintf( $time_string,
				esc_attr( get_the_modified_date( 'c' ) )
		);
		echo $time_string; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'aerospace_event_add_to_calendar' ) ) :
	/**
	 * Returns HTML with Add to Calendar Buttons.
	 *
	 * @param  int $id Post ID.
	 */
	function aerospace_event_add_to_calendar( $id ) {
		if ( 'events' === get_post_type() ) {
			$register_url = get_post_meta( $id, '_events_register_url', true );
			$hosted_by = get_post_meta( $id, '_events_hosted_by', true );
			$start_date = get_post_meta( $id, '_events_start_date', true );
			$end_date = get_post_meta( $id, '_events_end_date', true );
			$time = get_post_meta( $id, '_events_time', true );
			$address = get_post_meta( $id, '_events_address', true );

			$title = get_the_title( $id );
			$excerpt = get_the_excerpt( $id );


			if ( '' !== $start_date ) {

				$times = explode( '-', $time);

				$description = 'Register Link: ' . esc_url ( $register_url ) . '<br />' . $excerpt;

				printf( '<div title="Add to Calendar" class="addeventatc meta-label" data-render="inline-buttons">
					    Add to Calendar
					    <span class="start">%1$s %6$s</span>
					    <span class="end">%2$s %7$s</span>
					    <span class="timezone">America/New_York</span>
					    <span class="title">%4$s</span>
					    <span class="description">%5$s</span>
					    <span class="location">%3$s</span>
					    <span class="calname">use-title</span>
					</div>', $start_date, $end_date, $address, $title, $description, $times[0], $times[1]); // WPCS: XSS OK.
			}
		}
	}
endif;
