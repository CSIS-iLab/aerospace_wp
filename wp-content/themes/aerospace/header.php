<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Aerospace
 */

$email = get_option( 'aerospace_email' );
$twitter = get_option( 'aerospace_twitter' );
$newsletter_url = get_option( 'aerospace_newsletter_url' );

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'aerospace'); ?></a>

    <header id="masthead" class="site-header">
        <div class="stars stars1"></div>
        <div class="stars stars2"></div>
        <div class="stars stars3"></div>
        <div class="content-wrapper row flex-center__y header-top">
            <div class="col-xs-12 header-social-container">
                <ul class="header-social">
                    <?php
                    if ( $twitter ) {
                        echo '<li><a href="https://twitter.com/' . esc_attr( $twitter ) . '"><i class="icon-twitter"></i></a></li>';
                    }
                    if ( $email ) {
                        echo '<li><a href="mailto:' . esc_attr( $email ) . '?subject=' . esc_attr( get_bloginfo( 'name' ) ) . '">Email</a></li>';
                    }
                    if ( $newsletter_url ) {
                        echo '<li><a href="' . esc_attr( $newsletter_url ) . '" class="header-subscribe">' . esc_html( 'Subscribe', 'nuclearnetwork' ) . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="col-xs-12 site-branding">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-large-dark.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
                </a>
                <?php
                $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php endif; ?>
            </div>
        </div>
        <div class="content-wrapper row flex-center__y header-bottom">
            <div class="col-xs-8 col-md-2 site-branding-minimal">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-small-dark.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
                </a>
            </div>
            <div class="col-xs-2 col-md nav-container">
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Menu', 'aerospace'); ?></button>
                    <div class="nav-items-container">
                        <?php
                            wp_nav_menu(
                                array(
                                'theme_location' => 'menu-1',
                                'menu_id'        => 'primary-menu',
                                'walker' => new Aerospace_Menu()
                                ) 
                            );
                        ?>
                        <ul class="header-social">
                            <?php
                            if ( $twitter ) {
                                echo '<li><a href="https://twitter.com/' . esc_attr( $twitter ) . '"><i class="icon-twitter"></i></a></li>';
                            }
                            if ( $email ) {
                                echo '<li><a href="mailto:' . esc_attr( $email ) . '?subject=' . esc_attr( get_bloginfo( 'name' ) ) . '">Email</a></li>';
                            }
                            if ( $newsletter_url ) {
                                echo '<li><a href="' . esc_attr( $newsletter_url ) . '" class="header-subscribe">' . esc_html( 'Subscribe', 'nuclearnetwork' ) . '</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </nav><!-- #site-navigation -->
            </div>
            <div class="col-xs-2 col-md-6 search-container">
                <?php get_template_part( 'components/search-inline' ); ?>
            </div>
        </div><!-- .site-branding -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
