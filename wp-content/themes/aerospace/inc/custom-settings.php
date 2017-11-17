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