<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Webhd\Helpers\Str;
use Webhd\Helpers\Url;

use Webhd\Ext\Horizontal_Menu_Walker;
use Webhd\Ext\Vertical_Menu_Walker;

// ------------------------------------------------------

if ( ! function_exists( 'is_posts_page' ) ) {
	/**
	 * Check to see if we're on a posts page
	 *
	 * @since 1.3.39
	 */
	function is_posts_page() {
		return ( is_home() || is_archive() || is_tax() ) ? true : false;
	}
}

// ------------------------------------------------------

if ( ! function_exists( 'lazy_script_tag' ) ) {
	/**
	 * @param array $arr_parsed [ $handle: $value ] -- $value[ 'defer', 'delay' ]
	 * @param string $tag
	 * @param string $handle
	 * @param string $src
	 *
	 * @return array|string|string[]|null
	 */
	function lazy_script_tag( array $arr_parsed, string $tag, string $handle, string $src ) {
		foreach ( $arr_parsed as $str => $value ) {
			if ( str_contains( $handle, $str ) ) {
				if ( 'defer' === $value ) {
					$tag = preg_replace( '/\s+defer\s+/', ' ', $tag );

					return preg_replace( '/\s+src=/', ' defer src=', $tag );
				} elseif ( 'delay' === $value ) {
					$tag = preg_replace( '/\s+defer\s+/', ' ', $tag );

					return preg_replace( '/\s+src=/', ' defer data-type=\'lazy\' data-src=', $tag );
				}
			}
		}

		return $tag;
	}
}

// ------------------------------------------------------

if ( ! function_exists( 'lazy_style_tag' ) ) {
	/**
	 * @param array $arr_styles [ $handle ]
	 * @param string $html
	 * @param string $handle
	 *
	 * @return array|string|string[]|null
	 */
	function lazy_style_tag( array $arr_styles, string $html, string $handle ) {
		foreach ( $arr_styles as $style ) {
			if ( str_contains( $handle, $style ) ) {
				return preg_replace( '/media=\'all\'/', 'media=\'print\' onload=\'this.media="all"\'', $html );
			}
		}

		return $html;
	}
}

// ------------------------------------------------------

if ( ! function_exists( 'get_theme_mod_ssl' ) ) {
	/**
	 * @param $mod_name
	 * @param bool $default
	 *
	 * @return mixed|string|string[]
	 */
	function get_theme_mod_ssl( $mod_name, $default = false ) {
		static $_is_loaded;
		if ( empty( $_is_loaded ) ) {

			// references cannot be directly assigned to static variables, so we use an array
			$_is_loaded[0] = [];
		}

		if ( $mod_name ) {
			if ( ! isset( $_is_loaded[0][ strtolower( $mod_name ) ] ) ) {
				$_mod = get_theme_mod( $mod_name, $default );
				if ( is_ssl() ) {
					$_is_loaded[0][ strtolower( $mod_name ) ] = str_replace( [ 'http://' ], 'https://', $_mod );
				} else {
					$_is_loaded[0][ strtolower( $mod_name ) ] = str_replace( [ 'https://' ], 'http://', $_mod );
				}
			}

			return $_is_loaded[0][ strtolower( $mod_name ) ];
		}

		return $default;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'query_by_term' ) ) {
	/**
	 * @param object $term
	 * @param int $posts_per_page
	 * @param int $paged
	 *
	 * @return bool|WP_Query
	 */
	function query_by_term( $term, $post_type = 'post', $posts_per_page = 0, $paged = 0 ) {
		if ( ! $term || ! $post_type ) {
			return false;
		}
		$_args = [
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
			'post_type'           => $post_type,
			'post_status'         => 'publish',
			'orderby'             => [
				'menu_order' => 'DESC',
				'date'       => 'DESC',
			],
			'tax_query'           => [
				[
					'taxonomy' => $term->taxonomy,
					'terms'    => [ $term->term_id ],
				],
			],
			'nopaging'            => true,
		];
		if ( $posts_per_page ) {
			$_args['posts_per_page'] = $posts_per_page;
		}
		if ( $paged ) {
			$_args['paged']    = $paged;
			$_args['nopaging'] = false;
		}

		$_query = new \WP_Query( $_args );
		if ( ! $_query->have_posts() ) {
			return false;
		}

		return $_query;
	}
}

