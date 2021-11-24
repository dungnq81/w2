<?php

/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (have_posts()) the_post();

?>
<section class="section single-elementor">
	<div class="col-content clearfix">
		<?php
		// post content
		the_content();
		?>
	</div>
</section>
