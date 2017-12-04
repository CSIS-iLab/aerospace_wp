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
				$featuredPostArgs = array(
					'post__in' => array(
						$feature_post1,
						$feature_post3
						),
					'orderby' => 'post__in',
					'posts_per_page' => 1
				);
				$featured_post = get_posts($featuredPostArgs);

				foreach($featured_post as $post) : setup_postdata($post);
					$post->isFeaturedMain = 1;
					get_template_part( 'template-parts/content' );
				endforeach;
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
							$post->isFeaturedMain = 0;
							get_template_part( 'template-parts/content' );
						endforeach;
						wp_reset_postdata();
					}
				?>
				<div class="feature-secondary-posts-more view-more">
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
		<section class="feature-aerospace101 row">
			<div class="feature-aerospace101-content">
				<h3 class="section-heading"><?php esc_html_e( 'Aerospace 101', 'aerospace' ); ?></h3>
				<?php
				$aerospace101_desc = get_option( 'aerospace_homepage_aerospace101_desc' );
				echo '<p>' . $aerospace101_desc . '</p>';
				?>
				<p class="view-more">Explore <a href="/aerospace-101">Aerospace 101<i class="icon-long-arrow-right"></i></a></p>
				<?php
					$featuredAerospace101Args = array(
						'post_type' => 'aerospace101',
						'meta_key' => '_post_is_featured',
						'meta_value' => '1',
						'posts_per_page' => 1
					);
					$featured_aerospace101 = get_posts($featuredAerospace101Args);

					foreach($featured_aerospace101 as $post) : setup_postdata($post);
						get_template_part( 'template-parts/hp-featured' );
					endforeach;
					wp_reset_postdata();
				?>
			</div>
		</section>
		<section class="feature-final row">
			<section class="feature-final-data col-xs-12 col-md-8">
				<h3 class="section-heading"><?php esc_html_e( 'Visualizing Data', 'aerospace' ); ?></h3>
				<?php
					$feature_data1 = get_option( 'aerospace_homepage_featured_data_1' );
					$feature_data2 = get_option( 'aerospace_homepage_featured_data_2' );

					if( $feature_data1 || $feature_data2 ) {
						echo '<div class="feature-final-data-desc row">';
						$featuredDataArgs = array(
							'post_type' => 'data',
							'post__in' => array(
								$feature_data1,
								$feature_data2
								),
							'orderby' => 'post__in'
						);
						$featured_data = get_posts($featuredDataArgs);

						if ( has_post_thumbnail( $featured_data[0] ) ) {
							echo '<div class="hidden-xs col-sm-3 feature-final-data-thumbnail">';
							echo get_the_post_thumbnail( $featured_data[0]->ID, 'medium' );
							echo '</div>';
						}

						$data_desc = get_option( 'aerospace_homepage_data_desc' );
						echo '<div class="col-xs-12 col-sm"><p>' . $data_desc . '</p></div>';
						echo '</div><div class="row">';

						foreach($featured_data as $post) : setup_postdata($post);
							get_template_part( 'template-parts/hp-featured' );
						endforeach;
						wp_reset_postdata();
						echo '</div>';
					}
				?>
				<p class="view-more">Browse the <a href="/data">Data Repository<i class="icon-long-arrow-right"></i></a></p>
			</section>
			<section class="feature-final-sidebar col-xs-12 col-md-4">
				<?php get_sidebar(); ?>
			</section>
		</section>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();