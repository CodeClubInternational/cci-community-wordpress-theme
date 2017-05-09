<?php
/**
 * CCW_API_TRANSIENT Class & Functions
 * Constants are set in `country-config.php`
 */

class  CCW_API_TRANSIENT extends CCW_API {
     
    public function getAllClubs(  ) {

    	if ( false === ( $result= get_transient( 'all_clubs_result' ) ) ) {
               $result=parent::getClubs('active',PHP_INT_MAX);

              if (!is_wp_error($result)) 
              {
				 $transient_time= defined('REFRESH_CLUBS_AFTER_MINUTES')?REFRESH_CLUBS_AFTER_MINUTES:60;
				
                 $result=json_decode(wp_remote_retrieve_body($result), true);
		 $idArray=array();
     		foreach ($result as $value) {
			$idArray[$value["id"]]=$value;
		}
		$result=$idArray;
                  set_transient( 'all_clubs_result', $result, $transient_time* MINUTE_IN_SECONDS);
              }
           
        
          }
         return $result;
    }

   

    /**
     * @param integer $id The ID of the club
     * @return array $response Containing 'headers' & 'body' arrays
     */
    public function getClub( $id ) {
	$all_clubs=$this->getAllClubs();
        $club=$all_clubs[$id];
        if(!$club)
            return array();
        $lat=$club['venue']['address']['latitude'];
        $lng=$club['venue']['address']['longitude'];
	
        $ccw_api_response = parent::getNearbyCodeClubs($lat, $lng, 1);

        if (!is_wp_error($ccw_api_response)) {
            $result_clubs = json_decode(wp_remote_retrieve_body($ccw_api_response), true);
            foreach ($result_clubs as $club2) {
                if ($club2['id'] == $id) return $club2;
            }
        }  
            return $club;
        
    }

    /**
     * @param json $club_json Club data (inc. venue, address, contact) in a JSON encoded array
     * @return array $response Containing 'headers', 'body' & 'response' arrays
     */
    public function createClub( $club_json ) {
         delete_transient("all_clubs_result");
         return parent::createClub($club_json);
    }




  
     public  function distanceInMeters($lat1, $lon1, $lat2, $lon2) {
         $theta = $lon1 - $lon2;
         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
         $dist = acos($dist);
         $dist = rad2deg($dist);
         return   $dist * 60 * 1852 ;

     }
  /**
   * @param float $latitude location's latitude
   * @param float $longitude location's longitude
   * @param integer $radius radius to look up code clubs within
   * @return array $response Containing 'headers' & 'body' arrays
   */
    
  public function getNearbyCodeClubsWithinRadius($latitude, $longitude, $radius) {
   $response=$this->getAllClubs();
  
    if (is_wp_error($response)) 
         return $response;
     
     $output=array();
     foreach ($response as $value) {
         $dist=$this->distanceInMeters($latitude, $longitude,$value["venue"]["address"]["latitude"],$value["venue"]["address"]["longitude"] );
         if($dist<$radius)
             $output[]=$value;
     }
    return $output;
  }
  static  function cmp_distances($a, $b) {
        if($a['distance'] > $b['distance']) return 1;
        elseif($a['distance'] < $b['distance']) return -1;
        else return 0;
    }
   /**
   * @param float $latitude location's latitude
   * @param float $longitude location's longitude
   * @param integer $nClubs max number of clubs to get
   * @return array $response Containing 'clubs' arrays
   */
   
  public function getNClosestCodeClubs($latitude, $longitude, $nClubs) {
     $response=$this->getAllClubs();

     if (is_wp_error($response)) 
         return $response;
     foreach ($response as &$value) {
         $dLat=(float)$latitude- (float)$value["venue"]["address"]["latitude"];
         $dLng=(float)$longitude - (float)$value["venue"]["address"]["longitude"];
         $value['distance']=sqrt($dLat*$dLat+$dLng*$dLng);
         
     }
     uasort($response , array('CCW_API_TRANSIENT','cmp_distances'));

     return array_slice($response ,0,$nClubs);
}
/**
 * @param float $latitude location's latitude
 * @param float $longitude location's longitude
 * @param integer $radius radius to look up code clubs within
 * @param integer $nClubs max number of clubs to get
 * @return array $response Containing at least the closest $nClubs and all the clubs with $radius
 */
  public function getBestMatchCodeClubs($latitude, $longitude, $radius, $nClubs) {
     $response=$this->getAllClubs();

     if (is_wp_error($response)||!is_array($response)) 
         return $response;
     foreach ($response as &$value) {
             $value['distance']= $dist=$this->distanceInMeters($latitude, $longitude,$value["venue"]["address"]["latitude"],$value["venue"]["address"]["longitude"] ); 
     }
     uasort($response , array('CCW_API_TRANSIENT','cmp_distances'));
	 $i=0;
	 $output=array();
	 foreach ($response as &$value) {
	     $i++;
		 if($i>$nClubs&&$value['distance']>$radius)
			 break;
		 $output[]=$value;
		
	 }

     return $output;
}

  /**
   * @param json $club_json Club data (inc venue, address, contact) in a JSON encoded array
   * @return returns the updated club within the body and status code 200
   */
  public function updateClub($club_json) {

    delete_transient("all_clubs_result");

    return parent::updateClub($club_json);
  }


}
