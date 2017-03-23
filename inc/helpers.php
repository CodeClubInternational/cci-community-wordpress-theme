<?php

function use_if_set( $value, $args = [], $default_value = null, callable $func = null ) {

	foreach ( $args as $arg ) {
		if ( ! isset( $value[ $arg ] ) ) { return $default_value;
		}
		$value = $value[ $arg ];
	}

	if ( isset( $func ) ) { return call_user_func( $func, $value );
	}

	return $value;

}

function produce_errors_message_map( $errors ) {
	$error_messages = array();

	foreach ( $errors as $error ) {
		$error_pointers = explode( '/', $error->source->pointer );
		$error_field = array_pop( $error_pointers );
		$error_messages[ $error_field ] = str_replace( array( '.', '-' ), ' ', ucfirst( $error_field ) ) . ' ' . $error->detail;
	}

	return $error_messages;
}

function strip_slashes_json_encode( $json ) {
	return stripslashes( json_encode( $json ) );
}

function htmlspecialchars_with_quotes( $str ) {
	return htmlspecialchars( $str, ENT_QUOTES );
}


function react_to_response( $response, $success_code, callable $success_function ) {
	$error_messages = array();
	$flash_messages = new Flash_Message();

	if ( ! is_wp_error( $response ) ) {

		$response_code = wp_remote_retrieve_response_code( $response );

		if ( $response_code == $success_code ) {
			call_user_func( $success_function, $response );
		} else {
			$body = json_decode( wp_remote_retrieve_body( $response ) );
			if ( isset( $body->errors ) ) {
				$error_messages = produce_errors_message_map( $body->errors );
			} elseif ( isset( $body->error ) ) {
				$flash_messages->createError( ucfirst( $body->error ) );
				$flash_messages->display();
			} else {
				$flash_messages->createError( __( 'Something went wrong, please try again later.' ) );
				$flash_messages->display();
			}
		}
	} else {
		$flash_messages->createError( $response->get_error_message() );
		$flash_messages->display();
	}

	return $error_messages;

}

function get_yes_no( $value ) {
	if ( $value ) {
		return 'Yes';
	}
	return 'No';
}
