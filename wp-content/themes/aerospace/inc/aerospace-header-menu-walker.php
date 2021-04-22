<?php
/**
 * Custom walker for main navigation
 *
 * @package Aerospace
 */

class Aerospace_Menu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( !empty ( $args->featured_content ) ) {
            $title = $args->featured_content['title'];
            $permalink = $args->featured_content['url'];
            $thumbnail = $args->featured_content['image']['url'];

            $featured_post_html = '<p class="post-desc">' . $args->featured_post_description . '</p>
            <div class="post-thumbnail"><a href="' . esc_url ( $permalink ) . '"> <img src="' . esc_url ( $thumbnail ) . '"></a></div>
            <a href="' . esc_url ( $permalink ) . '" class="post-title">' . $title . '</a>';
        }

        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='submenu-container row'>
            <div class='hidden-xs col-md-3 submenu-parent'>
            " . $args->parent_title . "
            </div>\n
            <div class='hidden-xs col-md-4 submenu-featured-post'>
                " . $featured_post_html . "
            </div>\n
            <div class='col-xs-12 col-md submenu-children'>\n
                <ul class='sub-menu'>\n";
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n
            </div>\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $args->parent_title = $item->title;

        if ( $depth == 0 ) {
            $args->featured_post_description = get_field("featured_post_description", $item->ID);
            $args->featured_content = get_field("featured_content", $item->ID);
        }

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        $output .= $indent . '<li' . $id . $class_names . '>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        if ( $depth == 1 ) {
            $item_output .= '<p class="submenu-desc">' . $item->description . '</p>';
        }
        $item_output .= '';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}
