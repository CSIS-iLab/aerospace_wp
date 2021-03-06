<?php
/**
 * The template for displaying single Aerospace 101 posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Aerospace
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main content-wrapper">
			<?php aerospace_return_to_archive(); ?>
    		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			    <header class="entry-header row">
			    	<div class="entry-meta-top content-padding col-xs-12 row">
			    		<div class="post-format-container">
							<?php aerospace_post_format( $post->ID ); ?>
						</div>
						<div class="categories-container">
							<?php aerospace_entry_primary_cats(); ?>
						</div>
			    	</div>
			    	<div class="title-container content-padding col-xs-12">
				    	<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				    	<div class="entry-meta-bottom">
				        	<?php aerospace_posted_on(); ?>
				        	<?php aerospace_last_updated(); ?>
				        </div>
				    </div>
			    </header><!-- .entry-header -->

			    <div class="entry-content content-padding">
			    	<?php aerospace_show_featured_img( $post->ID ); ?>
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
			    	<?php aerospace_return_to_archive(); ?>
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
