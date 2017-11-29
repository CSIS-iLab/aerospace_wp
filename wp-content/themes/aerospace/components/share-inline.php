<?php
/**
 * Share Component
 *
 * @package Aerospace
 */

?>

<div class="share-container">
	<?php
	if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
		echo '<span class="meta-label">';
		esc_html_e( 'Share this Article', 'aerospace' );
		echo '</span>';
		ADDTOANY_SHARE_SAVE_KIT();
	}
	?>
</div>