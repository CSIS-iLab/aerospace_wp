<?php
/**
 * Template part for events.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

$is_featured = get_post_meta( $id, '_post_is_featured', true );
if ( 1 == $is_featured ) {
    $classes = 'row featured card-format';
} else {
    $classes = 'row card-format';
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
    <div class="col-xs-12 col-md-2">
        <?php aerospace_posted_on_calendar( $post->ID ) ?>
    </div>
    <div class="col-xs-12 col-md card-main">
        <header class="entry-header">
            <?php aerospace_post_is_featured ( $post->ID ) ?>
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
        <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php aerospace_event_time( $post->ID ); ?>
            <?php aerospace_event_location( $post->ID ); ?>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
