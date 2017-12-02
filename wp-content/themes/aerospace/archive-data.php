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
					<div class="col-xs-12 col-sm-6 archives-meta-right">Sort By:
						<button class="btn btn-gray btn-red-hover tableSort active" data-sortCol="0" aria-label="Sort by Date">Date</button>
						<button class="btn btn-gray btn-red-hover tableSort" data-sortCol="1" aria-label="Sort by Title">Title</button>
					</div>
				<?php endif; ?>
			</div>
		</header><!-- .page-header -->
		<section class="archive-content row">
			<?php if (have_posts() ) : ?>
			<div class="col-xs-12 col-md-3">
				<?php get_template_part( 'components/filters-data'); ?>
				<div id="select">
					<div class="select">
						<label class="label" for="category">FILTER BY CATEGORY</label>
						<?php
						$first_field = array(
							'show_option_all' => '',
							'show_option_none' => 'Select A Category'
						);
						wp_dropdown_categories($first_field);
						?>
					</div>
					<div class="select">
						<label class="label" for="tag">FILTER BY TAG</label>
						<?php
						$taglist = wp_dropdown_categories('taxonomy=post_tag&show_option_none=Select A Tag&show_count=1&orderby=name&echo=0');
						$taglist = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $taglist);
						echo $taglist;
						?>
					</div>
					<div class="filter-search">
						<label for="dataSearch" class="sortTitle">Search</label>
						<input id="dataSearch" name="dataSearch" type="text" placeholder="Search the data..." />
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-9">

				<table id="dataRepo" class="cards">
					<thead>
						<tr>
							<th>Display</th>
							<th>Title</th>
							<th>Last Updated</th>
							<th>category</th>
							<th>Tag</th>
						</tr>
					</thead>
					<tbody>
						<?php
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							get_template_part( 'template-parts/content-data' );
						endwhile;
						?>
					</tbody>
				</table>
			</div>
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
wp_enqueue_script('aerospace-datatables', '//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js', array(), '20171128', true );
wp_enqueue_script('aerospace-datarepo', get_template_directory_uri() . '/js/data-repo.js', array(), '20171128', true );
get_footer();
