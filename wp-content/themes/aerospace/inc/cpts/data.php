<?php
/**
*Custom Post Types: Data
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

/*----------  Custom Meta Fields  ----------*/
/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function data_add_meta_boxes( $post ){
	add_meta_box( 'data_meta_box', __( 'Data Information', 'aerospace' ), 'data_build_meta_box', 'data', 'normal', 'high' );
}
add_action( 'add_meta_boxes_data', 'data_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function data_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'data_meta_box_nonce' );
	// Retrieve current value of fields
<<<<<<< HEAD
	$current_source = get_post_meta( $post->ID, '_data_source', true );
	$current_url = get_post_meta( $post->ID, '_data_url', true );
	$current_width = get_post_meta( $post->ID, '_data_width', true );
	$current_height = get_post_meta( $post->ID, '_data_height', true );
	$current_iframeResizeDisabled = get_post_meta( $post->ID, '_data_iframeResizeDisabled', true );
	$current_fallbackImgDisabled = get_post_meta( $post->ID, '_data_fallbackImgDisabled', true );
	?>
	<div class='inside'>
		<h3><?php _e( 'Source', 'aerospace' ); ?></h3>
		<p>
			<textarea name="source" class="large-text"><?php echo $current_source; ?></textarea>
		</p>

		<h3><?php _e( 'Interactive URL', 'aerospace' ); ?></h3>
		<p>
			<textarea name="url" class="large-text"><?php echo $current_url; ?></textarea>
		</p>

		<h3><?php _e( 'Interactive Width', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="width" value="<?php echo $current_width; ?>" />
		</p>

		<h3><?php _e( 'Interactive Height', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="height" value="<?php echo $current_height; ?>" />
		</p>
		<p>
			<input type="checkbox" name="iframeResizeDisabled" value="1" <?php checked( $current_iframeResizeDisabled, '1' ); ?> /> iFrame Resize Disabled
		</p>

		<h3><?php _e( 'Fallback Image', 'aerospace' ); ?></h3>
		<p>
			<input type="checkbox" name="fallbackImgDisabled" value="1" <?php checked( $current_fallbackImgDisabled, '1' ); ?> /> Fallback Image Disabled
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
	// verify meta box nonce
	if ( !isset( $_POST['data_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['data_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	if ( isset( $_REQUEST['source'] ) ) {
		update_post_meta( $post_id, '_data_source', sanitize_text_field( $_POST['source'] ) );
	}
	// URL
	if ( isset( $_REQUEST['url'] ) ) {
		update_post_meta( $post_id, '_data_url', esc_url( $_POST['url'] ) );
	}
	// Width
	if ( isset( $_REQUEST['width'] ) ) {
		update_post_meta( $post_id, '_data_width', sanitize_text_field( $_POST['width'] ) );
	}
	// Height
	if ( isset( $_REQUEST['height'] ) ) {
		update_post_meta( $post_id, '_data_height', sanitize_text_field( $_POST['height'] ) );
	}
	// Disable iFrame Resizing
	if ( isset( $_REQUEST['iframeResizeDisabled'] ) ) {
		update_post_meta( $post_id, '_data_iframeResizeDisabled', sanitize_text_field( $_POST['iframeResizeDisabled'] ) );
	}
	else {
		update_post_meta( $post_id, '_data_iframeResizeDisabled', '');
	}
	// Disable Fallback Image
	if ( isset( $_REQUEST['fallbackImgDisabled'] ) ) {
		update_post_meta( $post_id, '_data_fallbackImgDisabled', sanitize_text_field( $_POST['fallbackImgDisabled'] ) );
	}
	else {
		update_post_meta( $post_id, '_data_fallbackImgDisabled', '');
	}
}
add_action( 'save_post_data', 'data_save_meta_box_data' );

/*----------  Display iFrame  ----------*/
/**
 * Displays the specified interactive in an iframe
 * @param  String  $interactiveURL       URL to the interactive
 * @param  String  $width                Width of the iframe, can be in px or %
 * @param  String  $height               Height of the iframe, can be in px or %
 * @param  String  $fallbackImg          Featured image thumbnail img tag string
 * @param  boolean $iframeResizeDisabled Indicate if iframe should automatically resize based on content height
 * @return String                        HTML of the iframe
 */
function aerospace_data_display_iframe($interactiveURL, $width, $height, $fallbackImg = null, $iframeResizeDisabled = false) {
	if(empty($width)) {
		$width = "100%";
	}
	if($height) {
		$heightValue = 'height="'.$height.'"';
	}
	if($fallbackImg) {
		$fallbackImg = '<div class="interactive-fallbackImg">'.$fallbackImg.'<p>For best experience, please view on a desktop computer.</p></div>';
	}
	if($iframeResizeDisabled) {
		$enabledClass = "";
	}
	else {
		$enabledClass = " js-iframeResizeEnabled";
	}
	return $fallbackImg.'<iframe class="interactive-iframe'.$enabledClass.'" width="'.$width.'" '.$heightValue.' scrolling="no" frameborder="no" src="'.$interactiveURL.'"></iframe>';
}
/*----------  Display Generate Shortcode Button  ----------*/
// Create Shortcode Column
function aerospace_data_columns( $columns ) {
    $columns["shortcode"] = "Shortcode";
    return $columns;
}
add_filter('manage_edit-data_columns', 'aerospace_data_columns');
// Populate Shortcode column
function aerospace_data_column( $colname, $cptid ) {
	$shortcode_html = "[interactive id=\'".$cptid."\']";
     if ( $colname == 'shortcode')
          echo '<a href="#" class="button button-small" onclick="prompt(\'Shortcode to include featured interactive in posts and pages:\', \''.$shortcode_html.'\'); return false;">Get Embed Code</a>';
}
add_action('manage_data_posts_custom_column', 'aerospace_data_column', 10, 2);
=======
	$current_viewURL = get_post_meta( $post->ID, '_data_viewURL', true );
	$current_downloadURL = get_post_meta( $post->ID, '_data_downloadURL', true );
	$current_viewIsPDF = get_post_meta( $post->ID, '_data_viewIsPDF', true );
	?>
	<div class='inside'>
		<?php
			for($i = 1; $i <= 3; $i++) {
				$current_stat = get_post_meta( $post->ID, '_data_stat'.$i, true );
		?>
			<h3><?php _e( 'Featured Stat #'.$i, 'aerospace' ); ?></h3>
			<?php wp_editor(
				$current_stat,
				"data_stat".$i,
				array(
					'textarea_rows' => 3,
					'media_buttons' => false,
					'textarea_name' => 'data_stat'.$i,
					'quicktags' => false,
					'tinymce' => array(
						'menubar' => false,
						'toolbar1' => 'stats',
						'toolbar2' => false
					)
				)
			); ?>
		<?php } ?>
		<h3><?php _e( 'View URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="viewURL" value="<?php echo $current_viewURL; ?>" />
		</p>
		<p>
			<input type="checkbox" name="viewIsPDF" value="1" <?php checked( $current_viewIsPDF, '1' ); ?> /> Link is a PDF?
		</p>

		<h3><?php _e( 'Download URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="downloadURL" value="<?php echo $current_downloadURL; ?>" />
		</p>

	</div>
	<?php
}
>>>>>>> 05f651693aa802f0bec67450de58dfe4c051f4f3
