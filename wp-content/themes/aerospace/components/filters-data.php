<?php
/**
 * Filters for Data Repo posts
 *
 * @package Aerospace
 */

// Get the category & tag lists for Data posts only.
$categories = get_terms_by_post_type( 'category', 'data', 'all' );
$tags = get_terms_by_post_type( 'post_tag', 'data', 'all' );

$url = home_url( $wp->request );
$tag_id = get_query_var( 'tid' );


$archive_url = get_post_type_archive_link( 'aerospace101' );

?>

<label for="data-categories" class="filter-label"><?php esc_html_e( 'Filter by Category' , 'aerospace' ); ?></label>
<div class="dropdown-container">
	<select name="data-categories" class="filter-select data-categories" id="data-categories">
		<option value="" selected>Choose a category</option>
		<?php
			foreach( $categories as $term ) {
				echo '<option value="' . $term->name . '">' . $term->name . ' (' . $term->count . ')</option>';
			}
		?>
	</select>
</div>

<label for="data-tags" class="filter-label"><?php esc_html_e( 'Filter by Keyword' , 'aerospace' ); ?></label>
<div class="dropdown-container">
	<select name="data-tags" class="filter-select data-tags" id="data-tags">
		<option value="" selected>Choose a keyword</option>
		<?php
			foreach( $tags as $term ) {
				echo '<option value="' . $term->name . '">' . $term->name . ' (' . $term->count . ')</option>';
			}
		?>
	</select>
</div>

<div class="filter-search-container">
	<label for="dataSearch" class="filter-label">Search</label>
	<input id="dataSearch" class="filter-input" name="dataSearch" type="text" placeholder="Search the data..." />
</div>
