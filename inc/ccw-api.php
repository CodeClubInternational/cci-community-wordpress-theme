<?php
/**
 * CCW API Class & Functions
 * Constants are set in `country-config.php`
 */
class CCW_API {

	/**
	 * @param string  $state The state of the clubs (eg. active, pending, suspended). Defaults to 'active'
	 * @param integer $per_page Number of clubs per page. Defaults to 50
	 * @param integer $page Page number. Defaults to 1
	 * @return array $response Containing 'headers' & 'body' arrays
	 */
	public function getClubs( $state = 'active', $per_page = 50, $page = 1 ) {
		$url = CCW_API_URL . '/clubs?state=' . strtolower( $state ) . '&in_country=' . strtolower( CCW_API_COUNTRY_CODE ) . '&per_page=' . $per_page . '&page=' . $page;
		$headers = [
			'AUTHORIZATION' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
			'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];

		$response = wp_remote_get( $url,
			array(
				'timeout' => 30,
				'headers' => $headers,
			)
		);
		return $response;
	}

	/**
	 * @param integer $id The ID of the club
	 * @return array $response Containing 'headers' & 'body' arrays
	 */
	public function getClub( $id ) {
		$url = CCW_API_URL . '/clubs/' . $id;
		$headers = [
			'AUTHORIZATION' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
			'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];

		$response = wp_remote_get( $url,
			array(
				'timeout' => 30,
				'headers' => $headers,
			)
		);
		return $response;
	}

	/**
	 * @param json $club_json Club data (inc. venue, address, contact) in a JSON encoded array
	 * @return array $response Containing 'headers', 'body' & 'response' arrays
	 */
	public function createClub( $club_json ) {
		$response = wp_remote_post( CCW_API_URL . '/clubs?welcome_email=' . CCW_API_WELCOME_EMAIL,
			array(
				'timeout' => 30,
				'headers' => array(
					'Content-Type'  => 'application/json',
					'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
					'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
				),
				'body' => $club_json,
			)
		);
		return $response;
	}


	/**
	 * @param float   $latitude location's latitude
	 * @param float   $longitude location's longitude
	 * @param integer $radius radius to look up code clubs within
	 * @return array $response Containing 'headers' & 'body' arrays
	 */
	public function getNearbyCodeClubsLookingForVolunteer( $latitude, $longitude, $radius ) {
		$url = CCW_API_URL . '/clubs/near?' . 'looking_for_volunteer=true' .
			 '&radius=' . $radius . '&latitude=' . $latitude . '&longitude=' . $longitude;
		$headers = [
		'AUTHORIZATION' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];
		$response = wp_remote_get($url,
			array(
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;
	}


	/**
	 * @param float   $latitude location's latitude
	 * @param float   $longitude location's longitude
	 * @param integer $radius radius to look up code clubs within
	 * @return array $response Containing 'headers' & 'body' arrays
	 */
	public function getNearbyCodeClubs( $latitude, $longitude, $radius ) {
		$url = CCW_API_URL . '/clubs/near?' .
		'&radius=' . $radius . '&latitude=' . $latitude . '&longitude=' . $longitude;
		$headers = [
		'AUTHORIZATION' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];
		$response = wp_remote_get($url,
			array(
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;
	}


	/**
	 * @param json $club_json Club data (inc venue, address, contact) in a JSON encoded array
	 * @return returns the updated club within the body and status code 200
	 */
	public function updateClub( $club_json ) {
		$response = wp_remote_request(CCW_API_URL . '/authenticated_clubs/club?=',
			array(
			'method'  => 'PUT',
			'timeout' => 30,
			'headers' => array(
			'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
			'Content-Type'  => 'application/json',
			'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
			),
			'body' => $club_json,
			)
		);
		return $response;
	}


	/**
	 * @param email address
	 * @return status code 204
	 */
	public function forgotSignInDetails( $email_address ) {
		$url = CCW_API_URL . '/authenticated_clubs/password?' . 'email=' . $email_address;
		$headers = [
		'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];
		$response = wp_remote_post($url,
			array(
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;
	}

	/**
	 * @param auth_token as a json encoded object
	 * @return status code 204
	 */
	public function checkFirstPasswordToken( $auth_token ) {
		$url = CCW_API_URL . '/authenticated_clubs/password/first_password_token_validation?' . 'auth_token=' . $auth_token;
		$headers = [
		'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];

		$response = wp_remote_get($url,
			array(
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;
	}


	/**
	 * @param reset_password_token as a json encoded object
	 * @return status code 204
	 */
	public function checkResetPasswordToken( $reset_password_token ) {
		$url = CCW_API_URL . '/authenticated_clubs/password?' . 'reset_password_token=' . $reset_password_token;
		$headers = [
		'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];

		$response = wp_remote_get($url,
			array(
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;
	}

	public function newPassword( $token, $username, $current_password, $password, $password_confirmation ) {
		if ( isset( $username ) ) {
			if ( isset( $current_password ) ) {
				return $this->changePassword( $token, $username, $current_password, $password, $password_confirmation );
			}
			return $this->createFirstPassword( $token, $username, $password, $password_confirmation );
		}

		return $this->setNewPassword( $token, $password, $password_confirmation );

	}


	/**
	 * @param auth_token, current_password, password and password_confirmation
	 * @return status code 200
	 */
	public function changePassword( $auth_token, $username, $current_password, $password, $password_confirmation ) {
		$url = CCW_API_URL . '/authenticated_clubs/password/change?'
		. 'auth_token=' . $auth_token
		. '&username=' . $username
		. '&current_password=' . $current_password
		. '&password=' . $password
		. '&password_confirmation=' . $password_confirmation;
		$headers = [
		'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];
		$response = wp_remote_request($url,
			array(
			'method'  => 'PATCH',
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;
	}

	/**
	 * @param username, password and password_confirmation
	 * @return status code 200
	 */
	public function createFirstPassword( $auth_token, $username, $password, $password_confirmation ) {
		$url = CCW_API_URL . '/authenticated_clubs/password/first_password?'
		. 'auth_token=' . $auth_token
		. '&username=' . $username
		. '&password=' . $password
		. '&password_confirmation=' . $password_confirmation;
		$headers = [
		'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];
		$response = wp_remote_request($url,
			array(
			'method'  => 'PATCH',
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;
	}

	/**
	 * @param password, password_confirmation and reset_password_token
	 * @return status code 200
	 */
	public function setNewPassword( $reset_password_token, $password, $password_confirmation ) {
		$url = CCW_API_URL . '/authenticated_clubs/password?' . 'reset_password_token=' . $reset_password_token . '&password=' . $password . '&password_confirmation=' . $password_confirmation;
		$headers = [
		'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];
		$response = wp_remote_request($url,
			array(
			'method'  => 'PATCH',
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;
	}


	public function signOut( $username ) {
		$url = CCW_API_URL . '/authenticated_clubs/sign_out?' . 'username=' . $username;
		$headers = [
		'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
		'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
		];
		$response = wp_remote_request($url,
			array(
			'method'  => 'DELETE',
			'timeout' => 30,
			'headers' => $headers,
			)
		);
		return $response;

	}

	/**
	 * @param email address and password stored within a json encoded object
	 * @return club details incl name, venue and contact information and status code 200
	 */
	public function signIn( $sign_in_details ) {
		$url = CCW_API_URL . '/authenticated_clubs/sign_in?';
		$response = wp_remote_post($url,
			array(
			'timeout' => 30,
			'headers' => array(
			'Authorization' => 'Bearer ' . CCW_API_READWRITE_TOKEN,
			'Content-Type'  => 'application/json',
			'Accept'        => 'application/vnd.codeclubworld.v' . CCW_API_VERSION,
			),
			'body' => $sign_in_details,
			)
		);
		return $response;
	}
}
