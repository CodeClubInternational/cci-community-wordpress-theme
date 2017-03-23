<?php

require get_template_directory() . '/inc/set-up/required-pages-setup.php';
require get_template_directory() . '/inc/set-up/menu-setup.php';


if ( GENERATE_LOG_IN_PAGES ) {
	add_action( 'init','create_log_in_pages' );
	add_filter( 'wp_nav_menu_items', 'add_sign_in_menu_link', 10, 2 );
}

if ( GENERATE_FIND_VENUE_PAGES ) {
	add_action( 'init','create_find_venue_pages' );
}

