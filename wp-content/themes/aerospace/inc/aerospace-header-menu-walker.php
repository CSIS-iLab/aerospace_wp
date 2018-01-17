<?php
/**
 * Custom walker for main navigation
 *
 * @package Aerospace
 */

class Aerospace_Menu extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        global $menu_featured_post, $menu_featured_post_description;

        if ( isset ( $menu_featured_post ) ) {

            $post = $menu_featured_post;
            $title = get_the_title($post->ID);
            $permalink = get_the_permalink($post->ID);
            $thumbnail = get_the_post_thumbnail($post->ID);

            $featured_post_html = '<p class="post-desc">' . $menu_featured_post_description . '</p>
            <div class="post-thumbnail"><a href="' . esc_url ( $permalink ) . '">' . $thumbnail . '</a></div>
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
        global $menu_featured_post, $menu_featured_post_description;
        $args->parent_title = $item->title;

        if ( $depth == 0 ) {
            $item->menu_post_type = get_post_meta( $item->ID, 'menu-item-menu_post_type', true );
            $item->menu_featured_post_description = get_post_meta( $item->ID, 'menu-item-menu_featured_post_description', true );

            if ( $item->menu_post_type ) {
                $menu_featured_post = aerospace_featured_post_for_menu( $item->menu_post_type );
                $menu_featured_post_description = $item->menu_featured_post_description;
            }
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

/**
 * Gets the featured post for the homepage block based on a specified post type.
 *
 * @param  string $post_type Post type to get post from.
 * @return array            Post object.
 */
function aerospace_featured_post_for_menu ( $post_type = 'post' ) {
    $args = array(
        'post_type'  => array( $post_type ),
        'posts_per_page' => 1,
        'cache_results' => true,
        'update_post_meta_cache' => false,
        'meta_query' => array(
            array(
                'key' => '_post_is_featured',
                'value' => 1,
                'compare' => '=',
            ),
        ),
    );
    $query = new WP_Query( $args );
    return $query->post;
}