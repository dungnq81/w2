<?php

/**
 * Displays main navigation
 *
 * @package WordPress
 */

if (!has_nav_menu('main-nav')) :
	menu_fallback(null);
	return;
endif;

?>
<nav id="site-navigation" role="navigation" aria-label="<?php echo esc_attr__('Primary Navigation', W_TEXTDOMAIN); ?>">
	<?php horizontal_nav(); ?>
</nav>
