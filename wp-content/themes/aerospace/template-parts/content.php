<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

$is_featured = get_post_meta( $id, '_post_is_featured', true );
if ( 1 == $is_featured ) {
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
        echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        the_post_thumbnail( 'medium_large' );
        echo '</a></div>';
    }
    ?>
    <div class="col-xs-12 col-md card-main">
        <header class="entry-header">
            <?php aerospace_post_is_featured ( $id ) ?>
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
            <div class="entry-meta">
                <?php aerospace_authors_list(); ?>
                Published
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content">
        <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            Post Format
            Categories
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
