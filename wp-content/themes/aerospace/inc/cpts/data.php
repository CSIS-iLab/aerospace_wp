<?php
/**
 * Custom Post Types: Data
 *
 * @package aerospace
 */

/**
 * Register custom post type: data
 */
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
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-chart-area',
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

/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object.
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function data_add_meta_boxes( $post ) {
	add_meta_box( 'data_meta_box', __( 'Data Information', 'aerospace' ), 'data_build_meta_box', 'data', 'normal', 'high' );
}
add_action( 'add_meta_boxes_data', 'data_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object.
 */
function data_build_meta_box( $post ) {
	// Make sure the form request comes from WordPress.
	wp_nonce_field( basename( __FILE__ ), 'data_meta_box_nonce' );

	// Retrieve current value of fields.
	$current_source = get_post_meta( $post->ID, '_data_source', true );
	$current_url = get_post_meta( $post->ID, '_data_url', true );
	$current_width = get_post_meta( $post->ID, '_data_width', true );
	$current_height = get_post_meta( $post->ID, '_data_height', true );
	$current_iframe_resize_disabled = get_post_meta( $post->ID, '_data_iframe_resize_disabled', true );
	$current_fallback_img_disabled = get_post_meta( $post->ID, '_data_fallback_img_disabled', true );
	$current_title = get_post_meta( $post->ID, '_data_title', true );
	$current_img_url = get_post_meta( $post->ID, '_data_img_url', true );
	$current_content_placement = get_post_meta( $post->ID, '_data_content_placement', true );
	$current_source_url = get_post_meta( $post->ID, '_data_source_url', true );
	$current_is_featured = get_post_meta( $post->ID, '_post_is_featured', true );
	$current_twitter_pic_url = get_post_meta( $post->ID, '_data_twitter_pic_url', true );

	?>
	<div class='inside'>
		<h3><?php esc_html_e( 'Source', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="source" value="<?php echo esc_attr( $current_source ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Interactive URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="url" value="<?php echo esc_url( $current_url ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Interactive Width', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="width" value="<?php echo esc_attr( $current_width ); ?>" />
		</p>

		<h3><?php esc_html_e( 'Interactive Height', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="height" value="<?php echo esc_attr( $current_height ); ?>" />
		</p>
		<p>
			<input type="checkbox" name="iframe_resize_disabled" value="1" <?php checked( $current_iframe_resize_disabled, '1' ); ?> /> iFrame Resize Disabled
		</p>

		<h3><?php esc_html_e( 'Fallback Image', 'aerospace' ); ?></h3>
		<p>
			<input type="checkbox" name="fallback_img_disabled" value="1" <?php checked( $current_fallback_img_disabled, '1' ); ?> /> Fallback Image Disabled
		</p>

		<h3><?php _e( 'Interactive Title', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="title" value="<?php echo $current_title; ?>" />
		</p>

		<h3><?php _e( 'Interactive Image URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="img_url" value="<?php echo $current_img_url; ?>" />
		</p>

		<h3><?php _e( 'Content Placement', 'aerospace' ); ?></h3>
		<p>
			<input type="radio" name="above" value="above" <?php checked( $current_content_placement, 'above' ); ?> /> Above <br>
			<input type="radio" name="below" value="below" <?php checked( $current_content_placement, 'below' ); ?> /> Below
		</p>

		<h3><?php _e( 'Source URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="source_url" value="<?php echo $current_source_url; ?>" />
		</p>

		<h3><?php _e( 'Is Featured?', 'aerospace' ); ?></h3>
		<p>
			<input type="checkbox" name="is_featured" value="1" <?php checked( $current_is_featured, '1' ); ?> /> Is Featured?
		</p>

		<h3><?php _e( 'Twitter Pic', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="twitter_pic_url" value="<?php echo $current_twitter_pic_url; ?>" />
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
function data_save_meta_box_data( $post_id ){
	// Verify meta box nonce.
	if ( ! isset( $_POST['data_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( wp_unslash( $_POST['data_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) { // Input var okay.
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
	if ( isset( $_REQUEST['source'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_data_source', sanitize_text_field( wp_unslash( $_POST['source'] ) ) ); // Input var okay.
	}
	// URL
	if ( isset( $_REQUEST['url'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_data_url', esc_url_raw( wp_unslash( $_POST['url'] ) ) ); // Input var okay.
	}
	// Width
	if ( isset( $_REQUEST['width'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_data_width', sanitize_text_field( wp_unslash( $_POST['width'] ) ) ); // Input var okay.
	}
	// Height
	if ( isset( $_REQUEST['height'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_data_height', sanitize_text_field( wp_unslash( $_POST['height'] ) ) ); // Input var okay.
	}
	// Disable iFrame Resizing
	if ( isset( $_REQUEST['iframe_resize_disabled'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_data_iframe_resize_disabled', intval( wp_unslash( $_POST['iframe_resize_disabled'] ) ) ); // Input var okay.
	} else {
		update_post_meta( $post_id, '_data_iframe_resize_disabled', '' ); // Input var okay.
	}
	// Disable Fallback Image
	if ( isset( $_REQUEST['fallback_img_disabled'] ) ) { // Input var okay.
		update_post_meta( $post_id, '_data_fallback_img_disabled', intval( wp_unslash( $_POST['fallback_img_disabled'] ) ) ); // Input var okay.
	} else {
		update_post_meta( $post_id, '_data_fallback_img_disabled', '' );
	}
	// Title
	if ( isset( $_REQUEST['title'] ) ) {
		update_post_meta( $post_id, '_data_title', sanitize_text_field( $_POST['title'] ) );
	}
	// Image URL
	if ( isset( $_REQUEST['img_url'] ) ) {
		update_post_meta( $post_id, '_data_img_url', esc_url( $_POST['img_url'] ) );
	}
	// Content Placement
	if ( isset( $_REQUEST['content_placement'] ) ) {
		update_post_meta( $post_id, '_data_content_placement', sanitize_text_field( $_POST['content_placement'] ) );
	}
	// Source URL
	if ( isset( $_REQUEST['source_url'] ) ) {
		update_post_meta( $post_id, '_data_source_url', esc_url( $_POST['source_url'] ) );
	}
	// Is Featured?
	if ( isset( $_REQUEST['is_featured'] ) ) {
		update_post_meta( $post_id, '_post_is_featured', '' );
	}
	// Twitter Pic
	if ( isset( $_REQUEST['twitter_pic_url'] ) ) {
		update_post_meta( $post_id, '_data_twitter_pic_url', esc_url( $_POST['twitter_pic_url'] ) );
	}
}
add_action( 'save_post_data', 'data_save_meta_box_data' );

/*----------  Display iFrame  ----------*/
/**
 * Displays the specified interactive in an iframe
 *
 * @param  String  $interactive_url       URL to the interactive.
 * @param  String  $width                Width of the iframe, can be in px or %.
 * @param  String  $height               Height of the iframe, can be in px or %.
 * @param  String  $fallback_img          Featured image thumbnail img tag string.
 * @param  boolean $iframe_resize_disabled Indicate if iframe should automatically resize based on content height.
 * @return String                        HTML of the iframe.
 */
function aerospace_data_display_iframe( $interactive_url, $width, $height, $fallback_img = null, $iframe_resize_disabled = false ) {
	if ( empty( $width ) ) {
		$width = '100%';
	}
	if ( $height ) {
		$height_value = 'height="' . $height . '"';
	}
	if ( $fallback_img ) {
		$fallback_img = '<div class="interactive-fallbackImg">' . $fallback_img . '<p>For best experience, please view on a desktop computer.</p></div>';
	}
	if ( ! $iframe_resize_disabled ) {
		$enabled_class = ' js-iframeResizeEnabled';
	}

	return $fallback_img . '<iframe class="interactive-iframe' . $enabled_class . '" width="' . $width . '" ' . $height_value . ' scrolling="no" frameborder="no" src="' . $interactive_url . '"></iframe>';
}

/*----------  Display Generate Shortcode Button  ----------*/
/**
 * Add shortcode column to post listing
 *
 * @param  array $columns Array of columns to display.
 * @return array          Updated array of columns to display.
 */
function aerospace_data_columns( $columns ) {
	$columns['shortcode'] = 'Shortcode';
	return $columns;
}
add_filter( 'manage_edit-data_columns', 'aerospace_data_columns' );

/**
 * Generate shortcode when clicking on shortcode column.
 *
 * @param  string $colname Column name.
 * @param  int    $cptid   Column ID number.
 */
function aerospace_data_column( $colname, $cptid ) {
	$shortcode_html = "[interactive id=\'" . $cptid . "\']";
	if ( 'shortcode' === $colname ) {
		echo '<a href="#" class="button button-small" onclick="prompt(\'Shortcode to include featured interactive in posts and pages:\', \'' . esc_html( $shortcode_html ) . '\'); return false;">Get Embed Code</a>';
	}
}
add_action( 'manage_data_posts_custom_column', 'aerospace_data_column', 10, 2 );
