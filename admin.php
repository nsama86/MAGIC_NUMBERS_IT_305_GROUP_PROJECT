<?php
if (!isset($_COOKIE['first_name']))
{
	// Need the functions:
	require('./inc/login_functions.inc.php');
	redirect_user();
}

// Add header to page
require_once("./inc/header.php"); ?>

<!-- Page Heading -->
<section class="section page-heading animate-onscroll">
	<button class="logout"><a href="./logout.php">Log Out</a></button>
	<h1>Administration</h1>
</section>

<!-- Page Heading -->

	<section class="section full-width-bg gray-bg animate-onscroll">
		<div class="row">
			<div class="col-sm-12">

				<h3>Site Settings</h3>
				<button class="admin"><a href='edit-top-ten.php'>Edit Top Ten List</a></button><br>

				<h3>Submitted Form Tables</h3>
				<button class="admin"><a href='volunteers.php'>Volunteers Table</a></button><br><br>
				<button class="admin"><a href='sponsors.php'>Sponsors Table</a></button>
			</div>
		</div>
	</section>
</section>

<!-- Add footer to page -->
<?php require_once("./inc/footer.php"); ?>
