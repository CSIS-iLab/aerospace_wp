<?php
/**
 * Filters for Data Repo posts
 *
 * @package Aerospace
 */

// Get the tag list for Aerospace101 posts only.
$filter_terms = get_terms_by_post_type( 'post_tag', 'data', 'all' );

$url = home_url( $wp->request );
$tag_id = get_query_var( 'tid' );

$total_terms = count($filter_terms) - 1;
$display_limit = 2;

$archive_url = get_post_type_archive_link( 'aerospace101' );

?>

<!-- <label for="data-categories" class="filter-label"><?php esc_html__( 'Filter by Category' , 'aerospace' ); ?></label>
<select name="data-categories">
</select> -->

<label for="data-tags" class="filter-label"><?php esc_html__( 'Filter by Keyword' , 'aerospace' ); ?></label>
<select name="data-tags" class="data-tags">
<option selected disabled>Choose a category</option>
<?php
	$i = 0;
	foreach( $filter_terms as $term ) {
		echo '<option value="' . $term->name . '">' . $term->name . ' (' . $term->count . ')</option>';
		$i++;
	}
?>
</select>
