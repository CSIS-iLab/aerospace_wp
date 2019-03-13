<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */


$classes = 'row card-format';
$thumbnail_size = 3;

if (is_tag()) {
	$thumbnail_size = 4;
}

?>

<?php if ( is_post_type_archive( 'data' ) ) { ?>
<tr id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<td class="display-column row" colspan="5">
		<?php
		if ( has_post_thumbnail() ) {
			echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail( 'medium_large' );
			echo '</a></div>';
		}
		?>
		<div class="col-xs-12 col-md entry-main">
	        <header class="entry-header">
	            <?php
	            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
	            ?>
	            <div class="entry-meta">
					<?php aerospace_authors_list(); ?>
	                <?php aerospace_last_updated(); ?>
	                <?php aerospace_entry_categories(); ?>
	                <?php aerospace_entry_tags(); ?>
	            </div><!-- .entry-meta -->
	        </header><!-- .entry-header -->
	    </div>
	</td>
	<td><?php the_title(); ?></td>
	<td><?php aerospace_data_last_updated(); ?></td>
	<td><?php aerospace_entry_data_categories(); ?></td>
	<td><?php aerospace_entry_tags(); ?></td>
</tr>
<?php } else { ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<?php
	if ( has_post_thumbnail() ) {
		echo '<div class="col-xs-12 col-md-' . $thumbnail_size . ' post-thumbnail"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
		the_post_thumbnail( 'medium_large' );
		echo '</a></div>';
	}
	?>
	<div class="col-xs-12 col-md entry-main">
        <header class="entry-header">
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
            <div class="entry-meta">
				<?php aerospace_authors_list(); ?>
                <?php aerospace_last_updated(); ?>
				<?php if( !is_tag() ) {
					aerospace_entry_categories();
					aerospace_entry_tags();
				} ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->
		<?php if (is_tag()) { ?>
		<div class="entry-content">
        <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php aerospace_post_format( $post->ID ); ?>
            <?php aerospace_entry_primary_cats(); ?>
        </footer><!-- .entry-footer -->
		<?php } ?>
    </div>
</article>
<?php }
