<?php
/**
 * Custom Post Meta Boxes
 *
 * Add custom meta boxes to the post screen. Meta boxes are for article highlights, sources, download report url, view report url, and is featured.
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
	$current_highlights = get_post_meta( $post->ID, '_post_highlights', true );
	$current_sources = get_post_meta( $post->ID, '_post_sources', true );
	$current_download_url = get_post_meta( $post->ID, '_post_download_url', true );
    $current_view_url = get_post_meta( $post->ID, '_post_view_url', true );
    $current_view_is_pdf = get_post_meta( $post->ID, '_post_view_is_pdf', true );
	$current_view_is_featured = get_post_meta( $post->ID, '_post_is_featured', true );

    ?>
	<div class='inside'>

        <h3><?php _e( 'Article Highlights', 'aerospace' ); ?></h3>
        <p>
             <?php wp_editor(
                 $current_highlights,
                 "post_highlights",
                 array(
                     'media_buttons' => false,
                     'textarea_name' => 'highlights',
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
				$current_sources,
				"post_sources",
				array(
					'media_buttons' => false,
					'textarea_name' => 'sources',
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

        <h3><?php _e( 'Download Report URL', 'aerospace' ); ?></h3>
		<p>
			<input type="text" class="large-text" name="download_url" value="<?php echo $current_download_url; ?>" />
		</p>

        <h3><?php _e( 'View Report URL', 'aerospace' ); ?></h3>
        <p>
            <input type="text" class="large-text" name="view_url" value="<?php echo $current_view_url; ?>" />
        </p>
        <p>
            <input type="checkbox" name="view_is_pdf" value="1" <?php checked( $current_view_is_pdf, '1' ); ?> /> Link is a PDF?
        </p>
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
	if ( isset( $_REQUEST['highlights'] ) ) {
		update_post_meta( $post_id, '_post_highlights', wp_kses_post( $_POST['highlights'] ) );
	}
	// Sources
	if ( isset( $_REQUEST['sources'] ) ) {
		update_post_meta( $post_id, '_post_sources', wp_kses_post( $_POST['sources'] ) );
	}
    // Download URL
    if ( isset( $_REQUEST['download_url'] ) ) {
        update_post_meta( $post_id, '_post_download_url', esc_url( $_POST['download_url'] ) );
    }
    // View URL
    if ( isset( $_REQUEST['view_url'] ) ) {
        update_post_meta( $post_id, '_post_view_url', esc_url( $_POST['view_url'] ) );
    }
	// View URL is a PDF
	if ( isset( $_REQUEST['view_is_pdf'] ) ) {
		update_post_meta( $post_id, '_post_view_is_pdf', sanitize_text_field( $_POST['view_is_pdf'] ) );
	}
	else {
		update_post_meta( $post_id, '_data_view_is_pdf', '' );
	}
	// Is Featured?
	if ( isset( $_REQUEST['is_featured'] ) ) {
		update_post_meta( $post_id, '_post_is_featured', '' );
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
