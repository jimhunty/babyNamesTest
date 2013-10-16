<?php
/* ==================================================================
Script to liase with the babyNames class and get the data when asked
Author: James Miller
Date Created: 16/10/2013
===================================================================== */

include("libs/babyNames.php");
$startDate = trim($_REQUEST['startDate']);
$endDate = trim($_REQUEST['endDate']);


$babyNames = new babyNames();
echo $babyNames->getData($startDate, $endDate);
?>