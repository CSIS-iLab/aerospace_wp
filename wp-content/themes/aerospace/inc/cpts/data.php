<?php
/**
*Custom Post Types: Aerospace 101
*
*@package aerospace
*/

/*----------  Register Custom Post Type  ----------*/
function aerospace_cpt_data() {

	$labels = array(
		'name'                  => _x( 'Data', 'Post Type General Name', 'aerospace' ),
		'singular_name'         => _x( 'Data', 'Post Type Singular Name', 'aerospace' ),
		'menu_name'             => __( 'Data Repo', 'aerospace' ),
		'name_admin_bar'        => __( 'Data Repo', 'aerospace' ),
		'archives'              => __( 'Data Archives', 'aerospace' ),
		'attributes'            => __( 'Data Attributes', 'aerospace' ),
		'parent_item_colon'     => __( 'Parent Data', 'aerospace' ),
		'all_items'             => __( 'All Data', 'aerospace' ),
		'add_new_item'          => __( 'Add New Data', 'aerospace' ),
		'add_new'               => __( 'Add Data', 'aerospace' ),
		'new_item'              => __( 'New Data', 'aerospace' ),
		'edit_item'             => __( 'Edit Data', 'aerospace' ),
		'update_item'           => __( 'Update Data', 'aerospace' ),
		'view_item'             => __( 'View Data', 'aerospace' ),
		'view_items'            => __( 'View Data', 'aerospace' ),
		'search_items'          => __( 'Search Data', 'aerospace' ),
		'not_found'             => __( 'Not found', 'aerospace' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'aerospace' ),
		'featured_image'        => __( 'Featured Image', 'aerospace' ),
		'set_featured_image'    => __( 'Set featured image', 'aerospace' ),
		'remove_featured_image' => __( 'Remove featured image', 'aerospace' ),
		'use_featured_image'    => __( 'Use as featured image', 'aerospace' ),
		'insert_into_item'      => __( 'Insert into Data', 'aerospace' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Data', 'aerospace' ),
		'items_list'            => __( 'Data list', 'aerospace' ),
		'items_list_navigation' => __( 'Data list navigation', 'aerospace' ),
		'filter_items_list'     => __( 'Filter Data list', 'aerospace' ),
	);
	$args = array(
		'label'                 => __( 'Data', 'aerospace' ),
		'description'           => __( 'Data', 'aerospace' ),
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
	register_post_type( 'data', $args );

}
add_action( 'init', 'aerospace_cpt_data', 0 );
