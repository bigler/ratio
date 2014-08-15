<?php

	////////////////////
	// Your website where the secure pages exist?
	// Set this to wherever activate.php exists at

	define("SITE_PATH", "http://localhost/ratio/");

	////////////////////
	// Enter the email address that you want to emails to be sent from.
	// Example $address = "joe.doe@yourdomain.com";

	$address = "ok.sulde@gmail.com";

	////////////////////
	// Important ! These must be filled in correctly.
	// Database details are required to use this script.

	$host = "localhost"; // If you don't know what your host is, it's safe to leave it localhost
	$dbName = "ratio"; // Database name
	$dbUser = "root"; // Username
	$dbPass = ""; // Password

	////////////////////
	// How long would you like users to remain logged in?
	// 0 means logout on browser close

	$minutes = 1;

	?>