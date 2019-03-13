<?php

/**
 * Navbar Menu Walker for UIkit
 */

class UIkitNavigation extends Walker_Nav_Menu
{
	public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
	{
		$element->has_children = !empty($children_elements[$element->ID]);
		if (!empty($element->classes)) {
			$element->classes[] = ($element->current || $element->current_item_ancestor) ? 'is-active' : '';
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

	public function start_lvl(&$output, $depth = 0, $args = [])
	{
		// Top level dropdowns
		if ($depth == 0) {
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<div class=\"uk-dropdown\" uk-dropdown>\n$indent<ul class=\"uk-nav uk-dropdown-nav\">\n";
		} else {
			// dropdowns in dropdowns
			$indent = str_repeat("\t", $depth);
			$output .= "\n$indent<div class=\"uk-dropdown\" uk-dropdown='pos:left-top'>\n$indent<ul class=\"uk-nav uk-dropdown-nav\">\n";
		}
	}

	public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		$item_output = '';
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		/**
		 * Uncomment to add dividers to each menu item
		 */

		// $output .= ( $depth == 0 ) ? '<li class="uk-nav-divider"></li>' : '';

		$class_names = $value = '';
		$classes = empty($item->classes) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class="' . esc_attr($class_names) . '"';
		$output .= $indent . '<li id="menu-item-' . $item->ID . '" ' . $class_names . '>';
		if (empty($item->title) && empty($item->url)) {
			$item->url = get_permalink($item->ID);
			$item->title = $item->post_title;
			$attributes = $this->attributes($item);
			$item_output .= '<a' . $attributes . '>';
			$item_output .= apply_filters('the_title', $item->title, $item->ID);
			$item_output .= '</a>';
		} else {
			$attributes = $this->attributes($item);
			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;
		}

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
	}

	private function attributes($item)
	{
		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

		return $attributes;
	}

	public static function items_default_wrap($menu_text)
	{
		/**
		 * Set default menu for menus not yet linked to theme location
		 * Method courtesy of robertomatute - https://github.com/roots/roots/issues/939
		 */
		return str_replace('<ul>', '<ul class="right">', $menu_text);
	}

	public static function items_remove_defaut_wrapper()
	{
		return true;
	}
}

add_filter('wp_page_menu', ['UIkitNavigation', 'items_default_wrap']);
add_action('wp_head', ['UIkitNavigation', 'items_remove_defaut_wrapper']);

class UIkitMobileNavigation extends Walker_Nav_Menu
{
	public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
	{
		$element->has_children = !empty($children_elements[$element->ID]);
		if (!empty($element->classes)) {
			$element->classes[] = ($element->current || $element->current_item_ancestor) ? 'is-active' : '';
		}

		parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

	public function start_lvl(&$output, $depth = 0, $args = [])
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"uk-nav-sub\">\n";
	}

	public function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
	{
		$item_output = '';
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		/**
		 * Uncomment to add dividers to each menu item
		 */

		// $output .= ( $depth == 0 ) ? '<li class="uk-nav-divider"></li>' : '';

		$class_names = $value = '';
		$classes = empty($item->classes) ? [] : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		if (empty($item->has_children)) {
			$class_names = ' class="' . esc_attr($class_names) . '"';
		} else {
			$class_names = ' class="uk-parent ' . esc_attr($class_names) . '"';
		}
		$output .= $indent . '<li id="menu-item-' . $item->ID . '" ' . $class_names . '>';

		if (empty($item->title) && empty($item->url)) {
			$item->url = get_permalink($item->ID);
			$item->title = $item->post_title;
			$attributes = $this->attributes($item);
			$item_output .= '<a' . $attributes . '>';
			$item_output .= apply_filters('the_title', $item->title, $item->ID);
			$item_output .= '</a>';
		} else {
			// No subnav
			if (empty($item->has_children)) {
				$attributes = $this->attributes($item);
				$item_output = $args->before;
				$item_output .= '<span><a' . $attributes . '>';
				$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
				$item_output .= '</a></span>';
				$item_output .= $args->after;
			} else {
				// Has subnav
				if ($item->url == '#') {
					$attributes = $this->attributes($item);
					$item_output = $args->before;
					$item_output .= '<a class="no-link"' . $attributes . '>';
					$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
					$item_output .= '</a>';
					$item_output .= $args->after;
				} else {
					$attributes = $this->attributes($item);
					$item_output = $args->before;
					$item_output .= '<span><a' . $attributes . '>';
					$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
					$item_output .= '</a></span><a class="indicator"></a>';
					$item_output .= $args->after;
				}
			}
		}

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
	}

	private function attributes($item)
	{
		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

		return $attributes;
	}

	public static function items_default_wrap($menu_text)
	{
		/**
		 * Set default menu for menus not yet linked to theme location
		 * Method courtesy of robertomatute - https://github.com/roots/roots/issues/939
		 */
		return str_replace('<ul>', '<ul class="right">', $menu_text);
	}

	public static function items_remove_defaut_wrapper()
	{
		return true;
	}
}
