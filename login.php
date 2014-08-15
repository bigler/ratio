<?php 
@session_start(); 
$ref=SITE_PATH;
if(isset($_SERVER['HTTP_REFERER'])) $ref = $_SERVER['HTTP_REFERER'];
if(isset($_SESSION['username'])) {
     header("Location: ".$ref); die();
}

// Only process if the login form has been submitted.
if(isset($_POST['login'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];

	if (!isset($username) || !isset($password)) {
		header( "Location: index.php" ); exit();
	} elseif (empty($username) || empty($password)) {
		$error = '<div class="alert-message error">'._('Введите имя пользователя и пароль.').'</div>';
	} else {

		// Add slashes to the username and md5() the password
		$user = mysql_real_escape_string(trim($_POST['username']));
		$pass = mysql_real_escape_string(md5($_POST['password']));

		$sql = "SELECT * FROM login_users WHERE username='$user' AND password='$pass'";
		$result = mysql_query($sql);

		// Check that at least one row was returned
		$rowCheck = mysql_num_rows($result);

		if($rowCheck > 0) {
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
	}
}


//@include('functions/mk3_functions.php');
//print_r($_SESSION);
if(isset($error)) echo $error; ?>


<div class="login-box">
<div style="width: 220px; margin:0px 0px 0px 200px; padding-top: 50px;position: relative;">

	<div class="main login2">
		<form method="post" class="form" >
        <div class="lng_select">
            <a href="?mk3_lng=fr" class="fr24 mk3_lng" title="français" rel="fr">
                <div class="paris mimi"></div>
            </a>
            <a href="?mk3_lng=ru" class="ru24 mk3_lng" title="русский" rel="ru">
                 <div class="moscow mimi"></div>
            </a>
        </div>    
		<h6><?php __('Необходима авторизация'); ?></h6>
    <div class="dt"></div>   
		<fieldset>
			<div class="clearfix">
		 	<div class="input-prepend">
        <span class="add-on" style="width:50px;"><?php __('Логин'); ?></span><input  id="username" name="username" size="30" type="text" class="span2" style="width:149px;"/>
        </div>
				
			</div><!-- /clearfix -->

			<div class="clearfix">
	   
			<div class="input-prepend">
        <span class="add-on"  style="width:50px;"><?php __('Пароль'); ?></span><input id="password" name="password" size="30" type="password" class="span2" style="width:149px;"/>
        </div>

			</div><!-- /clearfix -->

		</fieldset>






		<label class="checkbox inline" for="remember">
			<input type="checkbox" id="remember" name="remember"/><span style="color:#fff;"><?php __('Запомнить'); ?></span>
		</label>
	  <div style="text-align: right; padding-top: 7px;">
		<input type="submit" value="<?php __('Вход'); ?>" class="btn btn-primary" name="login" style="width: 82px; color: #fff; "/>
	  </div>
		
		</form>
	</div>

</div>
 </div>
