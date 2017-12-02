<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main content-wrapper">

    <?php
    if (have_posts() ) :

        if (is_home() && ! is_front_page() ) : ?>
         <header class="page-header row">
            <div class="title-container">
                <h1 class="page-title"><?php single_post_title(); ?></h1>
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
         </header>

        <?php
        endif;

        /* Start the Loop */
        while ( have_posts() ) : the_post();

            /*
            * Include the Post-Format-specific template for the content.
            * If you want to override this in a child theme, then include a file
            * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            */
            get_template_part('template-parts/content', get_post_format());

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
