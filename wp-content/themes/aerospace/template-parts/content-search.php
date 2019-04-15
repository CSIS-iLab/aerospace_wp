<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

$post_type = get_post_type();

$classes = 'col-xs-12 row card-format';
$thumbnail_size = 3;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
    <?php
    if ( has_post_thumbnail() ) {
        echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' entry-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        the_post_thumbnail( 'medium_large' );
        echo '<div class="multimedia-post"><i class="icon-ion-ios-play"></i></div>';
        echo '<div class="read-article"><span>' . esc_html__( 'View', 'aerospace' ) . '</span><i class="icon-search"></i></div>';
        echo '</a></div>';
    }

    if ( 'events' === $post_type ) {
        echo '<div class="col-xs-4 col-sm-3 col-md-3">';
        aerospace_posted_on_calendar( $post->ID );
        echo '</div>';
    }

    ?>
    <div class="col-xs-12 col-md entry-main">
        <header class="entry-header">
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
            <div class="entry-meta">
                <?php
                if ( 'events' === $post_type ) {
                    aerospace_event_dates( $post->ID, true );
                } elseif ( 'aerospace101' === $post_type  || 'data' === $post_type ) {
                    aerospace_last_updated();
                } elseif ( 'post' === $post_type ) {
                    aerospace_authors_list();
                    aerospace_posted_on();
                }
                ?> 
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content">
        <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php aerospace_post_format( $post->ID ); ?>
            <?php aerospace_entry_primary_cats(); ?>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
