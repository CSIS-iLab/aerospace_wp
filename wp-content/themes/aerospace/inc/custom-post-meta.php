<?php
/**
 * Custom Post Meta Boxes
 *
 * Add custom meta boxes to the post screen. Meta boxes are for data sources, further reading, and related content.
 *
 * @package aerospace
 */
/**
 * Add meta box
 *
 * @param post $post The post object
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/add_meta_boxes
 */
function post_add_meta_boxes( $post ){
	add_meta_box( 'post_meta_box', __( 'Additional Post Information', 'aerospace' ), 'post_build_meta_box', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'post_add_meta_boxes' );
/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function post_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'post_meta_box_nonce' );
	// Retrieve current value of fields
	$current_articleHighlights = get_post_meta( $post->ID, '_post_highlights', true );
	$current_Sources = get_post_meta( $post->ID, '_post_sources', true );
    $current_postFormat = get_post_meta( $post->ID, '_post_post_format', true );
	$current_downloadURL = get_post_meta( $post->ID, '_post_download_url', true );
    $current_viewURL = get_post_meta( $post->ID, '_post_view_url', true );
    $current_viewIsPDF = get_post_meta( $post->ID, '_post_view_is_pdf', true );

	?>
	<div class='inside'>

        <h3><?php _e( 'Article Highlights', 'aerospace' ); ?></h3>
		<p>
			<?php wp_editor(
				$current_articleHighlights,
				"post_Highlights",
				array(
					'media_buttons' => false,
					'textarea_name' => 'articleHighlights',
					'teeny' => false,
					'tinymce' => array(
						'menubar' => false,
						'toolbar1' => 'bold,italic,underline,strikethrough,subscript,superscript,bullist,numlist,alignleft,aligncenter,alignright,undo,redo,link,unlink,view',
						'toolbar2' => false
					)
				)
			); ?>
		</p>
		<br />

        <h3><?php _e( 'Sources', 'aerospace' ); ?></h3>
		<p>
			<?php wp_editor(
				$current_Sources,
				"post_Sources",
				array(
					'media_buttons' => false,
					'textarea_name' => 'Sources',
					'teeny' => false,
					'tinymce' => array(
						'menubar' => false,
						'toolbar1' => 'bold,italic,underline,strikethrough,subscript,superscript,bullist,numlist,alignleft,aligncenter,alignright,undo,redo,link,unlink,view',
						'toolbar2' => false
					)
				)
			); ?>
		</p>
		<br />

		<h3><?php _e( 'Post Format', 'aerospace' ); ?></h3>
		<p>
			<?php wp_editor(
				$current_postFormat,
				"post_postFormat",
				array(
					'media_buttons' => false,
					'textarea_name' => 'postFormat',
					'teeny' => false,
					'tinymce' => array(
						'menubar' => false,
						'toolbar1' => 'bold,italic,underline,strikethrough,subscript,superscript,bullist,numlist,alignleft,aligncenter,alignright,undo,redo,link,unlink',
						'toolbar2' => false
					)
				)
			); ?>
		</p>

        <h3><?php _e( 'Download Report URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="downloadURL" value="<?php echo $current_downloadURL; ?>" />
		</p>

        <h3><?php _e( 'View Report URL', 'aerospace' ); ?></h3>
        <p>
            <input type="text" class="large-text" name="viewURL" value="<?php echo $current_viewURL; ?>" />
        </p>
        <p>
            <input type="checkbox" name="viewIsPDF" value="1" <?php checked( $current_viewIsPDF, '1' ); ?> /> Link is a PDF?
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
function post_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['post_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['post_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	// Article Highlights
	if ( isset( $_REQUEST['articleHighlights'] ) ) {
		update_post_meta( $post_id, '_post_highlights', wp_kses_post( $_POST['articleHighlights'] ) );
	}
	// Sources
	if ( isset( $_REQUEST['Sources'] ) ) {
		update_post_meta( $post_id, '_post_sources', wp_kses_post( $_POST['Sources'] ) );
	}
    // Post Format
    if ( isset( $_REQUEST['postFormat'] ) ) {
        update_post_meta( $post_id, '_post_post_format', wp_kses_post( $_POST['postFormat'] ) );
    }
    // Download URL
    if ( isset( $_REQUEST['downloadURL'] ) ) {
        update_post_meta( $post_id, '_post_download_url', esc_url( $_POST['downloadURL'] ) );
    }
    // View URL
    if ( isset( $_REQUEST['viewURL'] ) ) {
        update_post_meta( $post_id, '_post_view_url', esc_url( $_POST['viewURL'] ) );
    }
	// View URL is a PDF
	if ( isset( $_REQUEST['viewIsPDF'] ) ) {
		update_post_meta( $post_id, '_post_view_is_pdf', sanitize_text_field( $_POST['viewIsPDF'] ) );
	}
	else {
		update_post_meta( $post_id, '_data_view_is_pdf', '' );
	}
}
add_action( 'save_post', 'post_save_meta_box_data' );
/* @Recreate the default filters on the_content so we can pull formated content with get_post_meta
    -------------------------------------------------------------- */
add_filter( 'meta_content', 'wptexturize'        );
add_filter( 'meta_content', 'convert_smilies'    );
add_filter( 'meta_content', 'convert_chars'      );
add_filter( 'meta_content', 'wpautop'            );
add_filter( 'meta_content', 'shortcode_unautop'  );
add_filter( 'meta_content', 'prepend_attachment' );
add_filter( 'meta_content', 'do_shortcode'       );
