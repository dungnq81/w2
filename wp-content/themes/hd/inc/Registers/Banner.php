<?php

namespace Webhd\Registers;

class Banner
{
    public function __construct()
    {
        add_action('init', [&$this, 'banner_post_type'], 10);
        add_action('init', [&$this, 'banner_category'], 10);
    }

    public function banner_post_type()
    {
        $labels = array(
            'name'                  => __('Banners', W_TEXTDOMAIN),
            'singular_name'         => __('Banner', W_TEXTDOMAIN),
            'menu_name'             => __('Banners', W_TEXTDOMAIN),
            'name_admin_bar'        => __('Banners', W_TEXTDOMAIN),
            'archives'              => __('Item Archives', W_TEXTDOMAIN),
            'attributes'            => __('Item Attributes', W_TEXTDOMAIN),
            'parent_item_colon'     => __('Parent Item:', W_TEXTDOMAIN),
            'all_items'             => __('All Banners', W_TEXTDOMAIN),
            'add_new_item'          => __('Add New Item', W_TEXTDOMAIN),
            'add_new'               => __('Add New', W_TEXTDOMAIN),
            'new_item'              => __('New Item', W_TEXTDOMAIN),
            'edit_item'             => __('Edit Item', W_TEXTDOMAIN),
            'update_item'           => __('Update Item', W_TEXTDOMAIN),
            'view_item'             => __('View Item', W_TEXTDOMAIN),
            'view_items'            => __('View Items', W_TEXTDOMAIN),
            'search_items'          => __('Search Items', W_TEXTDOMAIN),
            'not_found'             => __('Not found', W_TEXTDOMAIN),
            'not_found_in_trash'    => __('Not found in Trash', W_TEXTDOMAIN),
            'featured_image'        => __('Featured Image', W_TEXTDOMAIN),
            'set_featured_image'    => __('Set featured image', W_TEXTDOMAIN),
            'remove_featured_image' => __('Remove featured image', W_TEXTDOMAIN),
            'use_featured_image'    => __('Use as featured image', W_TEXTDOMAIN),
            'insert_into_item'      => __('Insert Item', W_TEXTDOMAIN),
            'uploaded_to_this_item' => __('Uploaded to this item', W_TEXTDOMAIN),
            'items_list'            => __('Items list', W_TEXTDOMAIN),
            'items_list_navigation' => __('Items list navigation', W_TEXTDOMAIN),
            'filter_items_list'     => __('Filter items list', W_TEXTDOMAIN),
        );
        $args   = array(
            'label'               => __('Banners', W_TEXTDOMAIN),
            'description'         => __('Post Type Description', W_TEXTDOMAIN),
            'labels'              => $labels,
            'supports'            => array('title', 'thumbnail', 'page-attributes'),
            'taxonomies'          => array('banner_cat'),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 12,
            'menu_icon'           => 'dashicons-format-image',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'capability_type'     => 'post',
        );

        register_post_type('banner', $args);
    }

    public function banner_category()
    {
        $labels  = array(
            'name'                       => __('Banner Categories', W_TEXTDOMAIN),
            'singular_name'              => __('Banner Category', W_TEXTDOMAIN),
            'menu_name'                  => __('Banner Categories', W_TEXTDOMAIN),
            'all_items'                  => __('All Items', W_TEXTDOMAIN),
            'parent_item'                => __('Parent Item', W_TEXTDOMAIN),
            'parent_item_colon'          => __('Parent Item:', W_TEXTDOMAIN),
            'new_item_name'              => __('New Item Name', W_TEXTDOMAIN),
            'add_new_item'               => __('Add New Category', W_TEXTDOMAIN),
            'edit_item'                  => __('Edit Item', W_TEXTDOMAIN),
            'update_item'                => __('Update Item', W_TEXTDOMAIN),
            'view_item'                  => __('View Item', W_TEXTDOMAIN),
            'separate_items_with_commas' => __('Separate items with commas', W_TEXTDOMAIN),
            'add_or_remove_items'        => __('Add or remove items', W_TEXTDOMAIN),
            'choose_from_most_used'      => __('Choose from the most used', W_TEXTDOMAIN),
            'popular_items'              => __('Popular Items', W_TEXTDOMAIN),
            'search_items'               => __('Search Items', W_TEXTDOMAIN),
            'not_found'                  => __('Not Found', W_TEXTDOMAIN),
            'no_terms'                   => __('No items', W_TEXTDOMAIN),
            'items_list'                 => __('Items list', W_TEXTDOMAIN),
            'items_list_navigation'      => __('Items list navigation', W_TEXTDOMAIN),
        );
        $rewrite = array(
            'slug'         => 'banners',
            'with_front'   => true,
            'hierarchical' => false,
        );
        $args    = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => false,
            'rewrite'           => $rewrite,
        );

        register_taxonomy('banner_cat', array('banner'), $args);
    }
}
