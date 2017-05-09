<?php
/**
 * Host Volunteer Matching Class
 */
require_once get_template_directory () . '/inc/ccw-api-transient.php';
class Host_Volunteer_Matching_Transient extends Host_Volunteer_Matching {
    public function getCodeClubsWithinRadius($address, $radius) {
        $location = $this->getCoordinates ( $address );
        if (is_wp_error ( $location ))
            return;
        
        $ccw_api = new CCW_API_TRANSIENT ();
        $ccw_api_response = $ccw_api->getNearbyCodeClubsWithinRadius ( $location ["lat"], $location ["lng"], $radius );
        
        if (! is_wp_error ( $ccw_api_response )) {
            $_SESSION ['code_clubs'] = $ccw_api_response;
        } else {
            $this->flash_messages->createError ( __ ( "No code clubs found.", 'ccw_countries' ) );
        }
        
        $this->flash_messages->display ();
        
        return $_SESSION ['code_clubs'];
    }
    public function getClosestCodeClubs($address, $max) {
        $location = $this->getCoordinates ( $address );
        if (is_wp_error ( $location ))
            return;
        
        $ccw_api = new CCW_API_TRANSIENT ();
        
        $ccw_api_response = $ccw_api->getNClosestCodeClubs ( $location ["lat"], $location ["lng"], $max );
        
        if (! is_wp_error ( $ccw_api_response )) {
            $_SESSION ['code_clubs'] = $ccw_api_response;
        } else {
            $this->flash_messages->createError ( __ ( "No code clubs found.", 'ccw_countries' ) );
        }
        
        $this->flash_messages->display ();
        
        return $_SESSION ['code_clubs'];
    }
    public function getBestMatchCodeClubs($address,$radius=10000, $min=6) {
        $location = $this->getCoordinates ( $address );
        if (is_wp_error ( $location ))
            return;
    
            $ccw_api = new CCW_API_TRANSIENT ();
    
            $ccw_api_response = $ccw_api->getBestMatchCodeClubs ( $location ["lat"], $location ["lng"],$radius, $min );
    
            if (! is_wp_error ( $ccw_api_response )) {
                $_SESSION ['code_clubs'] = $ccw_api_response;
            } else {
                $this->flash_messages->createError ( __ ( "No code clubs found.", 'ccw_countries' ) );
            }
    
            $this->flash_messages->display ();
    
            return $_SESSION ['code_clubs'];
    }
    
    public function getCodeClubs($address, $method = 'STANDARD') {
        $url = GOOGLE_MAPS_ADDRESS_END_POINT . preg_replace ( '/\s+/', '+', $address );
        
        $response = wp_remote_get ( $url );
        
        if (is_wp_error ( $response )) {
            $this->flash_messages->createError ( __ ( "Could not resolve the address", 'ccw_countries' ) );
        } else {
            $geocode_data = json_decode ( wp_remote_retrieve_body ( $response ), true );
            $location = $geocode_data ['results'] ['0'] ['geometry'] ['location'];
            $ccw_api = new CCW_API_TRANSIENT ();
            // $ccw_api_response = $ccw_api->getNearbyCodeClubs($location["lat"],$location["lng"],200000);
            $ccw_api_response = $ccw_api->getNClosestCodeClubs ( $location ["lat"], $location ["lng"], 6 );
            
            if (! is_wp_error ( $ccw_api_response )) {
                $_SESSION ['code_clubs'] = $ccw_api_response;
            } else {
                $this->flash_messages->createError ( __ ( "No code clubs found.", 'ccw_countries' ) );
            }
        }
        
        $this->flash_messages->display ();
        
        return $_SESSION ['code_clubs'];
    }
  public function getCodeClub($id) {
    $ccw_api = new CCW_API_TRANSIENT ();
    $club = $ccw_api->getClub ( $id );
	
    if ($club['id'] == $id) return $club;

    wp_safe_redirect('/');
  }
}

?>
