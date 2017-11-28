<?php
/**
 * Archive: Data
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

get_header(); ?>

		<div id="primary" class="content-area">
				<main id="main" class="site-main content-wrapper">

						<header class="page-header">
								<?php
								the_archive_title('<h1 class="page-title">', '</h1>');
								the_archive_top_content();
								?>
								<div class="archive-pages-top row">
										<?php if (have_posts() ) : ?>
										<div class="col-xs-12 col-md-6">
												<?php aerospace_post_num(); ?>
										</div>
										<?php endif; ?>
										<div class="col-xs-12 col-md-6 text-right">Sort By:
											<button class="btn btn-gray btn-red-hover tableSort active" data-sortCol="0" aria-label="Sort by Date">Date</button>
											<button class="btn btn-gray btn-red-hover tableSort" data-sortCol="1" aria-label="Sort by Title">Title</button>
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
						get_template_part('template-parts/content-data', get_post_type());

				endwhile;
				?>
				<div class="archive-pages-top row">
						<div class="col-xs-12 col-md-6 left-side"><?php aerospace_post_num(); ?></div>
						<div class="col-xs-12 col-md-6 text-right">
								<?php the_posts_pagination(); ?>
						</div>
				</div>
				<?php
				else :

						get_template_part('template-parts/content', 'none');

				endif; ?>

				</main><!-- #main -->
		</div><!-- #primary -->

<?php
wp_enqueue_script('aerospace-datatables', '//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js', array(), '20171128', true );
wp_enqueue_script('aerospace-datarepo', get_template_directory_uri() . '/js/data-repo.js', array(), '20171128', true );
get_footer();
