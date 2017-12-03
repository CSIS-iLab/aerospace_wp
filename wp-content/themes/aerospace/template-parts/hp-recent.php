<?php
/**
 * Template part for recent articles on the Homepage.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-main">
        <header class="entry-header">
            <?php aerospace_post_format( $post->ID ); ?>
            <?php
            the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
            ?>
            <div class="entry-meta">
                <?php aerospace_authors_list(); ?>
                <?php aerospace_posted_on(); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
