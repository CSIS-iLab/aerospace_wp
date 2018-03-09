<?php
/**
 * Post Header Component
 *
 * @package Aerospace
 */

?>

<div class="col-xs-12 col-md header-post-header">
	<div class="col-xs-1 col-md-5 col-lg-4 header-post-header-share">
		<div class="share-icon">
			<i class="icon-share-nodes"></i>
		</div>
		<div class="share-container">
			<i class="icon-close"></i>
			<div class="share-title">
				<span class="meta-label">Share:</span> <?php the_title(); ?>
			</div>
			<?php
			if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
				ADDTOANY_SHARE_SAVE_KIT();
			}
			?>
		</div>
	</div>
	<div class="header-post-header-title col-xs-10 col-md-7 col-lg-8">
		<?php
		echo '<span class="meta-label">';
		esc_html_e( 'Now Reading:', 'aerospace' );
		echo '</span>';
		the_title();
		?>
	</div>
	<div class="header-post-header-backtotop col-xs-1">
		<a href="#page"><i class="icon-download-1"></i></a>
	</div>
</div>