<?php
/* ======================
Author: James Miller
Date Created: 16/10/2013
========================= */
function getBabyNames($year, $num){
	// Class to select HTML DOM elements
	include("htmldom/simple_html_dom.php");
	$url = 'http://www.socialsecurity.gov/cgi-bin/popularnames.cgi';
	$myvars = 'year='.$year.'&top='.$num;

	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_POST, 1);
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt( $ch, CURLOPT_HEADER, 0);
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

	$response = curl_exec( $ch );
	$html = str_get_html($response);

	$i = 0;
	$nomore = false;
	$data = array();

	foreach($html->find('tr') as $e){
		$str = $e->innertext;
		
		    if($i > 4){
		    	if (strpos($str, 'Rank 1 is the most popular, rank 2 is the next most popular, and so forth') !== false){
					$nomore = true;
				}
				if($nomore == false){
		    		$data[] = explode(" ", trim($str));
		    	}
			}
	$i++;
	}	
	return $data;
}
?>