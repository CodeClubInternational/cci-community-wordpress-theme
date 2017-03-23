<?php

function create_find_venue_pages() {
	create_find_club_page();
}

function create_log_in_pages() {
	create_account_page();
	create_change_password_page();
	create_download_resources_page();
	create_forgotten_sign_in_details_page();
	create_register_page();
	create_reset_password_page();
	create_sign_in_page();
	create_set_new_password_page();
	create_welcome_page();
}


function create_page( $page ) {
	$exists = get_page_by_title( $page['name'] );

	$template = array(
	'post_type' => 'page',
	'post_status' => 'publish',
	'post_author' => 1,
	);

	if ( ! $exists ) {
		$my_page = array(
		'post_name' => $page['name'],
		'post_title' => $page['title'],
		'page_template' => $page['template'],
		);
		$my_page = array_merge( $my_page, $template );

		$id = wp_insert_post( $my_page );

		if ( isset( $page['child'] ) ) {
			foreach ( $page['child'] as $child ) {
				$child_page = array(
				'post_name' => $child['name'],
				'post_title' => $child['title'],
				  'page_template' => $child['template'],
				  'post_parent' => $id,
				  );
				  $child_page = array_merge( $child_page, $template );
				  wp_insert_post( $child_page );
			}
		}
	}

}


function create_account_page() {
	if ( ! get_page_by_title( 'Account' ) ) {
		$page = array(
		'name' => 'Account',
		'title' => 'Account',
		'template' => 'template-club.php',
		'child' => array(
		array(
		  'name' => 'Account Edit',
		  'title' => 'Account Edit',
		  'template' => 'template-club-edit.php',
		),
		array(
		  'name' => 'Change Password',
		  'title' => 'Change Password',
		  'template' => 'template-change-password.php',
		),
		array(
		  'name' => 'Download Resources',
		  'title' => 'Download Resources',
		  'template' => 'template-download-resources.php',
		),
		),
		);
		create_page( $page );
	}
}


function create_change_password_page() {
	if ( ! get_page_by_title( 'Change Password' ) ) {
		$createPage = array(
		'page_template' => 'template-change-password.php',
		'post_title'    => 'Change Password',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_type'     => 'page',
		'post_name'     => 'Change Password',
		);

		wp_insert_post( $createPage );
	}
}


function create_download_resources_page() {
	if ( defined( RESOURCES_FILE_URL ) && ! get_page_by_title( 'Download Resources' ) ) {
		$createPage = array(
		'page_template' => 'template-download-resources.php',
		'post_title'    => 'Download Resources',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_type'     => 'page',
		'post_name'     => 'Download Resources',
		);

		wp_insert_post( $createPage );
	}
}


function create_find_club_page() {
	if ( ! get_page_by_title( 'Find Venue' ) ) {
		$page = array(
		'name' => 'Find Venue',
		'title' => 'Find Venue',
		'template' => 'template-find-club.php',
		'child' => array(
		array(
		  'name' => 'Contact',
		  'title' => 'Contact',
		  'template' => 'template-contact.php',
		),
		),
		);

		create_page( $page );
	}
}


function create_forgotten_sign_in_details_page() {
	if ( ! get_page_by_title( 'Forgotten Sign In Details' ) ) {
		$createPage = array(
		'page_template' => 'template-forgotten-sign-in-details.php',
		'post_title'    => 'Forgotten Sign In Details',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_type'     => 'page',
		'post_name'     => 'Forgotten Sign In Details',
		);

		wp_insert_post( $createPage );
	}
}


function create_register_page() {
	if ( ! get_page_by_title( 'Register' ) ) {
		$page = array(
		'name' => 'Register',
		'title' => 'Register',
		'template' => 'template-register.php',
		'child' => array(
		array(
		  'name' => 'Register a Club',
		  'title' => 'Register a Club',
		  'template' => 'template-register-a-club.php',
		),
		array(
		  'name' => 'Register a Venue',
		  'title' => 'Register a Venue',
		  'template' => 'template-register-a-venue.php',
		),
		array(
		  'name' => 'Thank you',
		  'title' => 'Thank you',
		  'template' => 'template-thank-you-for-registering.php',
		),
		),
		);

		create_page( $page );
	}
}


function create_reset_password_page() {
	if ( ! get_page_by_title( 'Reset Password' ) ) {
		$page = array(
		'name' => 'Reset Password',
		'title' => 'Reset Password',
		'template' => 'template-reset-password.php',
		);

		create_page( $page );
	}
}


function create_sign_in_page() {
	if ( ! get_page_by_title( 'Sign In' ) ) {
		$page = array(
		'name' => 'Sign In',
		'title' => 'Sign In',
		'template' => 'template-sign-in.php',
		'child' => array(
		  array(
			'name' => 'Forgotten Sign In Details',
			'title' => 'Forgotten Sign In Details',
			'template' => 'template-forgotten-sign-in-details.php',
		  ),
		),
		);
		create_page( $page );
	}
}

function create_set_new_password_page() {
	if ( ! get_page_by_title( 'Set New Password' ) ) {
		$createPage = array(
		'page_template' => 'template-set-new-password.php',
		'post_title'    => 'Set New Password',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_type'     => 'page',
		'post_name'     => 'Set New Password',
		);

		wp_insert_post( $createPage );
	}
}

function create_welcome_page() {
	if ( ! get_page_by_title( 'Welcome' ) ) {
		$createPage = array(
		'page_template' => 'template-welcome.php',
		'post_title'    => 'Welcome',
		'post_status'   => 'publish',
		'post_author'   => 1,
		'post_type'     => 'page',
		'post_name'     => 'Welcome',
		);

		wp_insert_post( $createPage );
	}
}
