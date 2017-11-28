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
        <div class="content-wrapper row">
            <div class="col-xs-12 site-branding">
                <?php the_custom_logo(); ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo-large-dark.svg" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('name'); ?>" />
                </a>
                <?php
                $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview() ) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php endif; ?>
            </div>
            <div class="col-xs-12 col-md-6">
                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'aerospace'); ?></button>
                    <?php
                        wp_nav_menu(
                            array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                            'walker' => new Aerospace_Menu()
                            ) 
                        );
                    ?>
                </nav><!-- #site-navigation -->
            </div>
            <div class="col-xs-12 col-md-6 search-container">
                <?php get_template_part( 'search-inline' ); ?>
            </div>
        </div><!-- .site-branding -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
