<?php

namespace App;


/**
 * Gravity Forms
 */

// Give the options to hide Gravity Forms labels
// add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// Add anchor to form on confirmation or validation
//add_filter( 'gform_confirmation_anchor', '__return_true' );


/**
 * Add <body> classes
 */

add_filter('body_class', function (array $classes) {
    /** Add page slug if it doesn't exist */
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    /** Add class if sidebar is active */
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    /** Clean up class names for custom templates */
    $classes = array_map(function ($class) {
        return preg_replace(['/-blade(-php)?$/', '/^page-template-views/'], '', $class);
    }, $classes);

    return array_filter($classes);
});


/**
 * Add "… Continued" to the excerpt
 */

add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
});


/**
 * Template Hierarchy should search for .blade.php files
 */

collect([
    'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date', 'home',
    'frontpage', 'page', 'paged', 'search', 'single', 'singular', 'attachment'
])->map(function ($type) {
    add_filter("{$type}_template_hierarchy", __NAMESPACE__.'\\filter_templates');
});


/**
 * Render page using Blade
 */
add_filter('template_include', function ($template) {
    $data = collect(get_body_class())->reduce(function ($data, $class) use ($template) {
        return apply_filters("sage/template/{$class}/data", $data, $template);
    }, []);
    if ($template) {
        echo template($template, $data);
        return get_stylesheet_directory().'/index.php';
    }
    return $template;
}, PHP_INT_MAX);


/**
 * Render comments.blade.php
 */

add_filter('comments_template', function ($comments_template) {
    $comments_template = str_replace(
        [get_stylesheet_directory(), get_template_directory()],
        '',
        $comments_template
    );

    $data = collect(get_body_class())->reduce(function ($data, $class) use ($comments_template) {
        return apply_filters("sage/template/{$class}/data", $data, $comments_template);
    }, []);

    $theme_template = locate_template(["views/{$comments_template}", $comments_template]);

    if ($theme_template) {
        echo template($theme_template, $data);
        return get_stylesheet_directory().'/index.php';
    }

    return $comments_template;
}, 100);


/**
 * Render WordPress searchform using Blade
 */

add_filter('get_search_form', function () {
    return template('partials.searchform');
});


/**
 * ACF JSON Save Point
 */

add_filter('acf/settings/save_json', function ($path) {
	$path = get_theme_root() . '/spark/app/theme/acf-json';

	return $path;
});


/**
 * ACF JSON Load Point
 */

add_filter('acf/settings/load_json', function ($paths) {
	unset($paths[0]);
	$paths[] = get_theme_root() . '/spark/app/theme/acf-json';

	return $paths;
});


/**
 * Allow SVG's to be uploaded in the WYSIWYG.
 */

add_filter('upload_mimes', function ($mimes) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
});


/**
 * Add Responsive Embed container around embeds
 */

add_filter('embed_oembed_html', function ($html, $url, $attr, $post_id) {
	return '<div class="responsive-embed widescreen">' . $html . '</div>';
}, 99, 4);


/**
 * Prevent FontAwesome plugin from double loading
 * the library on the front-end of the website
 */

if (!is_admin()) {
	add_filter('ACFFA_get_fa_url', function ($url) {
		$url = '';

		return $url;
	});
}


/**
 * Sober\Controller namespace declaration
 */

add_filter('sober/controller/namespace', function () {
	return 'App\controllers';
});


/**
 * Disable Guttenberg
 */

add_filter('use_block_editor_for_post', '__return_false', 10);
add_filter('use_block_editor_for_post_type', '__return_false', 10);
