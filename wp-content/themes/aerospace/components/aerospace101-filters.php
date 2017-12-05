<?php
/**
 * Filter by Tag - Aerospace
 *
 * @package Aerospace
 */

// Get the tag list for Aerospace101 posts only.
$filter_terms = get_terms_by_post_type( 'post_tag', 'aerospace101', 'all' );

$url = home_url( $wp->request );
$tag_id = get_query_var( 'tid' );

$total_terms = count($filter_terms) - 1;
$display_limit = get_option( 'aerospace_archives_aerospace101_filter_limit' );

$archive_url = get_post_type_archive_link( 'aerospace101' );

?>

<h3 class="subheading"><?php esc_html_e( 'Filter by Tag', 'aerospace' ); ?></h3>
<ul class="filter-sidebar-list">
<?php
	$i = 0;
	foreach( $filter_terms as $term ) {
		$tag_url = $url . '?tid=' . $term->term_id;
		$class = '';

		if ( $term->term_id == $tag_id ) {
			$class .= 'active';
		}

		if ( $i === $display_limit) {
			echo '<li class="filter-sidebar-list-showmore">
				<span class="filter-sidebar-list-showmore-more"><i class="icon-plus"></i>' . esc_html__( 'See More', 'aerospace' ) . '</span>
				<span class="filter-sidebar-list-showmore-less is-hidden"><i class="icon-minus"></i>' . esc_html__( 'See Less', 'aerospace' ) . '</span>
			</li>';
			$class .= ' below-display-limit is-hidden ';
		} elseif ( $i >= $display_limit ) {
			$class .= ' below-display-limit is-hidden ';
		}

		echo '<li class="' . $class . '"><a href="' . esc_url( $tag_url ) . '">' . $term->name . ' (' . $term->count . ')</a></li>';
		$i++;
	}
?>
</ul>
<?php if ( $tag_id ) { ?>
<a href="<?php echo esc_url( $archive_url ); ?>" class="filter-sidebar-remove-filter">Remove Filters</a>
<?php } ?>
