<?php
/**
 * Template part for the Aerospace101 & Data Repo featured posts on the home page.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-main">
        <header class="entry-header">
            <div class="post-is-featured">Featured</div>
            <?php
            the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>');
            ?>
            <div class="entry-meta">
                <?php aerospace_last_updated(); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
