<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Aerospace
 */

get_header(); ?>

<section id="primary" class="content-area search-page">
    <main id="main" class="site-main content-wrapper">

    <?php
    if (have_posts() ) : ?>
        <header class="page-header row">
            <div class="title-container">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query. */
                    printf(esc_html__('Search Results for: %s', 'aerospace'), '<span>' . get_search_query() . '</span>');
                    ?>
                </h1>
                <div class="archive-pages-top row">
                    <?php if (have_posts() ) : ?>
                    <div class="col-xs-12 col-sm archives-meta-left">
                        <?php aerospace_post_num(); ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 archives-meta-right">
                        <?php
                        if ( ! is_post_type_archive( 'events' ) ) {
                            aerospace_sort_filter();
                        }
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </header><!-- .page-header -->
        <div class="archive-content">
            <div class="archive-content-regular row">
                <div class="col-xs-12 col-md-3 filter-sidebar">
                    <?php get_template_part( 'components/filters-search'); ?>
                </div>
                <div class="col-xs-12 col-md row archive-content-posts">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        get_template_part('template-parts/content', 'search');

                    endwhile;
                    ?>
                </div>
            </div>
        </div>
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
</section><!-- #primary -->

<?php
get_footer();
