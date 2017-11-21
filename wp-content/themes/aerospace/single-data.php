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
        	Return to Archive Link
    		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			    <header class="entry-header row">
			    	<div class="entry-meta-top col-xs-12">
			    		Post Type
			    		<?php aerospace_entry_categories(); ?>
			    	</div>
			    	<div class="title-container col-xs-12">
				    	<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				    	<div class="entry-meta-bottom">
				        	<?php aerospace_last_updated() ?>
				        </div>
				    </div>
			    </header><!-- .entry-header -->

			    <div class="entry-content">
			    	Interactive - either above or below content depending on option
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
			    Return to Archive
			    </div><!-- .entry-content -->

			    <footer class="entry-footer">
			    	<section class="footer-top row">
			    		<div class="entry-data-source col-xs-12 col-md-9">
			    			Data Source
			    		</div>
			    		<div class="entry-share col-xs-12 col-md-3">
			    			<?php get_template_part( 'components/share-inline' ); ?>
			    		</div>
			    	</section>
			    	<?php get_template_part( 'components/explore-more' ); ?>
			    </footer><!-- .entry-footer -->
			</article><!-- #post-<?php the_ID(); ?> -->


        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();