// ------------------------------------------------------

if ( ! function_exists( 'horizontal_nav' ) ) {
	/**
	 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
	 *
	 * @param array $args
	 *
	 * @return bool|false|string|void
	 */
	function horizontal_nav( array $args = [] ) {
		$args = wp_parse_args(
			(array) $args,
			[
				'container'      => false,
				'menu_id'        => '',
				'menu_class'     => 'dropdown menu horizontal horizontal-menu',
				'theme_location' => '',
				'depth'          => 4,
				'fallback_cb'    => false,
				'walker'         => new Horizontal_Menu_Walker,
				'items_wrap'     => '<ul role="menubar" id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
				'echo'           => false,
			]
		);

		if ( true === $args['echo'] ) {
			echo wp_nav_menu( $args );
		} else {
			return wp_nav_menu( $args );
		}
	}
}

// ------------------------------------------------------

if ( ! function_exists( 'vertical_nav' ) ) {
	/**
	 * @param array $args
	 *
	 * @return bool|false|string|void
	 */
	function vertical_nav( array $args = [] ) {
		$args = wp_parse_args(
			(array) $args,
			[
				'container'      => false, // Remove nav container
				'menu_id'        => '',
				'menu_class'     => 'vertical menu',
				'theme_location' => '',
				'depth'          => 4,
				'fallback_cb'    => false,
				'walker'         => new Vertical_Menu_Walker,
				'items_wrap'     => '<ul role="menubar" id="%1$s" class="%2$s" data-accordion-menu data-submenu-toggle="true">%3$s</ul>',
				'echo'           => false,
			]
		);

		if ( true === $args['echo'] ) {
			echo wp_nav_menu( $args );
		} else {
			return wp_nav_menu( $args );
		}
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'main_nav' ) ) {
	/**
	 * @link http://codex.wordpress.org/Function_Reference/wp_nav_menu
	 *
	 * @param string $location
	 * @param string $menu_class
	 * @param string $menu_id
	 *
	 * @return bool|false|string|void
	 */
	function main_nav( $location = 'main-nav', $menu_class = 'desktop-menu', $menu_id = 'main-menu' ) {
		return horizontal_nav( [
			'menu_id'        => $menu_id,
			'menu_class'     => $menu_class . ' dropdown menu horizontal horizontal-menu',
			'theme_location' => $location,
			'echo'           => false,
		] );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'mobile_nav' ) ) {

	/**
	 * @param string $location
	 * @param string $menu_class
	 * @param string $menu_id
	 *
	 * @return bool|false|string|void
	 */
	function mobile_nav( $location = 'mobile-nav', $menu_class = 'mobile-menu', $menu_id = 'mobile-menu' ) {
		return vertical_nav( [
			'menu_id'        => $menu_id,
			'menu_class'     => $menu_class . ' vertical menu',
			'theme_location' => $location,
			'echo'           => false,
		] );
	}
}

// ------------------------------------------------------

