<?php
/**
 * Custom Post Types: Events
 *
 * @package Aerospace
 */

/**
 * Register custom post type
 */
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
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-calendar-alt',
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
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function events_add_meta_boxes( $post ) {
	add_meta_box( 'events_meta_box', __( 'Events Information', 'aerospace' ), 'events_build_meta_box', 'events', 'normal', 'high' );
}
add_action( 'add_meta_boxes_events', 'events_add_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function events_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'events_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_aerospace_sponsored = get_post_meta( $post->ID, '_events_aerospace_sponsored', true );
	$current_location = get_post_meta( $post->ID, '_events_location', true );
	$current_register_url = get_post_meta( $post->ID, '_events_register_url', true );
	$current_hosted_by = get_post_meta( $post->ID, '_events_hosted_by', true );
	$current_start_date = get_post_meta( $post->ID, '_events_start_date', true );
	$current_end_date = get_post_meta( $post->ID, '_events_end_date', true );
	$current_time = get_post_meta( $post->ID, '_events_time', true );
	$current_address = get_post_meta( $post->ID, '_events_address', true );
	$current_video_url = get_post_meta( $post->ID, '_events_video_url', true );
	$current_is_featured = get_post_meta( $post->ID, '_post_is_featured', true );

	?>
	<div class='inside'>
		<h3><?php esc_html_e( 'Aerospace Sponsored', 'aerospace' ); ?></h3>
		<p>
			<input type="checkbox" name="aerospace_sponsored" value="1" <?php checked( $current_aerospace_sponsored, '1' ); ?> /> Aerospace Sponsored
		</p>

		<h3><?php esc_html_e( 'Location', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="location" value="<?php echo esc_attr( $current_location ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Register URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="url" value="<?php echo esc_url( $current_register_url ); ?>" />
		</p>
		<h3><?php esc_html_e( 'Sponsored By', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="hosted_by" value="<?php echo esc_attr( $current_hosted_by ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Event Dates', 'aerospace' ); ?></h3>
		<p>
			<label for="start_date"><?php esc_html_e( 'Start Date:', 'aerospace' ); ?></label> <input type="date" class="medium-text" name="start_date" value="<?php echo esc_attr( $current_start_date ); ?>" /><br />
			<label for="end_date"><?php esc_html_e( 'End Date:', 'aerospace' ); ?></label> <input type="date" class="medium-text" name="end_date" value="<?php echo esc_attr( $current_end_date ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Time', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="medium-text" name="time" value="<?php echo esc_attr( $current_time ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Address', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="address" value="<?php echo esc_attr( $current_address ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Event Video URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="video_url" value="<?php echo esc_url( $current_video_url ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Is Featured?', 'aerospace' ); ?></h3>
		<p>
			<input type="checkbox" name="is_featured" value="1" <?php checked( $current_is_featured, '1' ); ?> /> Is Featured?
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
function events_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['events_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['events_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
		return;
	}
	// Return if autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	// Source.
	if ( isset( $_REQUEST['aerospace_sponsored'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_events_aerospace_sponsored', intval( wp_unslash( $_POST['aerospace_sponsored'] ) ) ); // Input var okay.
	} else {
		update_post_meta( $post_id, '_events_aerospace_sponsored', '' );
	}
	// Width.
	if ( isset( $_REQUEST['location'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_events_location', sanitize_text_field( wp_unslash( $_POST['location'] ) ) );  // Input var okay.
	}
	// URL.
	if ( isset( $_REQUEST['url'] ) ) {  // Input var okay.
		update_post_meta( $post_id, '_events_register_url', esc_url_raw( wp_unslash( $_POST['url'] ) ) );  // Input var okay.
	}
	// Sponsored By
	if ( isset( $_REQUEST['hosted_by'] ) ) {
		update_post_meta( $post_id, '_events_hosted_by', sanitize_text_field( $_POST['hosted_by'] ) );
	}
	// Start Date
	if ( isset( $_REQUEST['start_date'] ) ) { // Input var okay.
		$start_date = sanitize_text_field( wp_unslash( $_POST['start_date'] ) ); // Input var okay.
		$date = explode( '-', $start_date );
		if ( wp_checkdate( $date[1], $date[2], $date[0], $start_date ) || empty( $start_date ) ) {
			update_post_meta( $post_id, '_events_start_date', $start_date ); // Input var okay.
		}
	}
	// End Date
	if ( isset( $_REQUEST['end_date'] ) ) { // Input var okay.
		$end_date = sanitize_text_field( wp_unslash( $_POST['end_date'] ) ); // Input var okay.
		$date = explode( '-', $end_date );
		if ( wp_checkdate( $date[1], $date[2], $date[0], $end_date ) || empty( $end_date ) ) {
			update_post_meta( $post_id, '_events_end_date', $end_date ); // Input var okay.
		}
	}
	// Time
	if ( isset( $_REQUEST['time'] ) ) {
		update_post_meta( $post_id, '_events_time', sanitize_text_field( $_POST['time'] ) );
	}
	// Address
	if ( isset( $_REQUEST['address'] ) ) {
		update_post_meta( $post_id, '_events_address', sanitize_text_field( $_POST['address'] ) );
	}
	// Event Video URL
	if ( isset( $_REQUEST['video_url'] ) ) {
		update_post_meta( $post_id, '_events_video_url', esc_url( $_POST['video_url'] ) );
	}
	// Is Featured?
	if ( isset( $_REQUEST['is_featured'] ) ) {
		update_post_meta( $post_id, '_post_is_featured', sanitize_text_field( $_POST['is_featured'] ) );
	}

}
add_action( 'save_post_events', 'events_save_meta_box_data' );
