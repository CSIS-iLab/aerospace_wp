<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

$is_featured = get_post_meta( $id, '_post_is_featured', true );

if ( isset( $post->isFeaturedMain ) && $post->isFeaturedMain ) {
    $classes = 'row featured card-format';
    $thumbnail_size = 6;
} elseif ( isset( $post->isFeaturedMain ) && ! $post->isFeaturedMain ) {
    $classes = 'row card-format';
    $thumbnail_size = 4;
} elseif ( $is_featured ) {
    $classes = 'row featured card-format';
    $thumbnail_size = 6;
} else {
    $classes = 'row card-format';
    $thumbnail_size = 4;
}

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
    ?>
    <div class="col-xs-12 col-md entry-main">
        <header class="entry-header">
            <?php aerospace_post_is_featured ( $post->ID ) ?>
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
            <div class="entry-meta">
                <?php aerospace_authors_list(); ?>
                <?php aerospace_posted_on(); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content">
        <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php
                aerospace_post_format( $post->ID );
                aerospace_entry_primary_cats();
            ?>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
