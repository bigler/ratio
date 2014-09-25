<?php 
define( 'ABSPATH', dirname(__FILE__) . '/' );

@session_start(); 
require_once('core/functions/dbconn.php');
define('THEMEHOME','themes/'.THEME);
require_once('core/functions/functions.php');
require_once('core/inc/router.php');

if (IS_MULTILANGUAGE===true) {
    require_once('core/inc/localization.php');
}
?>