<?php

/**
 * Custom Taxonomies
 */

add_action('init', function () {

    // Taxonomy Labels & Info Here
    $plural_name     = 'Topics'; // human readable
    $singular_name   = 'Topic'; // human readable
    $slug            = 'topic'; // use hyphens
    $registered_name = 'topic'; // use underscores
    $post_type       = ['wiki']; // post-type(s) $registered_name(s)

    $labels = [
        'name'                       => $plural_name,
        'singular_name'              => $singular_name,
        'menu_name'                  => $plural_name,
        'all_items'                  => "All {$plural_name}",
        'edit_item'                  => "Edit $singular_name",
        'view_item'                  => "View $singular_name",
        'update_item'                => "Update {$singular_name}",
        'add_new_item'               => "Add New {$singular_name}",
        'new_item_name'              => "New {$singular_name} Name",
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'search_items'               => "Search {$plural_name}",
        'popular_items'              => "Popular {$plural_name}",
        'separate_items_with_commas' => "Seperate {$plural_name} with commas",
        'add_or_remove_items'        => "Add or Remove Items",
        'choose_from_most_used'      => "Choose from the most used",
        'not_found'                  => "No {$plural_name} found.",
    ];

    $args = [
        'label'                 => $plural_name,
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'show_in_nav_menus'     => true,
        'show_in_rest'          => true,
        'rest_base'             => $registered_name,
        // 'rest_controller_class' => '',
        'show_tagcloud'         => true,
        'show_in_quick_edit'    => true,
        // 'meta_box_cb'           => false, // Uncomment to keep UI, but hide the Meta Box. !-- 'show_ui' must be true --!
        'show_admin_column'     => true,
        // 'description'           => '',
        'hierarchical'          => true, // "True" for "Category Style", "False" for "Tag Style"
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => ['slug' => $slug, 'with_front' => true],
        'capabilities'          => [
            'manage_terms',
            'edit_terms',
            'delete_terms',
            'assign_terms'
        ],
        'sort'                  => true
    ];

    register_taxonomy($registered_name, $post_type, $args);
});

