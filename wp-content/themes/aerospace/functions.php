<?php
/**
 * Aerospace functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Aerospace
 */

if (! function_exists('aerospace_setup') ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function aerospace_setup()
    {
        /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on Aerospace, use a find and replace
        * to change 'aerospace' to the name of your theme in all the template files.
        */
        load_theme_textdomain('aerospace', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
        * Let WordPress manage the document title.
        * By adding theme support, we declare that this theme does not use a
        * hard-coded <title> tag in the document head, and expect WordPress to
        * provide it for us.
        */
        add_theme_support('title-tag');

        /*
        * Enable support for Post Thumbnails on posts and pages.
        *
        * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
        */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
            'menu-1' => esc_html__('Primary', 'aerospace'),
            )
        );

        /*
        * Switch default core markup for search form, comment form, and comments
        * to output valid HTML5.
        */
        add_theme_support(
            'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background', apply_filters(
                'aerospace_custom_background_args', array(
                'default-color' => 'ffffff',
                'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
            )
        );
    }
endif;

add_action('after_setup_theme', 'aerospace_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function aerospace_content_width()
{
    $GLOBALS['content_width'] = apply_filters('aerospace_content_width', 640);
}
add_action('after_setup_theme', 'aerospace_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aerospace_widgets_init()
{
    register_sidebar(
        array(
        'name'          => esc_html__('Sidebar', 'aerospace'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'aerospace'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'aerospace_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function aerospace_scripts()
{
    global $post;
    wp_enqueue_style('aerospace-style', get_stylesheet_uri());

    wp_enqueue_script('aerospace-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

    wp_enqueue_script('aerospace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    wp_enqueue_script('aerospace-header', get_template_directory_uri() . '/js/header.js', array('jquery'), '20171128', true);

    // Posts
    if ( is_single() ) {
        wp_enqueue_script( 'aerospace-iframe-resize', 'https://cdnjs.cloudflare.com/ajax/libs/iframe-resizer/3.5.14/iframeResizer.min.js', array(), '20170622', true );
        wp_add_inline_script( 'aerospace-iframe-resize', 'jQuery("iframe.js-iframeResizeEnabled").iFrameResize({log:false});' );

        wp_enqueue_script('aerospace-clipboard', 'https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js', array(), '20171129', true );
        wp_add_inline_script('aerospace-clipboard', "var clipboard = new Clipboard('#btn-copy');
            clipboard.on('success', function(e) {
                var d = document.getElementById('btn-copy');
                d.className += ' tooltipped';
            });
        ");

        wp_enqueue_script('aerospace-posts', get_template_directory_uri() . '/js/posts.js', array('jquery'), '20171129', true);

        wp_enqueue_script('aerospace-share', get_template_directory_uri() . '/js/social-share.js', array('jquery'), '20171206', true);

        wp_enqueue_script('aerospace-aos', get_template_directory_uri() . '/js/aos.min.js', array(), '20180305', true);
        wp_add_inline_script('aerospace-aos', 'AOS.init({
          offset: 200,
          duration: 400,
          easing: "ease-in-sine",
          delay: 100,
        });');

        wp_add_inline_style( 'aerospace-style', aerospace_post_custom_css( $post->ID ) );

        if ( is_page_template( 'single-longform.php' ) ) {
            wp_enqueue_script('aerospace-toc', get_template_directory_uri() . '/js/table-of-contents.js', array('jquery'), '20180319', true);
        }
    }

    // ASP Archive Page
    if ( is_post_type_archive( 'aerospace101' ) ) {
        wp_enqueue_script('aerospace-aerospace101-archive', get_template_directory_uri() . '/js/aerospace101-archives.js', array('jquery'), '20171202', true);
    }

    // Search
    if ( is_search() || $_SERVER['REQUEST_URI'] == '/search' ) {
        wp_register_script( 'aerospace-search', get_template_directory_uri() . '/js/search.js', '', '20171203', true );

        $search_vars = array(
            'home_url' => esc_url( home_url( '/' ) )
        );
        wp_localize_script( 'aerospace-search', 'search_vars', $search_vars );
        wp_enqueue_script( 'aerospace-search' );
    }

    if ( is_single() && 'events' === get_post_type() ) {
        wp_enqueue_script('aerospace-calendar', 'https://addevent.com/libs/atc/1.6.1/atc.min.js', array(), '20171204', true );
        wp_add_inline_script('aerospace-calendar', "window.addeventasync = function(){
                addeventatc.settings({
                    dropdown   : {order:'outlook,appleical,google,outlookcom'},
                    appleical: { show: true, text: 'iCal' },
                    google: { show: true, text: 'Google Cal' },
                    yahoo: { show: false },
                    outlookcom: { show: false }
                });
            };
        ");
    }
}
add_action('wp_enqueue_scripts', 'aerospace_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom Nav Walker for Primary Menu
 */
require get_template_directory() . '/inc/aerospace-header-menu-walker.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Register Custom Settings
 */
require get_template_directory() . '/inc/custom-settings.php';

/**
 * Register Custom Post Meta Boxes for posts
 */
require get_template_directory() . '/inc/custom-post-meta.php';

/**
 * Register Custom Post Types
 */
require get_template_directory() . '/inc/custom-post-types.php';

/**
 * Register Custom Post Types
 */
require get_template_directory() . '/inc/custom-taxonomies.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION') ) {
    include get_template_directory() . '/inc/jetpack.php';
}

/**
 * shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Longform shortcodes
 */
require get_template_directory() . '/inc/shortcodes-longform.php';

/**
 * Register Custom TinyMCE Buttons
 */
require get_template_directory() . '/inc/custom-tinymce-buttons.php';

/**
 * Remove AddToAny Default CSS
 */
add_action( 'wp_enqueue_scripts', function() { wp_dequeue_style( 'addtoany' ); }, 21 );

