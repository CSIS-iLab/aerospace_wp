<?php
/**
 * The template for displaying single events.
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
			    		<?php aerospace_post_format( $post->ID ); ?>
			    	</div>
			    	<div class="title-container col-xs-12">
				    	<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
				    	Hosted By
				    	<div class="entry-meta-bottom">
				        	Start Date
				        	General Location
				        </div>
				    </div>
			    </header><!-- .entry-header -->

			    <div class="entry-content">
			    	<div class="event-details">
			    		Register Button
			    		Time
			    		Address
			    	</div>
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
			    		<div class="entry-register col-xs-12 col-md-4">
			    			Register Button
			    		</div>
			    		<div class="entry-calendar col-xs-12 col-md-4">
			    			Add to Calendar
			    		</div>
			    		<div class="entry-share col-xs-12 col-md-4">
			    			<?php get_template_part( 'components/share-inline' ); ?>
			    		</div>
			    	</section>
			    </footer><!-- .entry-footer -->
			</article><!-- #post-<?php the_ID(); ?> -->


        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
