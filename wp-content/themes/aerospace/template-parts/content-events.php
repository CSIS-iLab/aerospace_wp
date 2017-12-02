<?php
/**
 * Template part for events.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

$classes = 'row card-format';

$current_date = date( 'Y-m-d' );
$start_date = get_post_meta( $post->ID, '_events_start_date', true );
if ( $current_date > $start_date ) {
    $heading_class = ' past-event';
    $heading = '<h3 class="event-heading-dividers">Past Events</h3>';
} else {
    $heading_class = ' upcoming-event';
    $heading = '<h2 class="event-heading-dividers">Upcoming Events</h2>';

}

?>

<?php echo $heading; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
    <div class="col-xs-4 col-sm-3 col-md-2">
        <?php aerospace_posted_on_calendar( $post->ID ) ?>
    </div>
    <div class="col-xs col-sm col-md entry-main">
        <header class="entry-header">
            <?php aerospace_post_is_featured ( $post->ID ) ?>
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
            <?php aerospace_event_hosted_by( $post->ID ); ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
        <?php the_excerpt(); ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php aerospace_event_time( $post->ID ); ?>
            <?php aerospace_event_location( $post->ID ); ?>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
