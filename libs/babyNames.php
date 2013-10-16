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

		//if (strlen($ccexpyear) != 4) also 1880 - 2010
		// Initial string validation
		if((strlen($startYear) != 4)||(strlen($endYear) != 4)){
			return "error";
		} else {
			// Check to see of start is greater than end
			$startYear = (int)$startYear;
			$endYear = (int)$endYear;
			if(($startYear > $endYear)||($startYear < 1880)||($startYear > 2010)||($endYear < 1880)||($endYear > 2010)){
				return "error ";
			} else {
				// Otherwise, we have passed validation!

				$total = array();
				$listOfNames = array();

				// Go thorugh each year
				for($i = $startYear; $i < $endYear+1; $i++){
					if (!file_exists($_SERVER['DOCUMENT_ROOT'].'/cache/'.$i.'.json')) {
						// Cache file doesn't exist so we create it.
						$this->getWebsiteData($i);
					} 
					// Add this one to the pile
					$totalAdd = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/cache/'.$i.'.json');
					$totalAdd = json_decode($totalAdd, true);
					foreach($totalAdd as $addition){
						if(in_array($addition['name'], $listOfNames)){
							$totalSize = sizeof($total);
							for($d = 0; $d < $totalSize; $d++){
								if($total[$d]['name'] == $addition['name']){
									$total[$d]['number'] = $total[$d]['number']+$addition['number'];
								}
							}
						} else {
							array_push($total, $addition);
							$listOfNames[] = $addition['name'];
						}
					}

					
				}
				//var_dump($total);

				$total = array("aaData" => $total);
				echo json_encode($total);

				// Now need to concatenate all of the duplicates together
				/*$finalTotal = array();
				$totalSize = sizeof($total);
				for($d = 0; $d < $totalSize; $d++){
					foreach($total[$d] as $key => $value){
						if(){

						}
						echo $key." : ".$value."<br />";
					}

				}*/
			}
		}
		
		/*
		
		$log = array();
		$jsonFiles = scandir($_SERVER['DOCUMENT_ROOT'].'/cache/');

		// Collate all the names and numbers together into one big array as pass back*/
    }

	public function getWebsiteData($year){
		// Class to select HTML DOM elements
		include("htmldom/simple_html_dom.php");

		// Constants
		$url = 'http://www.socialsecurity.gov/cgi-bin/popularnames.cgi';
		$num = 500;
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