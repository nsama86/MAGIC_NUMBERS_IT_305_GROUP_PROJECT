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
		<h1>Sponsors</h1>
	</section>
	<!-- Page Heading -->

	<!-- GRAY Section -->
	<section class="section full-width-bg gray-bg animate-onscroll">
		<div class="row">
			<button class="admin"><a href="admin.php">Back to Admin</a></button><br><br>
			<div class="col-sm-12">

            <table>
               <thead>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Business</th>
						<th>Phone</th>
                  <th>Sponsor Level</th>
               </thead>
               <?php
               //Query the database for all of the volunteers
               $query = "SELECT app_date, name, email, business, phone, sponsor_level FROM magicnum_kfb.sponsors ORDER BY app_date DESC ";

               //Send the query to the database
               $rows = mysqli_query($connection, $query);

               //Loop through each result and display in a row on the table
               while($row = mysqli_fetch_array($rows))
               {
				   $id = $row['id'];
                  echo "<tr>";
                     //Format applied date
                     $phpdate = strtotime($row['app_date']);
                     echo "<td>" . date('m-d-Y', $phpdate) . "</td>";
                     echo "<td>" . $row['name'] . "</td>";
                     echo "<td>" . $row['email'] . "</td>";
							echo "<td>" . $row['business'] . "</td>";
                     //Format phone number and display
                     $phone = $row['phone'];
                     echo "<td>(".substr($phone, 0, 3).") ".substr($phone, 3, 3)."-".substr($phone,6)."</td>";
                     echo "<td>" . $row['sponsor_level'] . "</td>";
                  echo "</tr>";
               }

               //Loop through all of the volunteers and display them in a table

               ?>

            </table>
         </div>
      </div>
   </section>
</section>

<?php
//Add footer to the page
require_once('./inc/footer.php');