if ( ! function_exists( 'term_nav' ) ) {

	/**
	 * @param string $location
	 * @param string $menu_class
	 *
	 * @return bool|false|string|void
	 */
	function term_nav( $location = 'policy-nav', $menu_class = 'terms-menu' ) {
		return wp_nav_menu( [
			'container'      => false,
			'menu_class'     => $menu_class . ' menu horizontal horizontal-menu',
			'theme_location' => $location,
			'items_wrap'     => '<ul role="menubar" class="%2$s">%3$s</ul>',
			'depth'          => 1,
			'fallback_cb'    => false,
			'echo'           => false,
		] );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'social_nav' ) ) {

	/**
	 * @param string $location
	 * @param string $menu_class
	 *
	 * @return bool|false|string|void
	 */
	function social_nav( $location = 'social-nav', $menu_class = 'social-menu conn-lnk' ) {
		return wp_nav_menu( [
			'container'      => false,
			'theme_location' => $location,
			'menu_class'     => $menu_class,
			'depth'          => 1,
			'link_before'    => '<span class="text">',
			'link_after'     => '</span>',
			'echo'           => false,
		] );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'pagination_links' ) ) {
	/**
	 * @param bool $echo
	 *
	 * @return string|null
	 */
	function pagination_links( $echo = true ) {
		global $wp_query;
		if ( $wp_query->max_num_pages > 1 ) {

			// This needs to be an unlikely integer
			$big = 999999999;

			// For more options and info view the docs for paginate_links()
			// http://codex.wordpress.org/Function_Reference/paginate_links
			$paginate_links = paginate_links(
				apply_filters(
					'wp_pagination_args',
					[
						'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
						'current'   => max( 1, get_query_var( 'paged' ) ),
						'total'     => $wp_query->max_num_pages,
						'end_size'  => 3,
						'mid_size'  => 3,
						'prev_next' => true,
						'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M25.1 247.5l117.8-116c4.7-4.7 12.3-4.7 17 0l7.1 7.1c4.7 4.7 4.7 12.3 0 17L64.7 256l102.2 100.4c4.7 4.7 4.7 12.3 0 17l-7.1 7.1c-4.7 4.7-12.3 4.7-17 0L25 264.5c-4.6-4.7-4.6-12.3.1-17z"/></svg>',
						'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192 512"><path d="M166.9 264.5l-117.8 116c-4.7 4.7-12.3 4.7-17 0l-7.1-7.1c-4.7-4.7-4.7-12.3 0-17L127.3 256 25.1 155.6c-4.7-4.7-4.7-12.3 0-17l7.1-7.1c4.7-4.7 12.3-4.7 17 0l117.8 116c4.6 4.7 4.6 12.3-.1 17z"/></svg>',
						'type'      => 'list',
					]
				)
			);

			$paginate_links = str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $paginate_links );
			$paginate_links = str_replace( '<li><span class="page-numbers dots">&hellip;</span></li>', '<li class="ellipsis"></li>', $paginate_links );
			$paginate_links = str_replace( '<li><span aria-current="page" class="page-numbers current">', '<li class="current"><span aria-current="page" class="show-for-sr">You\'re on page </span>', $paginate_links );
			$paginate_links = str_replace( '</span></li>', '</li>', $paginate_links );
			$paginate_links = preg_replace( '/\s*page-numbers\s*/', '', $paginate_links );
			$paginate_links = preg_replace( '/\s*class=""/', '', $paginate_links );

			// Display the pagination if more than one page is found.
			if ( $paginate_links ) {
				$paginate_links = '<nav aria-label="Pagination">' . $paginate_links . '</nav>';
				if ( $echo ) {
					echo $paginate_links;
				} else {
					return $paginate_links;
				}
			}
		}

		return null;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'site_title_or_logo' ) ) {
	/**
	 * @param bool $echo
	 *
	 * @return string|void
	 */
	function site_title_or_logo( bool $echo = true ) {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$logo = get_custom_logo();
			$html = ( is_home() || is_front_page() ) ? '<h1 class="logo">' . $logo . '</h1>' : $logo;
		} else {
			$tag  = is_home() ? 'h1' : 'div';
			$html = '<' . esc_attr( $tag ) . ' class="site-title"><a title href="' . Url::home() . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';
			if ( '' !== get_bloginfo( 'description' ) ) {
				$html .= '<p class="site-description">' . esc_html( get_bloginfo( 'description', 'display' ) ) . '</p>';
			}
		}

		if ( ! $echo ) {
			return $html;
		}

		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'site_logo' ) ) {
	/**
	 * @param string $theme - default|light|dark
	 *
	 * @return string
	 */
	function site_logo( string $theme = 'default', $class = '' ) {
		$html = '';
		$class || $class = 'site-logo after-overlay';

		if ( 'default' !== $theme ) {
			$theme_logo = get_theme_mod_ssl( $theme . '_logo' );

			/*
			* If the alt attribute is not empty, there's no need to explicitly pass it
			* because wp_get_attachment_image() already adds the alt attribute.
			*/
			$logo = wp_get_attachment_image( attachment_url_to_postid( $theme_logo ), 'full', false );
			$html = '<div class="' . $class . '"><a class="after-overlay" title href="' . Url::home() . '" rel="home">' . $logo . '</a></div>';
		} else if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$logo = get_custom_logo();
			$html = '<div class="' . $class . '"><a class="after-overlay" title href="' . Url::home() . '" rel="home">' . $logo . '</a></div>';
		}

		return $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'loop_excerpt' ) ) {
	/**
	 * @param null $post
	 * @param string $class
	 *
	 * @return string|null
	 */
	function loop_excerpt( $post = null, string $class = 'excerpt' ) {
		$excerpt = get_the_excerpt( $post );
		if ( ! Str::stripSpace( $excerpt ) ) {
			return null;
		}

		if ( ! $class ) {
			return $excerpt;
		}

		return "<p class=\"$class\">{$excerpt}</p>";
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'post_excerpt' ) ) {
	/**
	 * @param null $post
	 * @param string $class
	 *
	 * @return string|null
	 */
	function post_excerpt( $post = null, $class = 'excerpt' ) {
		if ( ! Str::stripSpace( $post->post_excerpt ) ) {
			return null;
		}

		$open  = '';
		$close = '';
		if ( $class ) {
			$open  = '<p class="' . $class . '">';
			$close = '</p>';
		}

		return $open . $post->post_excerpt . $close;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'term_excerpt' ) ) {
	/**
	 * @param int $term
	 * @param string $class
	 *
	 * @return string|null
	 */
	function term_excerpt( $term = 0, $class = 'excerpt' ) {
		$description = term_description( $term );
		if ( ! Str::stripSpace( $description ) ) {
			return null;
		}

		if ( ! $class ) {
			return $description;
		}

		return "<p class=\"$class\">$description</p>";
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'primary_term' ) ) {
	/**
	 * @param null $post
	 * @param string $taxonomy
	 *
	 * @return array|bool|int|mixed|object|WP_Error|WP_Term|null
	 */
	function primary_term( $post = null, string $taxonomy = '' ) {
		$post = get_post( $post );
		$ID   = is_numeric( $post ) ? $post : $post->ID;

		if ( ! $taxonomy ) {
			$post_type  = get_post_type( $ID );
			$taxonomies = get_object_taxonomies( $post_type );
			if ( isset( $taxonomies[0] ) ) {
				if ( 'product_type' == $taxonomies[0] && isset( $taxonomies[2] ) ) {
					$taxonomy = $taxonomies[2];
				}
			}
		}

		if ( ! $taxonomy ) {
			$taxonomy = 'category';
		}

		// Rank Math SEO
		// https://vi.wordpress.org/plugins/seo-by-rank-math/
		$primary_term_id = get_post_meta( get_the_ID(), 'rank_math_primary_' . $taxonomy, true );
		if ( $primary_term_id ) {
			$term = get_term( $primary_term_id, $taxonomy );
			if ( $term ) {
				return $term;
			}
		}

		// Yoast SEO
		// https://vi.wordpress.org/plugins/wordpress-seo/
		if ( class_exists( '\WPSEO_Primary_Term' ) ) {

			// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
			$wpseo_primary_term = new \WPSEO_Primary_Term( $taxonomy, $ID );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term, $taxonomy );
			if ( $term ) {
				return $term;
			}
		}

		// Default, first category
		$post_terms = get_the_terms( $post, $taxonomy );
		if ( is_array( $post_terms ) ) {
			return $post_terms[0];
		}

		return false;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'get_primary_term' ) ) {
	/**
	 * @param        $post
	 * @param string $taxonomy
	 * @param string $wrapper_open
	 * @param string $wrapper_close
	 *
	 * @return string
	 */
	function get_primary_term( $post, $taxonomy = '', $wrapper_open = '<div class="terms">', $wrapper_close = '</div>' ) {
		$term = primary_term( $post, $taxonomy );
		if ( ! $term ) {
			return;
		}

		$link = '<a href="' . esc_url( get_term_link( $term, $taxonomy ) ) . '" title="' . esc_attr( $term->name ) . '">' . $term->name . '</a>';
		if ( $wrapper_open && $wrapper_close ) {
			$link = $wrapper_open . $link . $wrapper_close;
		}

		return $link;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'post_terms' ) ) {
	/**
	 * @param $id
	 * @param string $taxonomy
	 * @param string $wrapper_open
	 * @param string $wrapper_close
	 *
	 * @return string|null
	 */
	function post_terms( $id, string $taxonomy = 'category', string $wrapper_open = '<div class="terms">', string $wrapper_close = '</div>' ) {
		if ( ! $taxonomy ) {
			$taxonomy = 'category';
		}

		$link       = '';
		$post_terms = get_the_terms( $id, $taxonomy );
		if ( empty( $post_terms ) ) {
			return false;
		}

		foreach ( $post_terms as $term ) {
			if ( $term->slug ) {
				$link .= '<a href="' . esc_url( $link ) . '" title="' . esc_attr( $term->name ) . '">' . $term->name . '</a>';
			}
		}

		if ( $wrapper_open && $wrapper_close ) {
			$link = $wrapper_open . $link . $wrapper_close;
		}

		return $link;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'the_hashtags' ) ) {
	/**
	 * @param string $taxonomy
	 * @param int $id
	 * @param string $sep
	 *
	 * @return void
	 */
	function the_hashtags( string $taxonomy = 'post_tag', int $id = 0, $sep = '' ) {
		if ( ! $taxonomy ) {
			$taxonomy = 'post_tag';
		}

		// Get Tags for posts.
		$hashtag_list = get_the_term_list( $id, $taxonomy, '', $sep );

		// We don't want to output .entry-footer if it will be empty, so make sure its not.
		if ( $hashtag_list ) {
			echo '<div class="hashtags">';
			printf(
			/* translators: 1: SVG icon. 2: posted in label, only visible to screen readers. 3: list of tags. */
				'<div class="hashtag-links links">%1$s<span class="screen-reader-text">%2$s </span>%3$s</div>',
				'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64"><path d="M446.381 182.109l1.429-8c1.313-7.355-4.342-14.109-11.813-14.109h-98.601l20.338-113.891C359.047 38.754 353.392 32 345.92 32h-8.127a12 12 0 0 0-11.813 9.891L304.89 160H177.396l20.338-113.891C199.047 38.754 193.392 32 185.92 32h-8.127a12 12 0 0 0-11.813 9.891L144.89 160H42.003a12 12 0 0 0-11.813 9.891l-1.429 8C27.448 185.246 33.103 192 40.575 192h98.6l-22.857 128H13.432a12 12 0 0 0-11.813 9.891l-1.429 8C-1.123 345.246 4.532 352 12.003 352h98.601L90.266 465.891C88.953 473.246 94.608 480 102.08 480h8.127a12 12 0 0 0 11.813-9.891L143.11 352h127.494l-20.338 113.891C248.953 473.246 254.608 480 262.08 480h8.127a12 12 0 0 0 11.813-9.891L303.11 352h102.886a12 12 0 0 0 11.813-9.891l1.429-8c1.313-7.355-4.342-14.109-11.813-14.109h-98.601l22.857-128h102.886a12 12 0 0 0 11.814-9.891zM276.318 320H148.825l22.857-128h127.494l-22.858 128z"/></svg>',
				__( 'Tags', 'hd' ),
				$hashtag_list
			); // WPCS: XSS OK.

			echo '</div>';
		}
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'post_image_src' ) ) {
	/**
	 * @param $post_id
	 * @param string $size
	 *
	 * @return string|null
	 */
	function post_image_src( $post_id, string $size = 'thumbnail' ) {
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
		if ( $thumbnail ) {
			return $thumbnail[0];
		}

		return null;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'attachment_image_src' ) ) {
	/**
	 * @param $attachment_id
	 * @param string $size
	 *
	 * @return string|null
	 */
	function attachment_image_src( $attachment_id, string $size = 'thumbnail' ) {
		$image = wp_get_attachment_image_src( $attachment_id, $size );
		if ( $image ) {
			//[$src, $width, $height] = $image;
			return $image[0];
		}

		return null;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'get_lang' ) ) {
	/**
	 * Get lang code
	 * @return string
	 */
	function get_lang() {
		return strtolower( substr( get_locale(), 0, 2 ) );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'get_f_locale' ) ) {
	/**
	 * @return mixed|string
	 */
	function get_f_locale() {
		$arr     = locale_array();
		$arr_key = array_keys( $arr );
		$locale  = get_locale();
		if ( ! in_array( $locale, $arr_key ) ) {
			return $locale;
		}

		return $arr[ $locale ];
	}
}


