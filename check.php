<?php 
 if (!isset($_SESSION)) session_start(); 
 include_once('core/functions/dbconn.php'); 
 include_once('core/functions/functions.php');
 
 function check_login($level) {
     if (isset($_SESSION['username'])){
         // already logged in
         $user_level = $_SESSION['user_level'];
	 $restricted = $_SESSION['restricted'];
	 $disabled = $_SESSION['level_disabled'];
         if (in_array('0',$level)) $user_level=$level;
         if($disabled != 0) { include('disabled.php'); die(); 
         } elseif($restricted != 0) { include('disabled.php'); die();
         } elseif(@array_intersect($level, $user_level)) {
             // user has authority to view this page.
         } else { include('user_level.php'); die();	}
     } else {
         // not logged yet in
         include('login.php'); die();
     }
 }
 ?>