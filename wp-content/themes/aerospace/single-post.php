<?php
/**
 * The template for displaying single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Aerospace
 */

get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main content-wrapper">

    		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			    <header class="entry-header row">
			    	<div class="entry-meta-top col-xs-12">
			    		Post Format
			    		<?php aerospace_entry_categories(); ?>
			    	</div>
			    	<div class="title-container col-xs-12">
				    	<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				    	<div class="entry-meta-bottom">
				        	<?php aerospace_posted_on(); ?>
				        	<?php aerospace_authors_list(); ?>
				        </div>
				    </div>
			    </header><!-- .entry-header -->

			    <div class="entry-content">
			    	Featured Image
			    	Highlights
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
			    </div><!-- .entry-content -->

			    <footer class="entry-footer">
			    	<section class="footer-top row">
			    		<div class="entry-citation col-xs-12 col-md-9">
			    			Citation
			    		</div>
			    		<div class="entry-share col-xs-12 col-md-3">
			    			<?php get_template_part( 'components/share-inline' ); ?>
			    		</div>
			    	</section>
			    	<section class="footer-middle row">
			    		<div class="entry-footnotes col-xs-12 col-md-6">
			    			Footnotes
			    		</div>
			    		<div class="entry-sources col-xs-12 col-md-6">
			    			Sources
			    		</div>
			    	</section>
			    	<section class="authors-container">
			    		<?php esc_html_e( 'About the Authors', 'aerospace' ); ?>
			    		<?php aerospace_authors_list_extended() ?>
			    	</section>
			    	<?php get_template_part( 'components/explore-more' ); ?>
			    </footer><!-- .entry-footer -->
			</article><!-- #post-<?php the_ID(); ?> -->


        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
