<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Aerospace
 */

if ( is_post_type_archive( 'events' ) ) {
    $heading = 'No events found';
    $description = 'There were no events found at this time. Please check back soon.';
} else {
    $heading = 'No articles found';
    $description = 'There were no articles found at this time. Please check back soon.';
}

?>

<section class="no-results not-found">
    <?php if (is_search() ) : ?>
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Nothing Found', 'aerospace'); ?></h1>
        </header><!-- .page-header -->
        <div class="entry-content">
            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'aerospace'); ?></p>
            <?php get_search_form(); ?>
        </div>
        <?php else : ?>
            <div class="entry-content content-padding">
                <h3 class="subheading"><?php echo esc_html( $heading ); ?></h3>
                <p><?php echo esc_html( $description ); ?></p>
            </div>
    <?php endif; ?>
</section><!-- .no-results -->