// -------------------------------------------------------------

if ( ! function_exists( 'locale_array' ) ) {
	/**
	 * @return array
	 */
	function locale_array() {
		return [
			'af' => 'af_ZA',
			'ar' => 'ar_AR',
			'az' => 'az_AZ',
			'ca' => 'ca_ES',
			'cy' => 'cy_GB',
			'el' => 'el_GR',
			'eo' => 'eo_EO',
			'et' => 'et_EE',
			'eu' => 'eu_ES',
			'fi' => 'fi_FI',
			'gu' => 'gu_IN',
			'hr' => 'hr_HR',
			'hy' => 'hy_AM',
			'ja' => 'ja_JP',
			'kk' => 'kk_KZ',
			'km' => 'km_KH',
			'lv' => 'lv_LV',
			'mn' => 'mn_MN',
			'mr' => 'mr_IN',
			'ps' => 'ps_AF',
			'sq' => 'sq_AL',
			'te' => 'te_IN',
			'th' => 'th_TH',
			'tl' => 'tl_PH',
			'uk' => 'uk_UA',
			'ur' => 'ur_PK',
			'vi' => 'vi_VN',
		];
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'placeholder_src' ) ) {
	/**
	 * placeholder_src function
	 *
	 * @param boolean $img_wrap
	 * @param boolean $thumb
	 *
	 * @return string
	 */
	function placeholder_src( bool $img_wrap = true, bool $thumb = true ) {
		$src = W_THEME_URL . '/assets/img/placeholder.png';
		if ( $thumb == true ) {
			$src = W_THEME_URL . '/assets/img/placeholder-320x320.png';
		}
		if ( $img_wrap == true ) {
			$src = "<img loading=\"lazy\" src=\"{$src}\" alt=\"placeholder\" class=\"wp-placeholder\">";
		}

		return $src;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'acf_term_thumb' ) ) {
	/**
	 * @param $term_id
	 * @param null $acf_field_name
	 * @param string $size
	 * @param false $img_wrap
	 *
	 * @return string|null
	 */
	function acf_term_thumb( $term_id, $acf_field_name = null, string $size = "thumbnail", bool $img_wrap = false ) {
		if ( function_exists( 'get_field' ) && $attach_id = get_field( $acf_field_name, get_term( $term_id ) ) ) {
			$img_src = attachment_image_src( $attach_id, $size );
			if ( true === $img_wrap ) {
				$img_src = wp_get_attachment_image( $attach_id, $size );
			}

			return $img_src;
		}

		return null;
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'humanize_time' ) ) {
	/**
	 * Determines the difference between two timestamps.
	 * The difference is returned in a human readable format such as "1 hour", "5 mins", "2 days".
	 *
	 * @param string|null $from Unix timestamp from which the difference begins.
	 * @param string|null $to Optional. Unix timestamp to end the time difference.
	 *
	 * @param null|int|object $$post
	 * @param null $_time
	 *
	 * @return string Human readable time difference.
	 */
	function humanize_time( $from = null, $to = null, $post = null, $_time = null ) {
		$flag = false;
		$_ago = __( 'ago', 'hd' );
		if ( empty( $to ) ) {
			$to = current_time( 'timestamp' );
		}
		if ( empty( $from ) ) {
			$from = get_the_time( 'U', $post );
		}

		$diff = (int) abs( $to - $from );
		if ( $diff < HOUR_IN_SECONDS ) {
			$mins = round( $diff / MINUTE_IN_SECONDS );
			if ( $mins <= 1 ) {
				$mins = 1;
			}
			/* translators: Time difference between two dates, in minutes (min=minute). %s: Number of minutes */
			$since = sprintf( _n( '%s min', '%s mins', $mins ), $mins );
		} elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
			$hours = round( $diff / HOUR_IN_SECONDS );
			if ( $hours <= 1 ) {
				$hours = 1;
			}
			/* translators: Time difference between two dates, in hours. %s: Number of hours */
			$since = sprintf( _n( '%s hour', '%s hours', $hours ), $hours );
		} elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
			$days = round( $diff / DAY_IN_SECONDS );
			if ( $days <= 1 ) {
				$days = 1;
			}
			/* translators: Time difference between two dates, in days. %s: Number of days */
			$since = sprintf( _n( '%s day', '%s days', $days, 'hd' ), $days );
		} else {
			$flag  = true;
			$since = ( $_time == null ) ? get_the_date( '', $post ) : sprintf( __( '%1$s at %2$s', 'hd' ), date( get_option( 'date_format' ), $from ), $_time );
		}
		if ( $flag == false ) {
			$since = $since . ' <span class="ago">' . $_ago . '</span>';
		}

		return apply_filters( 'humanize_time', $since, $diff, $from, $to );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'the_page_title_theme' ) ) {
	function the_page_title_theme() {
		get_template_part( 'template-parts/parts/page-title' );
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'the_breadcrumbs' ) ) {
	/**
	 * Breadcrumbs
	 * return void
	 */
	function the_breadcrumbs() {
		global $post;
		global $wp_query;

		$before = '<li class="current">';
		$after  = '</li>';

		if ( ! is_home() && ! is_front_page() || is_paged() || $wp_query->is_posts_page ) {
			echo '<ol id="crumbs" class="breadcrumbs" aria-label="breadcrumbs">';
			echo '<li><a class="home" href="' . Url::home() . '">' . __( 'Home', 'hd' ) . '</a></li>';

			/**
			 * @todo viết thêm cho trường hợp taxonomy
			 */
			if ( is_category() || is_tax() ) {

				$cat_obj = $wp_query->get_queried_object();
				$thisCat = get_category( $cat_obj->term_id );

				if ( isset( $thisCat->parent ) && 0 != $thisCat->parent ) {
					$parentCat = get_category( $thisCat->parent );

					if ( $cat_code = get_category_parents( $parentCat->term_id, true, '' ) ) {
						$cat_code = str_replace( '<a', '<li><a', $cat_code );
						echo $cat_code = str_replace( '</a>', '</a></li>', $cat_code );
					}
				}

				echo $before . single_cat_title( '', false ) . $after;
			} elseif ( is_day() ) {
				echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
				echo '<li><a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '">' . get_the_time( 'F' ) . '</a></li>';
				echo $before . get_the_time( 'd' ) . $after;
			} elseif ( is_month() ) {
				echo '<li><a href="' . get_year_link( get_the_time( 'Y' ) ) . '">' . get_the_time( 'Y' ) . '</a></li>';
				echo $before . get_the_time( 'F' ) . $after;
			} elseif ( is_year() ) {
				echo $before . get_the_time( 'Y' ) . $after;
			} elseif ( is_single() && ! is_attachment() ) {
				if ( 'post' != get_post_type() ) {
					$post_type = get_post_type_object( get_post_type() );
					$slug      = $post_type->rewrite;
					if ( ! is_bool( $slug ) ) {
						echo '<li><a href="' . Url::home() . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></span>';
					}

					//echo $before . get_the_title() . $after;
				} else {
					$cat = primary_term( $post );
					if ( ! empty( $cat ) ) {
						if ( ! is_wp_error( $cat_code = get_category_parents( $cat->term_id, true, '' ) ) ) {
							$cat_code = str_replace( '<a', '<li><a', $cat_code );
							echo $cat_code = str_replace( '</a>', '</a></li>', $cat_code );
						}
					}

					//echo $before . get_the_title() . $after;
				}
			} elseif ( ( is_page() && ! $post->post_parent ) || ( function_exists( 'bp_current_component' ) && bp_current_component() ) ) {
				echo $before . get_the_title() . $after;
			} elseif ( is_search() ) {
				echo $before;
				printf( __( 'Search Results for: %s', 'hd' ), get_search_query() );
				echo $after;
			} elseif ( ! is_single() && ! is_page() && 'post' != get_post_type() ) {
				$post_type = get_post_type_object( get_post_type() );
				echo $before . $post_type->labels->singular_name . $after;
			} elseif ( is_attachment() ) {
				$parent = get_post( $post->post_parent );
				echo '<li><a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a></li>';
				echo $before . get_the_title() . $after;
			} elseif ( is_page() && $post->post_parent ) {
				$parent_id   = $post->post_parent;
				$breadcrumbs = [];

				while ( $parent_id ) {
					$page          = get_post( $parent_id );
					$breadcrumbs[] = '<li><a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>';
					$parent_id     = $page->post_parent;
				}

				$breadcrumbs = array_reverse( $breadcrumbs );
				foreach ( $breadcrumbs as $crumb ) {
					echo $crumb;
				}

				echo $before . get_the_title() . $after;
			} elseif ( is_tag() ) {
				echo $before;
				printf( __( 'Tag Archives: %s', 'hd' ), single_tag_title( '', false ) );
				echo $after;
			} elseif ( is_author() ) {
				global $author;

				$userdata = get_userdata( $author );
				echo $before;
				echo $userdata->display_name;
				echo $after;
			} elseif ( $wp_query->is_posts_page ) {
				$posts_page_title = get_the_title( get_option( 'page_for_posts', true ) );
				echo $before . $posts_page_title . $after;
			} elseif ( is_404() ) {
				echo $before;
				__( 'Not Found', 'hd' );
				echo $after;
			}
			if ( get_query_var( 'paged' ) ) {
				echo '<li class="paged">';
				if ( is_category() || is_tax() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ' (';
				}
				echo __( 'page', 'hd' ) . ' ' . get_query_var( 'paged' );
				if ( is_category() || is_tax() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
					echo ')';
				}
				echo $after;
			}

			echo '</ol>';
		}

		// reset
		wp_reset_query();
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'the_comment_html' ) ) {
	/**
	 * @param mixed $id The ID, to load a single record; Provide array of $params to run 'find'
	 */
	function the_comment_html( $id = null ) {
		if ( is_null( $id ) ) {
			$id = get_post()->ID;
		}

		/*
		 * If the current post is protected by a password and
		 * the visitor has not yet entered the password we will
		 * return early without loading the comments.
		*/
		if ( post_password_required( $id ) ) {
			return;
		}

		$wrapper_open  = "<div class=\"comments-wrapper\">";
		$wrapper_close = "</div>";
		$post_type     = get_post_type( $id );

		$facebook_comment = false;
		$zalo_comment     = false;

		if ( class_exists( '\ACF' ) ) {
			$facebook_comment = get_field( 'facebook_comment', $id );
			$zalo_comment     = get_field( 'zalo_comment', $id );
		}

		if ( comment_enable() or true === $facebook_comment or true === $zalo_comment ) {
			echo $wrapper_open;
			if ( comment_enable() ) {
				if ( ( class_exists( '\WooCommerce' ) && 'product' != $post_type ) || ! class_exists( '\WooCommerce' ) ) {
					comments_template();
				}
			}
			if ( true === $facebook_comment ) {
				get_template_part( 'template-parts/comment/facebook' );
			}
			if ( true === $zalo_comment ) {
				get_template_part( 'template-parts/comment/zalo' );
			}

			echo $wrapper_close;
		}
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'comment_enable' ) ) {
	/**
	 * @return bool
	 */
	function comment_enable() {
		return ( comments_open() or (bool) get_comments_number() ) && ! post_password_required();
	}
}

// -------------------------------------------------------------

if ( ! function_exists( 'menu_fallback' ) ) {
	/**
	 * A fallback when no navigation is selected by default.
	 *
	 * @return void
	 */
	function menu_fallback( $container = 'grid-container' ) {
		echo '<div class="menu-fallback">';
		if ( $container ) {
			echo '<div class="' . $container . '">';
		}
		/* translators: %1$s: link to menus, %2$s: link to customize. */
		printf(
			__( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'hd' ),
			/* translators: %s: menu url */
			sprintf(
				__( '<a class="_blank" href="%s">Menus</a>', 'hd' ),
				get_admin_url( get_current_blog_id(), 'nav-menus.php' )
			),
			/* translators: %s: customize url */
			sprintf(
				__( '<a class="_blank" href="%s">Customize</a>', 'hd' ),
				get_admin_url( get_current_blog_id(), 'customize.php' )
			)
		);
		if ( $container ) {
			echo '</div>';
		}
		echo '</div>';
	}
}