<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

$archive_query = get_posts($wp_query->query_vars);

if ( get_archive_top_content() ) {
    $description = get_archive_top_content();
} else {
    $description = get_the_archive_description();
}

// Author Archives
if ( is_author() ) {

  $author = get_queried_object();

  if ( function_exists( 'coauthors_posts_links' ) ) {
      $img = coauthors_get_avatar( $author, 350 );
      $bio = $author->description;
      $twitter = $author->twitter;
      if ( $twitter ) {
          $twitter = ' <a href="https://twitter.com/' . $twitter . '" target="_blank" rel="nofollow"><i class="icon-twitter"></i>@' . $twitter .'</a>';
      }
      $description = '<div class="authors-list-extended"><div class="entry-author row"><div class="author-img col-xs-3 col-md-2">' . $img . '</div><div class="author-bio col-xs"><div class="author-img-mobile">' . $img . '</div><p>' . $bio . $twitter . '</p></div></div></div>';
}

  $wp_query->query_vars['post_type'] = array('post','data','aerospace101');
  $wp_query->query_vars['orderby'] = 'modified';

  $archive_query = get_posts($wp_query->query_vars);


}

$description = '<div class="archive-description-desc col-xs-12 col-sm">' . $description . '</div>';

if ( get_archive_bottom_content() ) {
    $description_extra = '<div class="archive-description-extra col-xs-12 col-sm-3">' . get_archive_bottom_content() . '</div>';
}


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
                        <?php if (count($archive_query) ) : ?>
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

    <?php

    if ( count($archive_query) ) : ?>
        <?php
        /* Start the Loop */
        foreach ( $archive_query as $post ) : setup_postdata( $post );
            if ( is_author() ) {
                get_template_part('template-parts/content', 'search');
            } else {
                get_template_part('template-parts/content', get_post_type());
            }

        endforeach;
        wp_reset_postdata();
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
