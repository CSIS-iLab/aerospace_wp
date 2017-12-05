<?php
/**
 * Template part for the Homepage Featured Event.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'row' ); ?>>
    <div class="col-xs-4">
        <?php aerospace_posted_on_calendar( $post ) ?>
    </div>
    <div class="col-xs entry-main">
        <header class="entry-header">
            <?php
            the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
            ?>
            <?php aerospace_event_hosted_by( $post ); ?>
        </header><!-- .entry-header -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
