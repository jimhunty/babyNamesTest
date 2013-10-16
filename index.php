<?php
include("libs/babyNames.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Orange Digital Test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="A web page that can aggregate the top 1000 male names between a given date range of one or more years" />
	<meta name="keywords" content="Male Name Aggregator, Oragnge Digital, James Miller" />
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
</head>
<body>
	<div class="container">
		<h1>Hello, world!</h1>
		<?php 
			$babyNames = new babyNames();

			var_dump($babyNames->getWebsiteData('1984'));
		?>
	</div>
</body>
	<script type="text/javascript" src="assets/css/bootstrap.min.js" />
</html>