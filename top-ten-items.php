<?php require_once('../db.php'); ?>
<html>

	<head>
		<style>
			@media print {
				button {
					display:none;
				}
			}
		</style>
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<link href="../css/print.css"    rel="stylesheet" media="print">
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon1.png">
	</head>

<body>
<div class="text-center">
	<img alt="Kent Food Bank" src="../img/Kent-Food-Bank.png">
 </div>

	 <div class="panel panel-warning">
<!-- Top Ten Items needed at Food Bank now -->
	<div class="panel-heading">Top Items We Need</div>
	<div class="panel-body">
		
		<?php
			//Define the select query
			$sql = "SELECT * FROM top_ten ORDER BY rank";

			//Send the query to the database
			$result = @mysqli_query($connection, $sql);

			//Process the rows
			while($row = mysqli_fetch_assoc($result))
			{
				echo "<input type='checkbox'>" . $row['item'] . "<br>";
			}
		?>
		
	 </div>
</div>

<div>
   <h3>Bring all items to Kent Food Bank</h3>
   <p>515 W Harrison St, Ste 107 <br />
	   Kent, Washington 98032</p>
   <p>Thank you for your donations and support.</p>
  <p>Donations accepted every Tues, Wed, Thurs and Friday from 9 am to 2 pm</p>
</div>

<button><a href="javascript:window.print('top-ten-items.php')">Print this list</a></button>
</body>
