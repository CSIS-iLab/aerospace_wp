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

/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function events_add_meta_boxes( $post ){
	add_meta_box( 'events_meta_box', __( 'Events Information', 'aerospace' ), 'events_build_meta_box', 'events', 'normal', 'high' );
}
add_action( 'add_meta_boxes_events', 'events_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function events_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'events_meta_box_nonce' );
	// Retrieve current value of fields
	$current_aerospace_sponsored = get_post_meta( $post->ID, '_events_aerospace_sponsored', true );
	$current_location = get_post_meta( $post->ID, '_events_location', true );
	$current_register_url = get_post_meta( $post->ID, '_events_register_url', true );
	?>
	<div class='inside'>
		<h3><?php _e( 'Aerospace Sponsored', 'aerospace' ); ?></h3>
		<p>
			<input type="checkbox" name="aerospace_sponsored" value="1" <?php checked( $current_aerospace_sponsored, '1' ); ?> /> Aerospace Sponsored
		</p>

		<h3><?php _e( 'Location', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="location" value="<?php echo $current_location; ?>" />
		</p>

		<h3><?php _e( 'Register URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="url" value="<?php echo $current_register_url; ?>" />
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
function events_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['events_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['events_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	// Source
	if ( isset( $_REQUEST['aerospace_sponsored'] ) ) {
		update_post_meta( $post_id, '_events_aerospace_sponsored', sanitize_text_field( $_POST['aerospace_sponsored'] ) );
	}
	// Width
	if ( isset( $_REQUEST['location'] ) ) {
		update_post_meta( $post_id, '_events_location', sanitize_text_field( $_POST['location'] ) );
	}
	// URL
	if ( isset( $_REQUEST['url'] ) ) {
		update_post_meta( $post_id, '_events_register_url', esc_url( $_POST['url'] ) );
	}
}
add_action( 'save_post_events', 'events_save_meta_box_data' );
