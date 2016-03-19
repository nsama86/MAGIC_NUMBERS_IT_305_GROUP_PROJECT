<?php
if (!isset($_COOKIE['first_name']))
{
	// Need the functions:
	require('./inc/login_functions.inc.php');
	redirect_user();
}
require_once('./inc/header.php'); ?>

<section id="content">
	<!-- Page Heading -->
	<section class="section page-heading animate-onscroll">
		<button class="logout"><a href="./logout.php">Log Out</a></button>
		<h1 align="left">Volunteer Applicant</h1>
	</section>
	<!-- Page Heading -->

	<section class="section full-width-bg gray-bg">
		<div class="row">
			<button class="admin"><a href="volunteers.php">Back to Volunteers</a></button><br><br>
			<div class="col-lg-9 col-md-9 col-sm-8">
    <!-- start of php table -->
<?php

$id = $_GET['id'];

$query = "SELECT app_date, name, email, phone, availability, why, app_type, work_type, crime, lift FROM magicnum_kfb.volunteer WHERE id = $id";

//Send the query to the database
$rows = mysqli_query($connection, $query);

while($row = mysqli_fetch_array($rows))
{

echo '<table align="center" width="647" border="1">';

 echo '<tbody>';
  echo '<tr>';
      echo '<th width="347" scope="row">Application Date:</th>';
	  $phpdate = strtotime($row['app_date']);
      echo '<td width="869">'.date('m-d-Y', $phpdate).'</td>';
    echo '</tr>';
    echo '<tr>';
      echo '<th scope="row">Name:</th>';
      echo '<td>'. $row['name'] .'</td>';
    echo '</tr>';
    echo '<tr>';
      echo '<th scope="row">Email:</th>';
      echo '<td>'. $row['email'] .'</td>';
    echo '</tr>';
    echo '<tr>';
	$phone = $row['phone'];
      echo '<th scope="row">Phone:</th>';
      echo '<td>('.substr($phone, 0, 3).')-'.substr($phone, 3, 3)."-".substr($phone,6).'</td>';
    echo '</tr>';
    echo '<tr>';
      echo '<th height="68" scope="row">Availability:</th>';
      echo '<td>'.$row['availability'].'</td>';
    echo '</tr>';
    echo '<tr>';
      echo '<th scope="row">Why do you want to volunteer for KFB?</th>';
      echo '<td>'.$row['why'].'</td>';
    echo '</tr>';
    echo '<tr>';
      echo '<th scope="row">Application Type:</th>';
		$app_type = $row['app_type'];
      echo '<td>'. $row['app_type'] .'</td>';
    echo '</tr>';
    echo '<tr>';
      echo '<th scope="row">Preferred Work:</th>';
      echo '<td>'. $row['work_type'] .'</td>';
    echo '</tr>';
    echo '<tr class="court-ordered">';
      echo '<th scope="row">Committed a Crime?</th>';
      echo '<td>'. $row['crime'] .'</td>';
    echo '</tr>';
    echo '<tr class="court-ordered">';
      echo '<th scope="row">Can lift 40lbs or more?</th>';
      echo '<td>'. $row['lift'] .'</td>';
    echo '</tr>';
  echo '</tbody>';
echo '</table>';

			   }//end of while loop

 ?> <!-- End of php for table display-->

</div>
</div>
</section>
</section>

<script type="text/javascript">
var app_type = "<?php echo $app_type; ?>";
if(app_type == 'court-ordered') {
	$(".court-ordered").removeClass("hidden");
} else {
	$(".court-ordered").addClass("hidden");
}
</script>

<!-- Add footer to page -->
<?php require_once('./inc/footer.php'); ?>
