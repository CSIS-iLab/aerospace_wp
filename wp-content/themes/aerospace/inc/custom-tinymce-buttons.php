<?php
/**
 * Custom buttons for TinyMCE
 *
 * @package aerospace
 */
add_action( 'after_setup_theme', 'aerospace_theme_setup' );
if ( ! function_exists( 'aerospace_theme_setup' ) ) {
	/**
	 * Initialize custom buttons for TinyMCE.
	 */
	function aerospace_theme_setup() {
		add_action( 'init', 'aerospace_buttons' );
	}
}

/********* TinyMCE Buttons ***********/
if ( ! function_exists( 'aerospace_buttons' ) ) {
	/**
	 * Render buttons.
	 */
	function aerospace_buttons() {
		add_filter( 'mce_external_plugins', 'aerospace_add_buttons' );
		add_filter( 'mce_buttons', 'aerospace_register_buttons' );
	}
}
if ( ! function_exists( 'aerospace_add_buttons' ) ) {
	/**
	 * Include the JS file with the button information.
	 *
	 * @param Array $plugin_array Plugin array to update.
	 */
	function aerospace_add_buttons( $plugin_array ) {
		$plugin_array['aerospace'] = get_template_directory_uri() . '/js/tinymce.js';
		$plugin_array['aerospace-longform'] = get_template_directory_uri() . '/js/tinymce-longform.js';
		return $plugin_array;
	}
}
if ( ! function_exists( 'aerospace_register_buttons' ) ) {
	/**
	 * Add custom buttons to buttons array
	 *
	 * @param  Array $buttons Array of buttons to appear in editor.
	 * @return Array          Updated buttons array.
	 */
	function aerospace_register_buttons( $buttons ) {
        array_push( $buttons, 'first', 'fullWidth', 'interactive', 'view', 'explore', 'note', 'publication', 'download', 'aside', 'external-analysis', 'lf-section-header', 'lf-section-explainer', 'lf-text-overlay', 'lf-toc');
        return $buttons;
	}
}

add_action ( 'after_wp_tiny_mce', 'aerospace_tinymce_extra_vars' );
if ( !function_exists( 'aerospace_tinymce_extra_vars' ) ) {
	function aerospace_tinymce_extra_vars() {
		// Get list of Posts
		$args = array(
			'posts_per_page' => -1,
			'post_type' => array('post'),
			'orderby' => 'title',
			'order' => 'asc'
		);
		$posts = get_posts( $args );
		$postList = "";
		foreach($posts as $post) {
			$format = "{text: '" .  esc_html($post->post_title) . "', value: '" . $post->ID . "'},";
			if ( $post->post_type == 'post' ) {
				$postList .= $format;
			}
		}
		$postList = "[".$postList."]";
		?>
		<script type="text/javascript">
			var tinyMCE_posts = <?php echo $postList; ?>;
		</script><?php
	}
}
