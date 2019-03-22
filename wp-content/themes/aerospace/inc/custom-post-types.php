<?php
/**
* Custom Post Types
*
*@package aerospace
*/

/*----------  Podcasts  ----------*/
require get_template_directory() . '/inc/cpts/aerospace101.php';

/*----------  Data  ----------*/
require get_template_directory() . '/inc/cpts/data.php';

/*----------  Events  ----------*/
require get_template_directory() . '/inc/cpts/events.php';

/*----------  Pages  ----------*/
require get_template_directory() . '/inc/cpts/page.php';

add_post_type_support( 'page', 'excerpt' );
