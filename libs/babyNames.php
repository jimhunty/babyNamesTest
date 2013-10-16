<?php
/* ======================
Author: James Miller
Date Created: 16/10/2013
========================= */
Class babyNames {

	function __construct() {
       
   }

	public static function getWebsiteData($year){
		// Class to select HTML DOM elements
		include("htmldom/simple_html_dom.php");

		// Constants
		$url = 'http://www.socialsecurity.gov/cgi-bin/popularnames.cgi';
		$num = 10;
		$myvars = 'year='.$year.'&top='.$num.'&number=n';

		// Initiate a CURL post
		$ch = curl_init( $url );
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt( $ch, CURLOPT_HEADER, 0);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

		// response is HTML, we now need to extract the data we want.
		$response = curl_exec( $ch );
		// Use the function within the simple HTML DOM Library to find objects
		$html = str_get_html($response);

		// Starting vairables for the process below
		$i = 0;
		$nomore = false;
		$data = array();

		// Find every table row witin the HTML page
		foreach($html->find('tr') as $e){
			$str = $e->innertext;
			
				// As the website is table based, we need to start at the point of the data
			    if($i > 4){
			    	// If statement used as a trigger to stop collecting data
			    	if (strpos($str, 'Rank 1 is the most popular, rank 2 is the next most popular, and so forth') !== false){
						$nomore = true;
					}
					if($nomore == false){
						
						// Tidy data, split it and add it into an array
			    		$names = explode(" ", trim($str));
			    		$names[1] = str_replace(",", "", $names[1]);
			    		preg_match_all('/^([^\d]+)(\d+)/', $names[1], $match);

						$data[] = array($match[1][0], $match[2][0]);
			    	}
				}
		$i++;
		}	
		// Return as a 2D array to be used in other functions
		return $data;
	}
}
?>