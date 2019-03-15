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




function ft_edit_link( ){
    $id = get_the_ID();
    $post_link = get_edit_post_link($id);
    
    if ( is_archive() || is_tax()){
        $id = get_queried_object()->term_id;
        $post_link = get_edit_term_link($id);
    }
   
    
    return "<a href='$post_link' class='uk-button uk-button-default uk-button-small' target='_blank'>Edit This</a>";
}


//
function ft_archives_orderby( $query ) {
    if ( $query->is_archive() && $query->is_main_query() && !$query->is_admin() ) {
        $query->set( 'orderby', 'title' );
        $query->set( 'order', 'asc' );
    }
}
add_action( 'pre_get_posts', 'ft_archives_orderby' );




//

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
////
//
//function ft_term_link( $post_link, $id = 0 ){
//    $post = get_term($id);
//    return str_replace( 'topic/' , '' , $post_link );
//
////    return $post_link;
//}

//add_filter( 'term_link', 'ft_term_link', 1, 3 );

//
//function wpb_change_search_url() {
//    if ( is_search() && ! empty( $_GET['s'] ) ) {
//        wp_redirect( home_url( "/search/" ) . urlencode( get_query_var( 's' ) ) );
//        exit();
//    }
//}
//add_action( 'template_redirect', 'wpb_change_search_url' );
