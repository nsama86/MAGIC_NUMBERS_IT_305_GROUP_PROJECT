<?php
	// This page lets a user logout

	//If no cookie is present, redirect the user:
	if(!isset($_COOKIE['first_name']))
	{
		header('Location: index.php');
	}
	else //Delete the cookies
	{
		setcookie('first_name', '', time()-3600, '/', '', 0, 0);
	}

	header('Location: index.php');

?>
