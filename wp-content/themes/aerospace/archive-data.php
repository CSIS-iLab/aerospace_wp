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
										<div class="col-xs-12 col-md-6 text-right">Sort By:
											<button class="btn btn-gray btn-red-hover tableSort active" data-sortCol="0" aria-label="Sort by Date">Date</button>
											<button class="btn btn-gray btn-red-hover tableSort" data-sortCol="1" aria-label="Sort by Title">Title</button>
										</div>
								</div>
						</header><!-- .page-header -->
					<div class="col-xs-12 col-md-4">
						<div id="select">
							<div class="select">
								<label class="label" for="category">FILTER BY CATEGORY</label>
									<select class="select-cat" id="category" name="category">
										<option disabled selected>Choose a category</option>
										<option>Rockets</option>
										<?php
											// echo '<option>';
											// echo wp_dropdown_categories();
											// echo '</option>';
										?>
									</select>
							</div>
							<div class="filter-search col-xs-12 col-md-5"></div>
						</div>
					</div>
	<div class="col-xs-12 col-md-8">

		<table id="dataRepo" class="cards">
			<thead style="display: none;">
				<tr>
					<th>Title</th>
					<th>Topic</th>
					<th>Date</th>
					<th style="width:23%;">category</th>
					<th class="cardCol">Tag</th>
				</tr>
			</thead>
		<tbody>
								<?php
								/* Start the Loop */
								while ( have_posts() ) : the_post();

									get_template_part( 'template-parts/content-data' );

								endwhile;

				else :

								get_template_part( 'template-parts/content', 'none' );

				endif; ?>
								</tbody>
							</table>
	</div>
				<div class="archive-pages-top row">
						<div class="col-xs-12 col-md-6 left-side"><?php aerospace_post_num(); ?></div>
						<div class="col-xs-12 col-md-6 text-right">
								<?php the_posts_pagination(); ?>
						</div>
				</div>
				</main><!-- #main -->
		</div><!-- #primary -->

<?php
wp_enqueue_script('aerospace-datatables', '//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array(), '20171128', true );
wp_enqueue_script('aerospace-datarepo', get_template_directory_uri() . '/js/data-repo.js', array(), '20171128', true );
get_footer();
