<?php
/**
 * Custom settings page for the theme.
 *
 * @package Aerospace
 */

add_action( 'admin_menu', 'aerospace_add_options_page' );
/**
 * Create an options page for the theme.
 */
function aerospace_add_options_page() {

	add_options_page(
		'Aerospace Settings',
		'Aerospace Settings',
		'manage_options',
		'aerospace-options-page',
		'aerospace_display_options_page'
	);
}

/**
 * Displays the option page and creates the form.
 */
function aerospace_display_options_page() {
	echo '<h1>Aerospace Settings</h1>';
	echo '<form method="post" action="options.php">';
	do_settings_sections( 'aerospace-options-page' );
	settings_fields( 'aerospace_settings' );
	submit_button();
	echo '</form>';
}

add_action( 'admin_init', 'aerospace_admin_init_section_footer' );
/**
 * Creates the "Footer" settings section.
 */
function aerospace_admin_init_section_footer() {

	add_settings_section(
		'aerospace_settings_section_footer',
		'Footer',
		'aerospace_display_section_footer_message',
		'aerospace-options-page'
	);

	add_settings_field(
		'aerospace_description',
		'Description',
		'aerospace_textarea_callback',
		'aerospace-options-page',
		'aerospace_settings_section_footer',
		array( 'aerospace_description' )
	);

	add_settings_field(
		'aerospace_newsletter_desc',
		'Newsletter Description',
		'aerospace_textarea_callback',
		'aerospace-options-page',
		'aerospace_settings_section_footer',
		array( 'aerospace_newsletter_desc' )
	);

	add_settings_field(
		'aerospace_newsletter_url',
		'Newsletter URL',
		'aerospace_text_callback',
		'aerospace-options-page',
		'aerospace_settings_section_footer',
		array( 'aerospace_newsletter_url' )
	);

	register_setting(
		'aerospace_settings',
		'aerospace_description',
		'wp_filter_post_kses'
	);

	register_setting(
		'aerospace_settings',
		'aerospace_newsletter_desc',
		'sanitize_text_field'
	);

	register_setting(
		'aerospace_settings',
		'aerospace_newsletter_url',
		'esc_url'
	);
}

/**
 * Footer section description.
 */
function aerospace_display_section_footer_message() {
	echo 'Information visible in the site\'s footer.';
}

add_action( 'admin_init', 'aerospace_admin_init_section_contact' );
/**
 * Creates the "Contact" settings section.
 */
function aerospace_admin_init_section_contact() {

	add_settings_section(
		'aerospace_settings_section_contact',
		'Contact Information',
		'aerospace_display_section_contact_message',
		'aerospace-options-page'
	);

	add_settings_field(
		'aerospace_email',
		'Email',
		'aerospace_text_callback',
		'aerospace-options-page',
		'aerospace_settings_section_contact',
		array( ' aerospace_email' )
	);

	add_settings_field(
		'aerospace_twitter',
		'Twitter',
		'aerospace_text_callback',
		'aerospace-options-page',
		'aerospace_settings_section_contact',
		array( ' aerospace_twitter' )
	);

	register_setting(
		'aerospace_settings',
		'aerospace_email',
		'sanitize_text_field'
	);

	register_setting(
		'aerospace_settings',
		'aerospace_twitter',
		'sanitize_text_field'
	);

}

/**
 * Contact section description.
 */
function aerospace_display_section_contact_message() {
	echo 'The contact information for the site, email and social media accounts.';
}

add_action( 'admin_init', 'aerospace_admin_init_section_homepage' );
/**
 * Creates the "Homepage" settings section.
 */
