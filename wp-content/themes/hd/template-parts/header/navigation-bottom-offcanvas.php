<?php

/**
 * Displays navigation mobile
 *
 * @package WordPress
 */

$txt_logo = get_option('blogname');
$img_logo = get_theme_mod_ssl('logo_mobile');

$image = ($image = wp_get_attachment_image($img_logo, 'thumbnail')) ? $image : null;
if (empty($image)) :
    $html = sprintf('<a href="%1$s" class="mobile-logo-link" rel="home">%2$s</a>', esc_url(home_url('/')), $txt_logo);
else :
    $html = sprintf('<a href="%1$s" class="mobile-logo-link" rel="home">%2$s</a>', esc_url(home_url('/')), $image);
endif;

?>
<div class="off-canvas position-top" id="offCanvasMenu" data-off-canvas>
    <button class="menu-lines" aria-label="Close" type="button" data-close>
        <span class="line line-1"></span>
        <span class="line line-2"></span>
    </button>
    <div class="title-bar-title"><?php echo $html; ?></div>
    <?php echo vertical_nav(); ?>
</div>