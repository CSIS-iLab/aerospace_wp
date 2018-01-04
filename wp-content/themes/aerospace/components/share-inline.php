<?php
/**
 * Share Component
 *
 * @package Aerospace
 */

$authors = aerospace_authors_twitter_list();
?>

<div class="share-container">
	<?php
	if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) {
		if ( $authors ) {
			$script = '<script>a2a_config.templates.twitter = {text: "${title} by ' . $authors . ' ${link}"};</script>';
			echo $script;
		}
		echo '<span class="meta-label">';
		esc_html_e( 'Share this Article', 'aerospace' );
		echo '</span>';
		ADDTOANY_SHARE_SAVE_KIT();
	}
	?>
</div>