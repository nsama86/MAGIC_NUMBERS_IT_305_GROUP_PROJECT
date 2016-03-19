<?php
// This page processes the login formsubmission.
// Upon successful login, the user is redirected.
// Two included files are necessary.
// Send NOTHING to the Web browser prior to the setcookie( ) lines!

//Check if the form has been submitted:
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	//For processing the login
	require('inc/login_functions.inc.php');

	// Include the db connection
	require('../db.php');

	// Check the login:
	list ($check, $data) = check_login($connection, $_POST['email'], $_POST['pass']);

	if($check) // If their user / pass is good
	{
		// Set the cookies:
		setcookie('user_id', $data['user_id']);
		setcookie('first_name', $data['first_name']);

		//Redirect
		logged_in();
	}
	else //Bad login info
	{
		// Assign $data to $errors for error reporting in the login_page.inc.php file
		$errors = $data;
	}

	mysqli_close($connection); // Close database connection
}

// Create login page
include('inc/login_page.inc.php');

?>
