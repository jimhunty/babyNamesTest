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
	<link rel="stylesheet" type="text/css" href="assets/css/datepicker.css" />
</head>
<body>
	<div class="container">
			<h1 class="text-center">Baby Name Aggregation System</h1>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="well">
  					<form class="form-inline" role="form">
					  <div class="form-group">
					    <label class="sr-only" for="startDate">Start Date</label>
					    <input type="text" class="form-control" id="startDate" placeholder="Start Date : YYYY">
					  </div>
					  <div class="form-group">
					    <label class="sr-only" for="endDate">End Date</label>
					    <input type="text" class="form-control" id="endDate" placeholder="End Date : YYYY">
					  </div>
					  <button type="submit" class="btn btn-primary">Get those names!</button>
					</form>
  				</div>
			</div>
		</div>
		<div class="row">
  			<div class=".col-md-4 .col-md-offset-1">
  				<div class="well">
  					
  				</div>
  			</div>
  		</div>
		<?php 
			/*$babyNames = new babyNames();
			$babyNames->getWebsiteData('1984');*/
		?>
	</div>
</body>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js" /></script>
	<script type="text/javascript" src="assets/js/bootstrap-datepicker.js" /></script>
	<script type="text/javascript">
		$( document ).ready(function() {
			$("#startDate, #endDate").datepicker({
			    format: " yyyy",
			    viewMode: "years", 
			    minViewMode: "years",
			    startDate: "1880",
			    endDate: "2010"
			});
		});
	</script>
</html>