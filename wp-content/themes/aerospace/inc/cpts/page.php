<?php
/**
 * Custom Post Types: Page
 *
 * @package Aerospace
 */



/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function page_add_meta_boxes( $post ) {
	add_meta_box( 'page_meta_box', __( 'Page Information', 'aerospace' ), 'page_build_meta_box', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes_page', 'page_add_meta_boxes' );

/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function page_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'page_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_is_featured = get_post_meta( $post->ID, '_post_is_featured', true );

	?>
	<div class='inside'>
		<h3><?php _e( 'Is Featured?', 'aerospace' ); ?></h3>
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
function page_save_meta_box_data( $post_id ) {
	// Verify meta box nonce.
	if ( ! isset( $_POST['page_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['page_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
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

	// Is Featured?
	if ( isset( $_REQUEST['is_featured'] ) ) {
		update_post_meta( $post_id, '_post_is_featured', intval( wp_unslash( $_POST['is_featured'] ) ) );
	} else {
		update_post_meta( $post_id, '_post_is_featured', 0 );
	}


}
add_action( 'save_post', 'page_save_meta_box_data' );
