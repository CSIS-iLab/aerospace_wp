<?php
/**
 * Filters for Search Page
 *
 * @package Aerospace
 */

$selected_category = get_query_var( 'cat' );
$categories_args = array(
	'show_option_none' => 'Choose a category',
	'show_option_all' => 'All Categories',
	'orderby' => 'name',
	'class' => 'filter-select search-categories',
	'id' => 'search-categories',
	'selected' => $selected_category
);

$selected_post_types = get_query_var( 'post_type' );
$post_types_labels = array( 
	'post' => 'Articles',
	'aerospace101' => 'Aerospace 101',
	'data' => 'Data Repository',
	'events' => 'Events'
);
asort($post_types_labels);

echo $selected_post_types;

?>

<label for="search-categories" class="filter-label"><?php esc_html_e( 'Filter by Category' , 'aerospace' ); ?></label>
<div class="dropdown-container">
	<?php wp_dropdown_categories( $categories_args ); ?>
</div>

<div class="filter-post-types">
	<label for="post_type" class="filter-label">Filter by Type</label>
	<?php
	foreach( $post_types_labels as $post_type => $label ) {
		if ( in_array( $post_type, $selected_post_types) ) {
			$checked = 'checked';
		} else {
			$checked = '';
		}
		echo '<div class="control">
		<input type="checkbox" id="' . $post_type . '" name="post_type" class="control__input" value="' . $post_type . '" ' . $checked . '>
		<label for="' . $post_type . '" class="filter-checkbox control__label">' . $label . '</label>
		</div>';
	}
	?>
</div>

<div class="filter-search-container">
	<label for="s" class="filter-label">Search</label>
	<?php get_search_form(); ?>
</div>