<?php

/**
 * Custom Blade Directives
 */
add_action('after_setup_theme', function () {
    /**
     * Create @repeater() Blade directive
     * @param string $expression The ACF Repeater Field name
     */
    App\sage('blade')->compiler()->directive('repeater', function ($expression) {
        return "<?php if(have_rows($expression)): while(have_rows($expression)): the_row(); ?>";
    });

    /**
     * Create @endrepeater Blade directive
     */
    App\sage('blade')->compiler()->directive('endrepeater', function () {
        return "<?php endwhile; endif; ?>";
    });

    /**
     * Create @flexcontent() Blade directive
     * @param string $expression The ACF Flexible Content Field name
     */
    App\sage('blade')->compiler()->directive('flexcontent', function ($expression) {
        return "<?php if(have_rows($expression)): while(have_rows($expression)): the_row(); ?>";
    });

    /**
     * Create @endflexcontent Blade directive
     */
    App\sage('blade')->compiler()->directive('endflexcontent', function () {
        return "<?php endwhile; endif; ?>";
    });

    /**
     * Create @layout() Blade directive
     * @param string $expression The ACF Layout Field name
     */
    App\sage('blade')->compiler()->directive('layout', function ($expression) {
        return "<?php if(get_row_layout() == {$expression}): ?>";
    });

    /**
     * Create @endlayout Blade directive
     */
    App\sage('blade')->compiler()->directive('endlayout', function () {
        return "<?php endif ?>";
    });

    /**
     * Create @relationship() Blade directive
     * @param string $expression The ACF Relationship Field name
     * @param string $expression May also a boolean to denote a sub_field
     */
    App\sage('blade')->compiler()->directive('relationship', function ($expression) {

        // Split the $expression into an array
        $args = array_map('trim', explode(',', $expression));

        // Check if we need a sub field
        $sub_field = (!is_numeric($args[1])) ? (boolean) json_decode(strtolower($args[1])) : false;

        if ($sub_field) {
            return "<?php global \$post; \$posts = get_sub_field({$expression}); if(\$posts): foreach(\$posts as \$post): setup_postdata(\$post); ?>";
        } else {
            return "<?php global \$post; \$posts = get_field({$expression}); if(\$posts): foreach(\$posts as \$post): setup_postdata(\$post); ?>";
        }
    });

    /**
     * Create @endrelationship Blade directive
     */
    App\sage('blade')->compiler()->directive('endrelationship', function () {
        return "<?php endforeach; wp_reset_postdata(); endif ?>";
    });

    /**
     * Create @loop() Blade directive
     * @param object $wp_query A new \WP_Query instance (optional)
     */
    App\sage('blade')->compiler()->directive('loop', function ($wp_query = null) {
        if ($wp_query) {
            return "<?php if({$wp_query}->have_posts()): while({$wp_query}->have_posts()): {$wp_query}->the_post(); ?>";
        } else {
            return "<?php if(have_posts()): while(have_posts()): the_post(); ?>";
        }
    });

    /**
     * Create @endloop Blade directive
     */
    App\sage('blade')->compiler()->directive('endloop', function () {
        return "<?php endwhile; endif; wp_reset_postdata(); ?>";
    });

    /**
     * Create @query() Blade directive
     * @param array $args A Wordpress query argument array
     */
    App\sage('blade')->compiler()->directive('query', function ($args) {
        return "<?php \$wp_query = null; \$wp_query = new WP_Query({$args}); if(\$wp_query->have_posts()): while(\$wp_query->have_posts()): \$wp_query->the_post(); ?>";
    });

    /**
     * Create @endquery Blade directive
     */
    App\sage('blade')->compiler()->directive('endquery', function () {
        return "<?php endwhile; endif; wp_reset_postdata(); ?>";
    });

    /**
     * Create @set Blade directive
     */
    App\sage('blade')->compiler()->directive('set', function ($expression) {
        return "<?php {$expression}; ?>";
    });


    /**
     * Create @shortcode Blade directive
     */
    App\sage('blade')->compiler()->directive('shortcode', function ($expression) {
        return "<?php echo do_shortcode({$expression}); ?>";
    });
});
