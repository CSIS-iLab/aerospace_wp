<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

$is_featured = get_post_meta( $id, '_post_is_featured', true );
if ( 1 == $is_featured ) {
		$classes = 'row featured card-format';
		$thumbnail_size = 6;
} else {
		$classes = 'row card-format';
		$thumbnail_size = 4;
}

?>

<tr id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<td><?php
					if ( has_post_thumbnail() ) {
							echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
							the_post_thumbnail( 'medium_large' );
							echo '</a></div>';
					}
			?>
	</td>
	<td><?php the_title( '<span class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></span>'); ?></td>
	<td><?php aerospace_last_updated(); ?></td>
	<td><?php aerospace_entry_data_categories(); ?></td>
	<td><?php aerospace_entry_data_tags(); ?></td>
</tr>

					<footer class="entry-footer">
							<?php aerospace_post_format( $post->ID ); ?>
					</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
