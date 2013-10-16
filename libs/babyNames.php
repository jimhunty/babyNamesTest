<?php
/* ======================
Author: James Miller
Date Created: 16/10/2013
========================= */
Class babyNames {

	function __construct() {   
    }

	public function getData($startYear, $endYear){
		// Validate the years chosen
		if(($startYear <= $endYear)&&(is_int($startYear))&&(is_int($startYear))){

		// See if there is a json file for these inclusive years, if not then getWebsiteData
		$log = array();
		$jsonFiles = scandir($_SERVER['DOCUMENT_ROOT'].'/cache/');

		// Collate all the names and numbers together into one big array as pass back
		}
    }

	public function getWebsiteData($year){
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
			    		$names[1] = strip_tags($names[1]);
			    		preg_match_all('/^([^\d]+)(\d+)/', $names[1], $match);

						$data[] = array("name" => $match[1][0], "number" => $match[2][0]);
			    	}
				}
		$i++;
		}	
		// Cache the data as a JSON file
		$this->cacheData($year, $data);

		// Return as a 2D array to be used in other functions
		return $data;
	}

	// Function to cache any new data come from the site
	private function cacheData($name, $data){
		// Encode this as JSON
		$data = json_encode($data);

		// Cache the data in the Cache folder with the filename that matches the year
		$cache = $_SERVER['DOCUMENT_ROOT'].'/cache/'.$name.'.json';
		$cachefile = fopen($cache, 'w');
		fwrite($cachefile,$data);
		fclose($cachefile);
	}
}
?>