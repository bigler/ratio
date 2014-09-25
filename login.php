<?php 
if (!defined('RATIO_1.0')) { header('Location:'.'is404.php');die(); }
$display_hide='display-hide'; // class that hide alert div by default
print_r($_SESSION);

$ref=SITE_PATH;

// Check if user already logged in. If TRUE - redirect this dumbass to previous page
if(isset($_SERVER['HTTP_REFERER'])) $ref = $_SERVER['HTTP_REFERER'];
if(isset($_SESSION['username'])) {  header("Location: ".$ref); die(); }

// Only process if the login form has been submitted.
if(isset($_POST['login'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
        
	if (!isset($username) || !isset($password)) {
		header( "Location: index.php" ); exit();
	} elseif (empty($username) || empty($password)) {
		  $display_hide='';
	} else {

		// Add slashes to the username and md5() the password
		$user = trim($_POST['username']);
		$pass = md5($_POST['password']);
                
                $login=ORM::for_table('login_users')
                        ->where(array(
                                'username'=>$user,
                                'password'=>$pass))
                        ->find_one();
                if ($login) {
                    if (RATIO_LOGGED_MINUTES==0) {
                        // no limit logged time
                        ini_set('session.cookie_lifetime', 0);
                    } else {
                        ini_set('session.cookie_lifetime', 60 * RATIO_LOGGED_MINUTES);
                    }
                    session_regenerate_id();    
                    
                    // Save if user restricted
                    $_SESSION['restricted'] = $login->restricted;
                    
                    // Save user's current level
                    $user_level=unserialize($login->user_level);
                    
                   echo $user_level;
                }
/*		if($rowCheck > 0) {
			while($row = mysql_fetch_array($result)) {

				// Expiration per config.php
				if($minutes == 0) ini_set('session.cookie_lifetime', 0);
				else ini_set('session.cookie_lifetime', 60 * $minutes);
				session_regenerate_id();

				// Check if user still requires activation
				$sql = "SELECT * FROM login_activate WHERE username='$user'";
				$activateResult = mysql_query($sql) or die("Fatal error: " . mysql_error());
				if (mysql_num_rows($activateResult) > 0) {
					// Needs activation
					$_SESSION['activate'] = 1;
				} else $_SESSION['activate'] = 0;

				// Save if user is restricted
				$_SESSION['restricted'] = $row['restricted'];
                $_SESSION['edit_days'] =$row['edit_days'];
				$_SESSION['init_price'] =$row['price'];
				// Save user's current level
				$user_level = unserialize($row['user_level']);

				// Save whether their user level is disabled or not
				$sql = "SELECT level_disabled FROM login_levels WHERE level_level = '$user_level'";
				$disResult = mysql_query($sql);
				$disRow = mysql_fetch_array($disResult);
				$_SESSION['level_disabled'] = $disRow['level_disabled'];


				// Start the session and register user variables
				if (!isset($_SESSION)) session_start();
				$_SESSION['user_level'] = $user_level;
        $_SESSION['user_id'] = $row['user_id'];

				// Stay signed in checkbox
				if(isset($_POST['remember'])) {
				ini_set('session.cookie_lifetime', 60*60*24*100); // Set to expire in 3 months & 10 days
				session_regenerate_id();
				$_SESSION['username'] = $user;
				} else $_SESSION['username'] = $user;
        do_log('login','Пользователь вошел в систему');
				// Redirect after they signin
				header("Location: ".$ref); exit();
			}
		} else {
			// If nothing is returned by the query, unsuccessful login code goes here...
			$error = '<div class="alert-message error">'._('Некорректное имя пользователя или пароль.').' <a class="close" data-dismiss="alert">×</a></div>';
      $logtext='IP Атакующего : '.$_SERVER['HTTP_X_FORWARDED_FOR'].'|'.$_SERVER['REMOTE_ADDR']."\r\n".' Имя : '.$user;
      //echo $logtext;  print_r($_SERVER);
      do_log('attack',$logtext);
			}
                    */
	}
}

echo $display_hide;
//@include('functions/mk3_functions.php');
//print_r($_SESSION);
$css=array();
$css[]="vendors/select2/select2.css";
$css[]="themes/".THEME."/pages/css/login-soft.css";
get_header($css);
?>

<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.php">
	<img src="<?php echo THEMEHOME; ?>/img/logo-big.png" alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="index.php" method="post">
		<h3 class="form-title"><?php __('Login to your account');?></h3>
		<div class="alert alert-danger <?php echo $display_hide;?>">
			<button class="close" data-close="alert"></button>
			<span>
			<?php __('Enter any username and password.');?> 
                        </span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9"><?php __('Username');?></label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="<?php __('Username');?>" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9"><?php __('Password');?></label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="<?php __('Password');?>" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
			<input type="checkbox" name="remember" value="1"/> <?php __('Remember me');?> </label>
			<button type="submit" class="btn blue pull-right" name="login">
			<?php __('Login');?> <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
		<div class="login-options">
			<h4><?php __('Choose your language');?> : <span class="lng_title"></span></h4>
                        <div id="lng_switch">
                            <a class="rama"></a>
                            <a class="ln" href="?_lng=ru" title="русский"><img src="<?php echo THEMEHOME;?>/img/flags32/ru.png" title="русский"></a>
                            <a class="ln" href="?_lng=fr" title="français"><img src="<?php echo THEMEHOME;?>/img/flags32/fr.png" title="français"></a>
                            <a class="ln" href="?_lng=en" title="english"><img src="<?php echo THEMEHOME;?>/img/flags32/en.png" title="english"></a>
                        </div>
		</div>
		
		
	</form>
	<!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2014 &copy; Ratio System
</div>

<?php

get_current_page_script('login-soft');
$scripts=array();
$scripts[]="vendors/jquery-validation/js/jquery.validate.min.js";
$scripts[]="vendors/backstretch/jquery.backstretch.min.js";
$scripts[]="vendors/select2/select2.min.js";
$scripts[]="themes/".THEME."/scripts/metronic.js";
$scripts[]="themes/".THEME."/scripts/layout.js";
get_footer($scripts); 
?>





