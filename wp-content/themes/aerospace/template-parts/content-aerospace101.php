<?php
/**
 * Template part for displaying Aerospace 101 posts.
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
    $classes = 'col-xs-12 col-md-6 row card-format';
    $thumbnail_size = 12;
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

    <?php
    if ( has_post_thumbnail() ) {
        echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' entry-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        the_post_thumbnail( 'medium_large' );
        echo '<div class="read-article"><span>' . esc_html__( 'Explore this Topic', 'aerospace' ) . '</span><i class="icon-search"></i></div>';
        echo '</a></div>';
    }
    ?>
    <div class="col-xs-12 col-md entry-main">
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
            <?php aerospace_entry_tags(); ?>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
