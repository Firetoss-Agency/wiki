<?php

namespace App;

/**
 * Add Google Maps API key to ACF settings
 */

// add_action('acf/init', function() {
//     acf_update_setting('google_api_key', 'google-maps-api-key-goes-here');
// });


/**
 * Custom posts per page for a custom post type
 */

//add_action('pre_get_posts', function($query) {
//    // Update the custom_post_type argument in the is_post_type_archive() method
//    if (!is_admin() &&
//        $query->is_main_query() &&
//        is_post_type_archive('custom_post_type')) {
//        // Update this value to match the showposts variable from $args in your query
//        $query->set('posts_per_page', 5);
//    }
//});
