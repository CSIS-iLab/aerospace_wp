<?php
/**
*Custom Post Types: Aerospace_101
*
*@package aerospace
*/

/*----------  Register Custom Post Type  ----------*/
function aerospace_cpt_data() {

	$labels = array(
		'name'                  => _x( 'Aerospace_101', 'Post Type General Name', 'aerospace' ),
		'singular_name'         => _x( 'Aerospace_101', 'Post Type Singular Name', 'aerospace' ),
		'menu_name'             => __( 'ASP 101', 'aerospace' ),
		'name_admin_bar'        => __( 'ASP 101', 'aerospace' ),
		'archives'              => __( 'Aerospace_101 Archives', 'aerospace' ),
		'attributes'            => __( 'Aerospace_101 Attributes', 'aerospace' ),
		'parent_item_colon'     => __( 'Parent Aerospace_101', 'aerospace' ),
		'all_items'             => __( 'All Aerospace_101', 'aerospace' ),
		'add_new_item'          => __( 'Add New Aerospace_101', 'aerospace' ),
		'add_new'               => __( 'Add Aerospace_101', 'aerospace' ),
		'new_item'              => __( 'New Aerospace_101', 'aerospace' ),
		'edit_item'             => __( 'Edit Aerospace_101', 'aerospace' ),
		'update_item'           => __( 'Update Aerospace_101', 'aerospace' ),
		'view_item'             => __( 'View Aerospace_101', 'aerospace' ),
		'view_items'            => __( 'View Aerospace_101', 'aerospace' ),
		'search_items'          => __( 'Search Aerospace_101', 'aerospace' ),
		'not_found'             => __( 'Not found', 'aerospace' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'aerospace' ),
		'featured_image'        => __( 'Featured Image', 'aerospace' ),
		'set_featured_image'    => __( 'Set featured image', 'aerospace' ),
		'remove_featured_image' => __( 'Remove featured image', 'aerospace' ),
		'use_featured_image'    => __( 'Use as featured image', 'aerospace' ),
		'insert_into_item'      => __( 'Insert into aerospace_101', 'aerospace' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Aerospace_101', 'aerospace' ),
		'items_list'            => __( 'Aerospace_101 list', 'aerospace' ),
		'items_list_navigation' => __( 'Aerospace_101 list navigation', 'aerospace' ),
		'filter_items_list'     => __( 'Filter Aerospace_101 list', 'aerospace' ),
	);
	$args = array(
		'label'                 => __( 'Aerospace_101', 'aerospace' ),
		'description'           => __( 'Aerospace_101', 'aerospace' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'Aerospace_101', $args );

}
add_action( 'init', 'aerospace_cpt_data', 0 );
