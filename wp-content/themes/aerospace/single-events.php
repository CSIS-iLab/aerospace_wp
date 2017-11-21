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
				    	<?php aerospace_event_hosted_by( $post->ID ); ?>
				    	<div class="entry-meta-bottom">
				        	<?php aerospace_event_dates( $post->ID, true ); ?>
				        	<?php aerospace_event_location( $post->ID ); ?>
				        	<?php aerospace_event_google_map( $post->ID ); ?>
				        </div>
				    </div>
			    </header><!-- .entry-header -->

			    <div class="entry-content">
			    	<?php aerospace_post_highlighted_info( $post->ID ); ?>

			    	<?php
			    		if ( aerospace_event_is_past( $post->ID ) ) {
			    			esc_html_e( 'This event has already taken place.', 'aerospace' );
			    		}
			    	?>
			    	<?php aerospace_event_watch( $post->ID ); ?>
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
			    	<?php
				    if ( aerospace_event_is_past( $post->ID ) == false ) {
				    ?>
			    	<section class="footer-top row">
			    		<div class="entry-register col-xs-12 col-md-4">
			    			<?php aerospace_event_register( $post->ID ); ?>
			    		</div>
			    		<div class="entry-calendar col-xs-12 col-md-4">
			    			Add to Calendar
			    		</div>
			    		<div class="entry-share col-xs-12 col-md-4">
			    			<?php get_template_part( 'components/share-inline' ); ?>
			    		</div>
			    	</section>
			    	<?php get_template_part( 'components/explore-more' ); ?>
			    	<?php } ?>
			    </footer><!-- .entry-footer -->
			</article><!-- #post-<?php the_ID(); ?> -->


        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
