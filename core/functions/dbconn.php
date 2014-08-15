<?php
error_reporting(E_ALL);
require_once 'idiorm.php';

if (file_exists('core/functions/config.php')) {
	// Includes config.php if it exists
        $pp=dirname(__FILE__);
	include($pp.'/config.php');
	$db = dbconn($host,$dbName,$dbUser,$dbPass); // Do not change
       

// #########################################################################

} else { // Looks like config.php is missing, let's inform the user to run install.php
	// Include our headers for prettiness
	?>
	<div class="alert-message error">
	  <p>Installation has not yet been ran!</p>
	</div>
	<h1>Woops!</h1>
	<p>You're missing a config.php file preventing a database connection from being made.</p>
	
	<?php
	
	exit();
}

function dbconn($host,$dbName,$dbUser,$dbPass){
    
        ORM::configure('mysql:host='.$host.';dbname='.$dbName);
        ORM::configure('username', $dbUser);
        ORM::configure('password', $dbPass);   
        ORM::configure('driver_options', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        ORM::configure('return_result_sets', false);
        ORM::configure('caching', false);
	// Connect and select database.
	//$db = mysql_connect($host,$dbUser,$dbPass);
	//$db_select = mysql_select_db($dbName,$db);
	//mysql_query("SET NAMES utf8");
	//return $db;
}
?>