<?php

/**
 * The template for displaying the header
 * This is the template that displays all of the <head> section, opens the <body> tag and adds the site's header.
 * @package hd
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php $viewport_content = apply_filters( 'w_viewport_content', 'width=device-width, initial-scale=1' ); ?>
    <meta name="viewport" content="<?php echo $viewport_content; ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php

do_action( 'before_header' );

if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) :

	do_action( 'off_canvas' );
	?>
    <header id="masthead" class="site-header">
		<?php do_action( 'header' ); ?>
    </header><!-- #masthead -->
<?php endif;

echo main_nav();