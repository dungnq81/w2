<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Webhd\Helpers\Str;

$post_page_id = get_option( 'page_for_posts' );
$term         = get_queried_object();

if ( $post_page_id && $post_page_id == $term->ID ) { // is posts page
	$desc = post_excerpt( $term );
} else {
	$desc = term_excerpt( $term );
}

// template-parts/parts/page-title.php
the_page_title_theme();

?>
<section class="section archives archive-posts">
    <div class="grid-container">
		<?php if ( Str::stripSpace( $desc ) ) : ?>
            <div class="archive-desc"><?= $desc ?></div>
		<?php endif; ?>
		<?php get_template_part( 'template-parts/post/grid' ); ?>
    </div>
</section>