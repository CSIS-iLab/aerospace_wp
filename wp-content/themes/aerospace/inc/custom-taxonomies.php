<?php
/**
 * Custom Post Taxonomy for posts.
 *
 * @package aerospace
 */

// Custom Type Taxonomy for Aerospace 101 posts.
function aerospace_post_types() {

	$labels = array(
		'name'                       => _x( 'Types', 'Taxonomy General Name', 'aerospace' ),
		'singular_name'              => _x( 'Type', 'Taxonomy Singular Name', 'aerospace' ),
		'menu_name'                  => __( 'Types', 'aerospace' ),
		'all_items'                  => __( 'Types', 'aerospace' ),
		'parent_item'                => __( 'Type', 'aerospace' ),
		'parent_item_colon'          => __( 'Type:', 'aerospace' ),
		'new_item_name'              => __( 'New Type', 'aerospace' ),
		'add_new_item'               => __( 'Add Type', 'aerospace' ),
		'edit_item'                  => __( 'Edit Type', 'aerospace' ),
		'update_item'                => __( 'Update Type', 'aerospace' ),
		'view_item'                  => __( 'View Type', 'aerospace' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'aerospace' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'aerospace' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'aerospace' ),
		'popular_items'              => __( 'Popular Types', 'aerospace' ),
		'search_items'               => __( 'Search Types', 'aerospace' ),
		'not_found'                  => __( 'Not Found', 'aerospace' ),
		'no_terms'                   => __( 'No types', 'aerospace' ),
		'items_list'                 => __( 'Types list', 'aerospace' ),
		'items_list_navigation'      => __( 'Types list navigation', 'aerospace' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_typecloud'              => true,
	);
	register_taxonomy( 'post_types', array( 'post' ), $args );
}

add_action( 'init', 'aerospace_post_types', 0 );
