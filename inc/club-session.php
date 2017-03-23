<?php

class Club_Session {

	public function sessionExist() {
		return isset( $_SESSION['club'] );
	}

	public function newSession( $club ) {
		session_start();
		$_SESSION['auth_token'] = $club['auth_token'];
		$_SESSION['club'] = $club;
		return true;
	}

	public function destroySession() {
		$username   = $_SESSION['club']['username'];
		$ccw_api    = new CCW_API();
		$response   = $ccw_api->signOut( $username );

		echo wp_remote_retrieve_response_code( $response );

		react_to_response($response, 204, function ( $response ) {
			$flash_message = new Flash_Message();
			$flash_message->createSuccess( __( 'Signed out successfully!', 'ccw_countries' ) );
			wp_safe_redirect( '/sign-in' );
			unset( $_SESSION['auth_token'] );
			unset( $_SESSION['club'] );
		});
	}

	public function redirectIfNoSession() {
		if ( $this->sessionExist() ) { return;
		}

		$flash_messages = new Flash_Message();
		$flash_messages->createError( __( 'You have to be signed in to view this page.', 'ccw_countries' ) );
		wp_safe_redirect( '/sign-in' );
		exit;
	}

}
