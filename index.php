<?php
include("libs/babyNames.php");
$startDate = $_REQUEST['startDate'];
$endDate = $_REQUEST['endDate'];

echo $startDate." - ".$endDate;

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
	<link rel="stylesheet" type="text/css" href="assets/css/datatables.css" />
</head>
<body>
	<div class="container">
			<h1 class="text-center">Baby Name Aggregation System</h1>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="well">
  					<form class="form-inline" role="form" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
					  <div class="form-group">
					    <label class="sr-only" for="startDate">Start Date</label>
					    <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Start Date : YYYY" value="<?php echo $startDate; ?>">
					  </div>
					  <div class="form-group">
					    <label class="sr-only" for="endDate">End Date</label>
					    <input type="text" class="form-control" id="endDate" name="endDate" placeholder="End Date : YYYY" value="<?php echo $endDate; ?>">
					  </div>
					  <button type="submit" class="btn btn-primary">Get those names!</button>
					</form>
  				</div>
			</div>
		</div>
		<div class="row">
  			<div class="col-md-8 col-md-offset-2">
  				<div class="well">
  					<table id="myTickets" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
					     <thead>
					          <!--<th>Rank</th>-->
					          <th>Name</th>
					          <th>Total</th>
					     </thead>
					     <tbody>
					     	<?php

					     	?>
					     </tbody>
					</table>
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
	<script type="text/javascript" language="javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="assets/js/datatables.js" /></script>
	<script type="text/javascript">
		$( document ).ready(function() {

			$('#myTickets').dataTable({
				"bStateSave": true,
				"aaSorting": [[ 1, "desc" ]],
				"bProcessing": true,
        		"sAjaxSource": "cache/1984.json",
		          "aoColumns": [
		            //{"mData": "rank"},
		            {"mData": "name"},
		            {"mData": "number"}
		          ],
		          "fnPreDrawCallback": function(oSettings, json) {
		                 $('.dataTables_filter input').addClass('form-control input-sm');
		                 $('.dataTables_filter input').css('width', '200px');
		                 $('.dataTables_length select').addClass('form-control input-sm');
		                 $('.dataTables_length select').css('width', '75px');
		          }
		     });

			$("#startDate, #endDate").datepicker({
			    format: " yyyy",
			    viewMode: "years", 
			    minViewMode: "years",
			    startDate: "1880",
			    endDate: "2010"
			});

			//$('button').prop('disabled', true);
		});
	</script>
</html>