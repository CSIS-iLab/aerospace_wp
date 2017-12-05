<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main content-wrapper">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                </header><!-- .entry-header -->
                <div class="entry-content content-padding">
                    <div class="page-description">
                        <?php the_excerpt(); ?>
                    </div>
                    <div class="entry-content-post-body">
                        <?php
                        the_content();
                        wp_link_pages(
                            array(
                                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'aerospace'),
                                    'after'  => '</div>',
                            )
                        );
                        ?>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
