<?php

/**
 * Laravel Mix Manifest tracker
 *
 * @param  string $asset Path to the Mix'd asset
 *
 * @return string        Path to the asset file
 */

function mix($asset)
{
	$manifest = App\config('theme.dir') . '/public/mix-manifest.json';

	if (file_exists($manifest)) {
		$asset_paths = json_decode(file_get_contents($manifest));
		$asset = $asset_paths->{$asset};
	}

	return ltrim($asset, '/');
}


/**
 * Add a class to the <main> element of the current page slug
 *
 * @return string CSS Class
 */

function main_class()
{
	$query = get_queried_object();
	$page_class = 'default';


	if (is_archive()) {
		if (is_category()) {
			$page_class = $query->taxonomy . ' ' . $query->slug;
		} elseif (is_tax()) {
			$page_class = str_replace('_', '-', $query->taxonomy);
		} elseif (is_date()) {
			$page_class = 'date';
		} else {
			$page_class = str_replace('/', '-', $query->rewrite['slug']);
		}
	} elseif (is_single()) {
		$post_type_slug = str_replace('_', '-', $query->post_type);
		$page_class = $post_type_slug . '-single';
	} elseif (is_page()) {
		$template_path = str_replace('.blade.php', '', get_page_template_slug($post->ID));
		$page_class = str_replace('views/page-', '', $template_path);
		if (!$page_class) {
			$page_class = 'default';
		}
	} elseif (is_404()) {
		$page_class = 'four-oh-four';
	} elseif (is_home()) {
		$page_class = 'blog';
	}

	return $page_class;
}


/**
 * Generate a URL to the theme images folder
 *
 * @param string $img Image name and extension e.g. icon.png
 *
 * @return string Image URL
 */

function the_img($img)
{
	return App\asset_path("img/{$img}");
}


/**
 * Add ACF Options page
 */

if (function_exists('acf_add_options_page')) {
	acf_add_options_page([
	  'menu_title' => 'Global Content',
	  'menu_slug'  => 'global-content',
	  'capability' => 'edit_posts',
	  'redirect'   => true,
	  'icon_url'   => 'dashicons-admin-site',
	]);

	acf_add_options_sub_page([
	  'page_title'  => 'Site General Settings',
	  'menu_title'  => 'General',
	  'parent_slug' => 'global-content',
	]);

	acf_add_options_sub_page([
	  'page_title'  => 'Site Header Settings',
	  'menu_title'  => 'Header',
	  'parent_slug' => 'global-content',
	]);

	acf_add_options_sub_page([
	  'page_title'  => 'Site Footer Settings',
	  'menu_title'  => 'Footer',
	  'parent_slug' => 'global-content',
	]);

	acf_add_options_sub_page([
	  'page_title'  => 'Site Analytics Settings',
	  'menu_title'  => 'Analytics',
	  'parent_slug' => 'global-content',
	]);
}


/**
 * Custom excerpt by character length
 */

//function get_excerpt($count){
//    $excerpt = get_the_content();
//    $excerpt = strip_tags($excerpt);
//    $excerpt = substr($excerpt, 0, $count);
//    $excerpt = $excerpt.'...';
//    return $excerpt;
//}

// Breadcrumbs
function custom_breadcrumbs() {
    
    // Settings
    $separator          = '';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'uk-breadcrumb';
    $home_title         = 'Home';
    
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = 'product_cat';
    
    // Get the query & post information
    global $post,$wp_query;
    
    // Do not display on the homepage
//    if ( !is_front_page() ) {
        
        // Build the breadcrums
        echo '<ul  class="' . $breadcrums_class . '">';
        if ( !is_front_page() ) {
            // Home page
            echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
    //        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
        }
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
            
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . post_type_archive_title($prefix, false) . '</strong></li>';
            
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
            
            // If post is a custom post type
            $post_type = get_post_type();
            
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';

            
            }
            
            
            
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
            
        } else if ( is_single() ) {
            
            // If post is a custom post type
            $post_type = get_post_type();
            
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
                
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
//                echo '<li class="separator"> ' . $separator . ' </li>';
            
            
            }
            
            // Get post category info
            $category = get_the_category();
            
            if(!empty($category)) {
                
                // Get last category post is in
                $last_category = end(array_values($category));
                
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
//                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
                
            }
            
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
                
            }
            
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo $cat_display;
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                
                // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
//                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                
            } else {
                
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                
            }
            
        } else if ( is_category() ) {
            
            // Category page
            echo '<li class="item-current item-cat"><strong class="bread-current bread-cat">' . single_cat_title('', false) . '</strong></li>';
            
        } else if ( is_page() ) {
            
            // Standard page
            if( $post->post_parent ){
                
                // If child page, get parents
                $anc = get_post_ancestors( $post->ID );
                
                // Get parents in the right order
                $anc = array_reverse($anc);
                
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
//                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                
                // Display parent pages
                echo $parents;
                
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                
            } else {
                
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                
            }
            
        } else if ( is_tag() ) {
            
            // Tag page
            
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
            
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><strong class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</strong></li>';
            
        } elseif ( is_day() ) {
            
            // Day archive
            
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
//            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
            
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</a></li>';
//            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
            
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . ' Archives</strong></li>';
            
        } else if ( is_month() ) {
            
            // Month Archive
            
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</a></li>';
//            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
            
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . ' Archives</strong></li>';
            
        } else if ( is_year() ) {
            
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . ' Archives</strong></li>';
            
        } else if ( is_author() ) {
            
            // Auhor archive
            
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
            
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . 'Author: ' . $userdata->display_name . '</strong></li>';
            
        } else if ( get_query_var('paged') ) {
            
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="Page ' . get_query_var('paged') . '">'.__('Page') . ' ' . get_query_var('paged') . '</strong></li>';
            
        } else if ( is_search() ) {
            
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="Search results for: ' . get_search_query() . '">Search results for: ' . get_search_query() . '</strong></li>';
            
        } elseif ( is_404() ) {
            
            // 404 page
            echo '<li>' . 'Error 404' . '</li>';
        }
        
        echo '</ul>';
       
    
}





function ft_post_link( $post_link, $id = 0 ){
    $post = get_post($id);
    if ( is_object( $post ) ){
        $terms = wp_get_object_terms( $post->ID, 'topic' );
        if( $terms ){
            return str_replace( '%topic%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;
}

add_filter( 'post_type_link', 'ft_post_link', 1, 3 );
//

function ft_term_link( $post_link, $id = 0 ){
    $post = get_term($id);
    return str_replace( 'topic/' , '' , $post_link );

//    return $post_link;
}

//add_filter( 'term_link', 'ft_term_link', 1, 3 );

//
//function wpb_change_search_url() {
//    if ( is_search() && ! empty( $_GET['s'] ) ) {
//        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
//        exit();
//    }
//}
//add_action( 'template_redirect', 'wpb_change_search_url' );
