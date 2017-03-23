<?php
/**
 * Theme nav overrides
 */
add_filter( 'nav_menu_css_class', 'primary_nav_li', 1, 3 );
function primary_nav_li( $classes, $item, $args ) {
	switch ( $args->theme_location ) {
		case 'primary_navigation':
			$classes[] = 'o-nav__item';
			break;
		case ( preg_match( '/footer_navigation_.*/', $args->theme_location ) ? true : false ):
			$classes[] = 'o-footer__list-item';
			break;
	}
	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'add_menu_link_classes', 10, 3 );
function add_menu_link_classes( $atts, $item, $args ) {
	switch ( $args->theme_location ) {
		case 'primary_navigation':
			$atts['class'] = 'o-nav__link';
			break;
		case ( preg_match( '/footer_navigation_.*/', $args->theme_location ) ? true : false ):
			$atts['class'] = 'o-footer__list-link';
			break;
	}
	return $atts;
}

add_filter( 'nav_menu_css_class', 'current_nav_class', 10, 2 );
function current_nav_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'is-current ';
	}
	return $classes;
}


add_filter( 'nav_menu_css_class', 'club_navigation_menu_class', 1, 3 );

function club_navigation_menu_class( $classes, $item, $args ) {
	if ( $args->theme_location == 'club_navigation_menu' ) {
		$classes[] = 'o-nav-stacked__item';
	}

	return $classes;
}


add_filter( 'nav_menu_link_attributes', 'add_club_navigation_menu_link_classes', 10, 3 );

function add_club_navigation_menu_link_classes( $atts, $item, $args ) {
	if ( $args->theme_location == 'club_navigation_menu' ) {
		if ( $item->current == 1 ) {
			$atts['class'] = 'o-nav-stacked__link is-current';
		} else {
			$atts['class'] = 'o-nav-stacked__link';
		}
	}

	return $atts;
}

