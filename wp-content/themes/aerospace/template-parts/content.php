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

    the_content(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'aerospace'),
                array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
            ),
            get_the_title()
        )
    );

    wp_link_pages(
        array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'aerospace'),
                'after'  => '</div>',
        )
    );

    if ( has_post_thumbnail() ) {
        echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
        the_post_thumbnail( 'medium_large' );
        echo '</a></div>';
    }
  
    ?>
    <div class="col-xs-12 col-md card-main">
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
            <?php aerospace_post_format( $post->ID ); ?>
            <?php aerospace_entry_categories(); ?>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
