<?php
/**
*Custom Post Types: Events
*
*@package aerospace
*/

/*----------  Register Custom Post Type  ----------*/
// Register Custom Post Type
function aerospace_cpt_events() {

	$labels = array(
		'name'                  => _x( 'Events', 'Post Type General Name', 'aerospace' ),
		'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'aerospace' ),
		'menu_name'             => __( 'Events', 'aerospace' ),
		'name_admin_bar'        => __( 'Events', 'aerospace' ),
		'archives'              => __( 'Events Archives', 'aerospace' ),
		'attributes'            => __( 'Events Attributes', 'aerospace' ),
		'parent_item_colon'     => __( 'Parent Event', 'aerospace' ),
		'all_items'             => __( 'All Events', 'aerospace' ),
		'add_new_item'          => __( 'Add New Event', 'aerospace' ),
		'add_new'               => __( 'Add Event', 'aerospace' ),
		'new_item'              => __( 'New Event', 'aerospace' ),
		'edit_item'             => __( 'Edit Event', 'aerospace' ),
		'update_item'           => __( 'Update Event', 'aerospace' ),
		'view_item'             => __( 'View Event', 'aerospace' ),
		'view_items'            => __( 'View Events', 'aerospace' ),
		'search_items'          => __( 'Search Event', 'aerospace' ),
		'not_found'             => __( 'Not found', 'aerospace' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'aerospace' ),
		'featured_image'        => __( 'Featured Image', 'aerospace' ),
		'set_featured_image'    => __( 'Set featured image', 'aerospace' ),
		'remove_featured_image' => __( 'Remove featured image', 'aerospace' ),
		'use_featured_image'    => __( 'Use as featured image', 'aerospace' ),
		'insert_into_item'      => __( 'Insert into Event', 'aerospace' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Event', 'aerospace' ),
		'items_list'            => __( 'Events list', 'aerospace' ),
		'items_list_navigation' => __( 'Events list navigation', 'aerospace' ),
		'filter_items_list'     => __( 'Filter Events list', 'aerospace' ),
	);
	$args = array(
		'label'                 => __( 'Event', 'aerospace' ),
		'description'           => __( 'Events', 'aerospace' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', ),
		'taxonomies'            => array( 'post_tag' ),
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
	register_post_type( 'events', $args );

}
add_action( 'init', 'aerospace_cpt_events', 0 );
