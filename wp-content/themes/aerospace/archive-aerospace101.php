<?php
/**
 * The template for displaying the Aerospace101 Archive
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

if ( get_archive_top_content() ) {
    $description = get_archive_top_content();
} else {
    $description = get_the_archive_description();
}
$description = '<div class="archive-description-desc col-xs-12 col-sm">' . $description . '</div>';

if ( get_archive_bottom_content() ) {
    $description_extra = '<div class="archive-description-extra col-xs-12 col-sm-3">' . get_archive_bottom_content() . '</div>';
}

$filter_html_start = '<div class="archive-content-regular row">
                    <div class="col-xs-12 col-md-2 filter-sidebar">';
$filter_html_end = '</div>
                    <div class="col-xs-12 col-md row archive-content-posts">';

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main content-wrapper">

            <header class="page-header row">
                <div class="title-container">
                    <?php the_archive_title('<h1 class="page-title">', '</h1>'); ?>
                    <div class="archive-description row">
                        <?php echo $description_extra; ?>
                        <?php echo $description; ?>
                    </div>
                    <div class="archive-pages-top row">
                        <?php if (have_posts() ) : ?>
                        <div class="col-xs-12 col-sm archives-meta-left">
                            <?php aerospace_post_num(); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </header><!-- .page-header -->

    <?php
    if (have_posts() ) : ?>
        <div class="archive-content">
            <?php
            $count = 0;
            $total_count = $wp_query->post_count;
            $last = $total_count - 1;
            $show_filter = true;
            /* Start the Loop */
            while ( have_posts() ) : the_post();
                // We only want to show the filtering options once and always after the featured item.
                $is_featured = get_post_meta( $id, '_post_is_featured', true );

                if ( ( $is_featured ) ) {
                    get_template_part('template-parts/content', get_post_type());

                    echo $filter_html_start;
                    get_template_part( 'components/aerospace101-filters');
                    echo $filter_html_end;

                    $show_filter = false;
                } elseif ( $show_filter) { 
                    echo $filter_html_start;
                    get_template_part( 'components/aerospace101-filters');
                    echo $filter_html_end;

                    $show_filter = false;
                    get_template_part('template-parts/content', get_post_type());

                } else {
                    get_template_part('template-parts/content', get_post_type());
                }

                if ( $count === $last ) { ?>
                        </div>
                    </div>
                <?php }
                $count++;
            endwhile;
            ?>
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
    </div><!-- #primary -->

<?php
get_footer();
