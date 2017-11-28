<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aerospace
 */

$description = get_option( 'aerospace_description' );
$email = get_option( 'aerospace_email' );
$twitter = get_option( 'aerospace_twitter' );
$newsletter_desc = get_option( 'aerospace_newsletter_desc' );
$newsletter_url = get_option( 'aerospace_newsletter_url' );

?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="site-info content-wrapper row">
            <div class="footer-logo col-xs-12">
                <a href="https://csis.org" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/CSIS-footer-logo.svg" alt="Center for Strategic and International Studies" title="Center for Strategic and International Studies" /></a>
            </div>
            <div class="footer-info col-xs-12 col-md-8">
                <?php
                if ( $description ) {
                    echo '<p>' . wp_kses_post( $description ) . '</p>';
                }
                ?>
                <ul class="footer-social">
                    <?php
                    if ( $twitter ) {
                        echo '<li><a href="https://twitter.com/' . esc_attr( $twitter ) . '"><i class="icon-twitter"></i>@' . esc_attr( $twitter ) . '</a></li>';
                    }
                    if ( $email ) {
                        echo '<li><a href="mailto:' . esc_attr( $email ) . '?subject=' . esc_attr( get_bloginfo( 'name' ) ) . '"><i class="icon-mail"></i>' . esc_html( $email ) . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="footer-newsletters col-xs-12 col-md-4">
                <?php
                if ( $newsletter_url && $newsletter_desc ) {
                    echo '<h6 class="section-title">' .  esc_html( 'Subscribe', 'nuclearnetwork' ) . '</h6>';
                    echo '<p class="newsletter-desc">' . esc_html( $newsletter_desc ) . '</p>';
                    echo '<a href="' . esc_attr( $newsletter_url ) . '" class="btn btn-gray">' . esc_html( 'Sign Up', 'nuclearnetwork' ) . '</a>';
                }
                ?>
            </div>
            <div class="footer-copyright col-xs-12">
                <p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> by the Center for Strategic and International Studies. All rights reserved.</p>
            </div>
        </div><!-- .site-info -->
    </footer><!-- #colophon -->
    <div id="site-overlay"></div>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
