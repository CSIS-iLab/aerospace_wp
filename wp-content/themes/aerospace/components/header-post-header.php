<?php
/**
 * Post Header Component
 *
 * @package Aerospace
 */

?>

<div class="col-xs-12 col-md header-post-header">
	<div class="header-post-header-title col-xs-12 col-md-8">
		<?php
		echo '<span class="meta-label">';
		esc_html_e( 'Now Reading:', 'aerospace' );
		echo '</span>';
		the_title();
		?>
	</div>
	<div class="header-post-header-share col-xs-12 col-md-4">
		<?php
		if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
			ADDTOANY_SHARE_SAVE_KIT();
		}
		?>
	</div>
</div>