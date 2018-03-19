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
        array_push( $buttons, 'first', 'fullWidth', 'interactive', 'view', 'explore', 'note', 'publication', 'download', 'aside', 'external-analysis', 'lf-section-header');
        return $buttons;
	}
}
