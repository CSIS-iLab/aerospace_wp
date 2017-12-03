<?php
/**
 * Filters for Search Page
 *
 * @package Aerospace
 */

$categories_args = array(
	'show_option_none' => 'Choose a category',
	'orderby' => 'name',
	'class' => 'filter-select search-categories',
	'id' => 'search-categories'
);
?>

<label for="search-categories" class="filter-label"><?php esc_html_e( 'Filter by Category' , 'aerospace' ); ?></label>
<div class="dropdown-container">
	<?php wp_dropdown_categories( $categories_args ); ?>
</div>

<label for="post_type" class="filter-label">Filter by Type</label>

<div class="filter-search-container">
	<label for="s" class="filter-label">Search</label>
	<?php get_search_form(); ?>
</div>