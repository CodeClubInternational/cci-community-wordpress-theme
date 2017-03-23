<?php

session_start();

function add_sign_in_menu_link( $items, $args ) {
	if ( $args->theme_location == 'primary_navigation' ) {
		$session = new Club_Session();
		if ( $session->sessionExist() ) {
			$items .= '<li class="o-nav__item"><a href="/account" class="o-nav__link">' . __( 'Your Account', 'ccw_countries' ) . '</a></li>';
			$items .= '<li class="o-nav__item"><a href="?sign-out=true" class="o-nav__link">' . __( 'Sign Out', 'ccw_countries' ) . '</a></li>';
		} else {
			$items .= '<li class="o-nav__item"><a href="/sign-in" class="o-nav__link">' . __( 'Sign In', 'ccw_countries' ) . '</a></li>';
		}
	}
	return $items;
}

function sign_out() {
	$session = new Club_Session();
	$session->destroySession();
	wp_safe_redirect( '/sign-in' );
}

if ( $_GET['sign-out'] ) {
	sign_out();
}

