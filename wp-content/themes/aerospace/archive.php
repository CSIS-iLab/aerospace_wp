<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main content-wrapper">

            <header class="page-header row">
                <div class="title-container">
                    <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
                    <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
                    <div class="archive-pages-top row">
                        <?php if (have_posts() ) : ?>
                        <div class="col-xs-12 col-sm archives-meta-left">
                            <?php aerospace_post_num(); ?>
                        </div>
                        <?php endif; ?>
                        <div class="col-xs-12 col-sm-6 archives-meta-right">
                            <?php aerospace_sort_filter(); ?>
                        </div>
                    </div>
                </div>
            </header><!-- .page-header -->

    <?php
    if (have_posts() ) : ?>
        <?php
        /* Start the Loop */
        while ( have_posts() ) : the_post();

            /*
            * Include the Post-Format-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            */
            get_template_part('template-parts/content', get_post_type());

        endwhile;
        ?>
        <footer class="archive-pages-bottom row">
            <div class="col-xs-12 col-sm archives-meta-left"><?php aerospace_post_num(); ?></div>
            <div class="col-xs-12 col-sm-6 archives-meta-right">
                <?php the_posts_pagination( array(
                    'prev_text' => '<i class="icon-arrow-left"></i>',
                    'next_text' => '<i class="icon-arrow-right"></i>',
                )); ?>
            </div>
        </footer>
        <?php
        else :

            get_template_part('template-parts/content', 'none');

        endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