function aerospace_admin_init_section_homepage() {
	$post_types = array( 'post', 'events', 'data' );
	$post_selection = array();
	foreach( $post_types as $type ) {
		$post_selection[$type] = get_posts(
	        array(
	            'post_type'  => $type,
	            'numberposts' => -1
	        )
	    );
	}

	add_settings_section(
		'aerospace_settings_section_homepage',
		'Homepage',
		'aerospace_display_section_homepage_message',
		'aerospace-options-page'
	);

	add_settings_field(
		'aerospace_homepage_featured_post_1',
		'Featured Post #1',
		'aerospace_posts_callback',
		'aerospace-options-page',
		'aerospace_settings_section_homepage',
		array( 'aerospace_homepage_featured_post_1', $post_selection['post'] )
	);

	add_settings_field(
		'aerospace_homepage_featured_post_2',
		'Featured Post #2',
		'aerospace_posts_callback',
		'aerospace-options-page',
		'aerospace_settings_section_homepage',
		array( 'aerospace_homepage_featured_post_2', $post_selection['post'] )
	);

	add_settings_field(
		'aerospace_homepage_featured_post_3',
		'Featured Post #3',
		'aerospace_posts_callback',
		'aerospace-options-page',
		'aerospace_settings_section_homepage',
		array( 'aerospace_homepage_featured_post_3', $post_selection['post'] )
	);

	add_settings_field(
		'aerospace_homepage_featured_event',
		'Featured Event',
		'aerospace_posts_callback',
		'aerospace-options-page',
		'aerospace_settings_section_homepage',
		array( 'aerospace_homepage_featured_event', $post_selection['events'] )
	);

	add_settings_field(
		'aerospace_homepage_featured_data_1',
		'Featured Data #1',
		'aerospace_posts_callback',
		'aerospace-options-page',
		'aerospace_settings_section_homepage',
		array( 'aerospace_homepage_featured_data_1', $post_selection['data'] )
	);

	add_settings_field(
		'aerospace_homepage_featured_data_2',
		'Featured Data #2',
		'aerospace_posts_callback',
		'aerospace-options-page',
		'aerospace_settings_section_homepage',
		array( 'aerospace_homepage_featured_data_2', $post_selection['data'] )
	);

	register_setting(
		'aerospace_settings',
		'aerospace_homepage_featured_post_1',
		'sanitize_text_field'
	);

	register_setting(
		'aerospace_settings',
		'aerospace_homepage_featured_post_2',
		'sanitize_text_field'
	);

	register_setting(
		'aerospace_settings',
		'aerospace_homepage_featured_post_3',
		'sanitize_text_field'
	);

	register_setting(
		'aerospace_settings',
		'aerospace_homepage_featured_event',
		'sanitize_text_field'
	);

	register_setting(
		'aerospace_settings',
		'aerospace_homepage_featured_data_1',
		'sanitize_text_field'
	);

	register_setting(
		'aerospace_settings',
		'aerospace_homepage_featured_data_2',
		'sanitize_text_field'
	);

}

/**
 * Contact section description.
 */
function aerospace_display_section_homepage_message() {
	echo 'The featured posts shown on the home page.';
}

/**
 * Renders the text input fields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function aerospace_text_callback( $args ) {
	$option = get_option( $args[0] );
	echo '<input type="text" class="regular-text" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '" value="' . esc_attr( $option ) . '" />';
}

/**
 * Renders the textareafields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function aerospace_textarea_callback( $args ) {
	$option = get_option( $args[0] );
	echo '<textarea class="regular-text" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '" rows="5">' . esc_attr( $option ) . '</textarea>';
}

/**
 * Renders the post dropdown fields.
 *
 * @param  Array $args Array of arguments passed by callback function.
 */
function aerospace_posts_callback( $args ) {
	$option = get_option( $args[0] );
	echo '<select name="' . esc_attr( $args[0] ) . '" id="' . esc_attr( $args[0] ) . '" name="' . esc_attr( $args[0] ) . '">';
	foreach( $args[1] as $post ) {
		if ( $post->ID == esc_attr( $option ) ) {
			$selected = "selected";
		} else {
			$selected = '';
		}

		echo '<option value="' . esc_attr( $post->ID ) . '" ' . $selected . '>' . esc_attr( $post->post_title ) . '</option>';
	}
	echo '</select>';
}
