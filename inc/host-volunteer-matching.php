<?php
/**
 * Host Volunteer Matching Class
 */
class Host_Volunteer_Matching {

  protected $flash_messages;

  function __construct() {
    if (!isset($_SESSION)) {
      session_start();
    }

    $this->flash_messages = new Flash_Message();
  }
    public function getCoordinates($address) {
	 $url = GOOGLE_MAPS_ADDRESS_END_POINT . preg_replace('/\s+/', '+', $address);

     $response = wp_remote_get($url);

    if (is_wp_error($response)) {
      $this->flash_messages->createError(__("Could not resolve the address", 'ccw_countries'));
	  return $response;
    } else {
      $geocode_data =  json_decode(wp_remote_retrieve_body($response), true);
      $location = $geocode_data['results']['0']['geometry']['location'];
	  return  $location;
	}
  
  }
  public function getCodeClubs($address) {
    $location = $this->getCoordinates ( $address );
    if (is_wp_error ( $location ))
            return;
        $ccw_api = new CCW_API ();
        $ccw_api_response = $ccw_api->getNearbyCodeClubs($location['lat'], $location['lng'], 1);

    if (!is_wp_error($ccw_api_response)) {
        $_SESSION['code_clubs'] = json_decode(wp_remote_retrieve_body($ccw_api_response), true);
    }
     else {
        $this->flash_messages->createError(__("No code clubs found.", 'ccw_countries'));
    }
    $this->flash_messages->display();

    return $_SESSION['code_clubs'];
  }

  public function getCodeClub($id) {
    if (isset($_SESSION['code_clubs'])) {
      foreach ($_SESSION['code_clubs'] as $club) {
        if ($club['id'] == $id) return $club;
      }
    }

    wp_safe_redirect('/');
  }

}

?>
