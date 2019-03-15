<?php

/**
 * Custom Post Types
 */

add_action('init', function () {

    // Post Type's Labels & Info Here
    $plural_name     = 'Wikis'; // human readable
    $singular_name   = 'Wiki'; // human readable
    $slug            = '%topic%'; // use hyphens
    $registered_name = 'wiki'; // use underscores
    $menu_icon       = 'dashicons-info'; // https://developer.wordpress.org/resource/dashicons

    $labels = [
        'name'                  => $plural_name,
        'singular_name'         => $singular_name,
        'add_new'               => " Add New ",
        'add_new_item'          => "Add New {$singular_name}",
        'edit_item'             => "Edit {$singular_name}",
        'new_item'              => "New {$singular_name}",
        'view_item'             => "View {$singular_name}",
        'view_items'            => "View {$plural_name}",
        'search_items'          => "Search {$plural_name}",
        'not_found'             => "No {$plural_name} found.",
        'not_found_in_trash'    => "No {$plural_name} found in trash.",
        'parent_item_colon'     => "Parent {$plural_name}:",
        'all_items'             => "All {$plural_name}",
        'archives'              => "{$singular_name} Archives",
        'attributes'            => "{$singular_name} Attributes",
        'insert_into_item'      => "Inserts Into {$singular_name}",
        'uploaded_to_this_item' => "Uploaded to this {$singular_name}",
        // 'featured_image'        => "",
        // 'set_featured_image'    => "",
        // 'remove_featured_image' => "",
        // 'use_featured_image'    => "",
        'menu_name'             => $plural_name,
        // 'filter_items_list'     => "",
        // 'items_list_navigation' => "",
        // 'items_list'            => "",
        'name_admin_bar'        => $singular_name,
    ];

    $args   = [
        'label'               => $plural_name,
        'labels'              => $labels,
        'description'         => '',
        'public'              => true,
        'exclude_from_search' => false,
        'public_queryable'    => true,
        'show_ui'             => true,
        'show_in_nav_menus'   => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'menu_icon'           => $menu_icon, // Custom icon in WP-admin area
        // 'capability_type'       => ['posts', 'post'],
        // 'capabilities'          => [
        // 'edit_post',
        // 'read_post',
        // 'delete_post',
        // 'edit_posts',
        // 'edit_others_posts',
        // 'publish_posts',
        // 'read_private_posts'
        // ],
        // 'map_meta_cap'          => true,
        'hierarchical'        => false,
        'supports'            => [
            'title',
            'editor',
            'author',
            'thumbnail',
            // 'excerpt',
            // 'trackbacks',
            // 'custom-fields',
            // 'comments',
            // 'revisions',
            // 'page-attributes',
            // 'post-formats'
        ],
        // 'register_meta_box_cb'  => false,
        // 'taxonomies'            => [],
        'has_archive'         => false,
        'rewrite'             => ['slug' => $slug, 'with_front' => false],
        // 'permalink_epmask'      => '',
        'query_var'           => true,
        'can_export'          => true,
        // 'delete_with_user'      => false,
        'show_in_rest'        => true,
        // 'rest_base'             => '',
        // 'rest_controller_class' => '',
    ];

    register_post_type($registered_name, $args);
});

