<?php
/**
*Custom Post Types: Aerospace 101
*
*@package aerospace
*/

/*----------  Register Custom Post Type  ----------*/
function aerospace_cpt_aerospace101() {

	$labels = array(
		'name'                  => _x( 'Aerospace 101', 'Post Type General Name', 'aerospace' ),
		'singular_name'         => _x( 'Aerospace 101', 'Post Type Singular Name', 'aerospace' ),
		'menu_name'             => __( 'ASP 101', 'aerospace' ),
		'name_admin_bar'        => __( 'ASP 101', 'aerospace' ),
		'archives'              => __( 'Aerospace 101 Archives', 'aerospace' ),
		'attributes'            => __( 'Aerospace 101 Attributes', 'aerospace' ),
		'parent_item_colon'     => __( 'Parent Aerospace 101', 'aerospace' ),
		'all_items'             => __( 'All Aerospace 101', 'aerospace' ),
		'add_new_item'          => __( 'Add New Aerospace 101', 'aerospace' ),
		'add_new'               => __( 'Add Aerospace 101', 'aerospace' ),
		'new_item'              => __( 'New Aerospace 101', 'aerospace' ),
		'edit_item'             => __( 'Edit Aerospace 101', 'aerospace' ),
		'update_item'           => __( 'Update Aerospace 101', 'aerospace' ),
		'view_item'             => __( 'View Aerospace 101', 'aerospace' ),
		'view_items'            => __( 'View Aerospace 101', 'aerospace' ),
		'search_items'          => __( 'Search Aerospace 101', 'aerospace' ),
		'not_found'             => __( 'Not found', 'aerospace' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'aerospace' ),
		'featured_image'        => __( 'Featured Image', 'aerospace' ),
		'set_featured_image'    => __( 'Set featured image', 'aerospace' ),
		'remove_featured_image' => __( 'Remove featured image', 'aerospace' ),
		'use_featured_image'    => __( 'Use as featured image', 'aerospace' ),
		'insert_into_item'      => __( 'Insert into Aerospace 101', 'aerospace' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Aerospace 101', 'aerospace' ),
		'items_list'            => __( 'Aerospace 101 list', 'aerospace' ),
		'items_list_navigation' => __( 'Aerospace 101 list navigation', 'aerospace' ),
		'filter_items_list'     => __( 'Filter Aerospace 101 list', 'aerospace' ),
	);
	$args = array(
		'label'                 => __( 'Aerospace 101', 'aerospace' ),
		'description'           => __( 'Aerospace 101', 'aerospace' ),
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
	register_post_type( 'aerospace101', $args );

}
add_action( 'init', 'aerospace_cpt_aerospace101', 0 );

/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function aerospace101_add_meta_boxes( $post ){
	add_meta_box( 'aerospace101_meta_box', __( 'Aerospace 101 Information', 'aerospace' ), 'aerospace101_build_meta_box', 'aerospace101', 'normal', 'high' );
}
add_action( 'add_meta_boxes_aerospace101', 'aerospace101_add_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function aerospace101_build_meta_box( $post ){
    wp_nonce_field( basename(__FILE__), 'aerospace101_meta_box_nonce' );

    // Retrieve current value of fields
    $current_sources = get_post_meta( $post->ID, '_post_sources', true );

    ?>

	<div class='inside'>
		<h3><?php _e( 'Sources', 'aerospace' ); ?></h3>
		<p>
			<textarea name="sources" class="large-text"><?php echo $current_sources; ?></textarea>
		</p>

	</div>
	<?php
}
/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/save_post
 */
function aerospace101_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['aerospace101_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['aerospace101_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}
    // Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}
	// Store custom fields values
<<<<<<< HEAD
	// Sources
=======
	// URL
>>>>>>> 05f651693aa802f0bec67450de58dfe4c051f4f3
	if ( isset( $_REQUEST['sources'] ) ) {
		update_post_meta( $post_id, '_post_sources', sanitize_text_field( $_POST['sources'] ) );
	}
}
add_action( 'save_post_aerospace101', 'aerospace101_save_meta_box_data' );
