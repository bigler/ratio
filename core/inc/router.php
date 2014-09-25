<?php 
function get_default_page_id() {
    return 1;
}
function get_page_styles($css) {
    if (is_array($css)) {
        foreach ($css as $fl){
            echo '<link href="'.$fl.'" rel="stylesheet" type="text/css"/>'."\r\n";
        }
    }                       
}
function get_page_scripts($scripts) {
    if (is_array($scripts)) {
        foreach ($scripts as $sc){
            echo '<script src="'.$sc.'" type="text/javascript"/></script>'."\r\n";
        }
       
    }      
}
function get_current_page_script($file) {
     $path=ABSPATH.THEMEHOME.'/pages/scripts/'.$file.'.js.php';
     if (isset($path)) {
         echo '<!-- START PAGE SPECIFIC SCRIPTS -->'."\r\n";
         echo '<script>'."\r\n "; 
         echo '$(document).ready(function() {'."\r\n ";   
         include($path);
         echo '});'."\r\n "; 
         echo '</script>'."\r\n "; 
         echo '<!-- END PAGE SPECIFIC SCRIPTS -->';
     }
}
function get_header($css=false) {
    include(ABSPATH.'header.php');
}
function get_footer($scripts=false){
    include(ABSPATH.'footer.php');    
}
function check_access_rights($levels) {
    $larray=explode(',',$levels);
    
    if (isset($_SESSION['username'])){
        // user already logged in
         $user_level = $_SESSION['user_level'];
	 $restricted = $_SESSION['restricted'];
	 $disabled = $_SESSION['level_disabled'];
         //@array_intersect($level, $user_level);
    } else {
        // not logged in
          include(ABSPATH.'login.php'); die();
    }
}
function route_page() {
    $page=_safer('page','int',0);
    if ($page==0) $page=get_default_page_id();
    $cr_page = ORM::for_table('pages')->where('id', $page)->find_one();
    if ($cr_page) {
        if ( file_exists( ABSPATH . $cr_page->url) ) {
            // check access rights
            check_access_rights($cr_page->level_access);
           //print_r($cr_page->url);
        } 
    }
}
?>