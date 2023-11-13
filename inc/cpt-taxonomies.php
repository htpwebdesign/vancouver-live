<?php

// Register Custom Post Types
function vli_register_cpts() {
    // Custom Post Type: Vendors
    $labels = array(
        'name' => 'Vendors',
        'singular_name' => 'Vendor',
        'menu_name' => 'Vendors',
        'add_new_item' => 'Add New Vendor',
        // Add other labels as needed.
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'vendors'),
        'supports' => array('title', 'thumbnail', 'archive'),
        // Add other arguments as needed.
    );

    register_post_type('vanlive-vendor', $args);

    // Custom Post Type: Performers
    $labels = array(
        'name' => 'Performers',
        'singular_name' => 'Performer',
        'menu_name' => 'Performers',
        'add_new_item' => 'Add New Performer',
        // Add other labels as needed.
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'performers'),
        'supports' => array('title', 'thumbnail', 'archive'),
        // Add other arguments as needed.
    );

    register_post_type('vanlive-performer', $args);
}
add_action('init', 'vli_register_cpts');

// Register Taxonomies
function vli_register_taxonomies() {
    // Taxonomy: Day 
    $labels = array(
        'name' => _x('Day', 'taxonomy general name'),
        'singular_name' => _x('Day', 'taxonomy singular name'),
        'search_items' => __('Search Days'),
        'all_items' => __('All Days'),
        'parent_item' => __('Parent'),
        'parent_item_colon' => __('Parent'),
        'edit_item' => __('Edit Days'),
        'update_item' => __('Update Days'),
        'add_new_item' => __('Add Day'),
        'new_item_name' => __('New Day'),
        'menu_name' => __('Days'),
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'day'],
    );

    register_taxonomy('day', 'vanlive-performer', $args);


}
add_action('init', 'vli_register_taxonomies');

