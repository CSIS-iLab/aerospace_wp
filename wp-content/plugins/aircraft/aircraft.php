<?php
/*
Plugin Name: Aircraft Shortcode
*/

function aircraft_script_register() {
    wp_register_script(
        'aircraft-js',
        plugins_url( 'aircraft.js', __FILE__ ),
        array( 'wp-rich-text', 'wp-element', 'wp-editor', 'jquery' )
    );
}
add_action( 'init', 'aircraft_script_register' );

function aircraft_enqueue_assets_editor() {
    wp_enqueue_script( 'aircraft-js' );
}
add_action( 'enqueue_block_editor_assets', 'aircraft_enqueue_assets_editor' );
// ajax for not logged in users
