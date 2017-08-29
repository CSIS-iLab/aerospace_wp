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
