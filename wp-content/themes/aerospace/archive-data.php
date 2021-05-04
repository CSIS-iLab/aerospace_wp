<?php
/**
 * Archive: Data
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

$description_extra = '';
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
        <?php if (have_posts() ) : ?>
          <div class="col-xs-12 col-sm archives-meta-left">
            <?php aerospace_post_num(); ?>
          </div>

        <?php endif; ?>
      </div>
    </header><!-- .page-header -->
    <section class="archive-content row">
      <?php if (have_posts() ) : ?>

        <table class="cards is-hidden">
          <tbody>
            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();
              get_template_part( 'template-parts/content-data' );
            endwhile;
            ?>
          </tbody>
        </table>
      <?php
      else :
      get_template_part( 'template-parts/content', 'none' );

      endif; ?>
    </section>
    <?php if (have_posts() ) : ?>
    <footer class="archive-pages-bottom row">
            <div class="col-xs-12 col-sm archives-meta-left"><?php aerospace_post_num(); ?></div>
            <div class="col-xs-12 col-sm-6 archives-meta-right">
                <?php the_posts_pagination( array(
                    'prev_text' => '<i class="icon-arrow-left"></i>',
                    'next_text' => '<i class="icon-arrow-right"></i>',
                )); ?>
        </div>
      </footer>
    <?php endif; ?>
  </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();

