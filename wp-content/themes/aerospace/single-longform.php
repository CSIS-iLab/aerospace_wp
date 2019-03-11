<?php
/**
 * Template Name: Longform
 * Template Post Type: post
 *
 * @package Aerospace
 */

if ( has_post_thumbnail() ) {
	$featured_img_url = get_the_post_thumbnail_url();
}

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main content-wrapper">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header row" style="background-image:url(<?php echo $featured_img_url; ?>);">
				<div class="longform-section-overlay" data-aos="fade" data-aos-delay="800" data-aos-easing="ease-in-quad" data-aos-offset="200" data-aos-duration="600"></div>
				<div class="title-container content-padding col-xs-12" data-aos="fade" data-aos-delay="1200" data-aos-easing="ease-in-quad" data-aos-duration="600">
					<div class="section-text">
						<?php the_title('<h1 class="entry-title toc-link">', '</h1>'); ?>
						<?php the_excerpt(); ?>
						<div class="entry-meta-bottom">
							<?php aerospace_posted_on(); ?>
							<?php aerospace_authors_list(); ?>
							<?php aerospace_entry_primary_cats(); ?>
							<p class="thumbnail-caption"><?php esc_html_e( 'Image Source: ', 'aerospace' ); ?> <?php the_post_thumbnail_caption(); ?></p>
						</div>
					</div>
				</div>
			</header><!-- .entry-header -->

			<div class="entry-content content-padding">
				<div class="entry-content-post-body">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'aerospace'),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						)
					);
					?>
				</div>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<section class="footer-top content-padding row">
					<div class="col-xs-12 col-md-9"></div>
					<div class="entry-share col-xs-12 col-md-3">
						<?php get_template_part( 'components/share-inline' ); ?>
					</div>
				</section>
				<section class="footer-middle content-padding row">
					<?php aerospace_post_footnotes(); ?>
					<?php aerospace_post_sources( $post->ID ); ?>
				</section>
				<section class="authors-container content-padding">
					<?php aerospace_authors_list_extended() ?>
				</section>
				<?php get_template_part( 'components/explore-more' ); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-<?php the_ID(); ?> -->


	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
