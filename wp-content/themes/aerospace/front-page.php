<?php
/**
 * Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main content-wrapper" role="main">

		<section class="feature-main">
		<?php
			// Featured Item
			$feature_post1 = get_option( 'aerospace_homepage_featured_post_1' );
			if( $feature_post1 ) {
				global $post;
				$post = $feature_post1;
				setup_postdata($post);
				$post->isFeaturedMain = true;
				get_template_part( 'template-parts/content' );
				wp_reset_postdata();
			}
		?>
		</section>
		<section class="feature-secondary row">
			<section class="feature-secondary-posts col-xs-12 col-md-8">
				<?php
					$feature_post2 = get_option( 'aerospace_homepage_featured_post_2' );
					$feature_post3 = get_option( 'aerospace_homepage_featured_post_3' );

					if( $feature_post2 || $feature_post3 ) {
						echo '<h4 class="subheading">' . esc_html__( 'Recommended Articles', 'aerospace' ) . '</h4>';
						$featuredPostsArgs = array(
							'post__in' => array(
								$feature_post2,
								$feature_post3
								),
							'orderby' => 'post__in'
						);
						$featured_posts = get_posts($featuredPostsArgs);

						foreach($featured_posts as $post) : setup_postdata($post);
							get_template_part( 'template-parts/content' );
						endforeach;
						wp_reset_postdata();
					}
				?>
				<div class="feature-secondary-posts-more">
					View <a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>">all articles<i class="icon-long-arrow-right"></i></a>
				</div>
			</section>
			<section class="feature-secondary-sidebar col-xs-12 col-md-4">
				<section class="feature-secondary-sidebar-events">
					<?php
						// Featured Event
						$feature_event = get_option( 'aerospace_homepage_featured_event' );
						if( $feature_event ) {
							echo '<h4 class="subheading">' . esc_html__( 'Featured Event', 'aerospace' ) . '</h4>';
							global $post;
							$post = $feature_event;
							setup_postdata($post);
							get_template_part( 'template-parts/hp-event' );
							wp_reset_postdata();
						}
					?>
				</section>
				<section class="feature-secondary-sidebar-recent">
					<?php
						$latest_post_args = array(
							'post_status' => 'publish',
							'numberposts' => 2,
							'exclude' => array(
								$feature_post1,
								$feature_post2,
								$feature_post3
								)
						);
						$latest_posts = wp_get_recent_posts($latest_post_args, OBJECT);
						echo '<h4 class="subheading">' . esc_html__( 'Recent Articles', 'aerospace' ) . '</h4>';
						foreach($latest_posts as $post) : setup_postdata($post);
							get_template_part( 'template-parts/hp-recent' );
						endforeach;
						wp_reset_postdata();
					?>
				</section>
			</section>
		</section>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();