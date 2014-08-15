<?php if (!isset($_SESSION)) session_start(); ?>

<?php //print_r($_SESSION);
include_once('core/functions/dbconn.php');
include_once('core/functions/functions.php');
$def_level=get_min_access_level();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RATIO</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendors/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>     
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>

<body>
<div id="loader" style="display:none;"><div><?php __('Загрузка...');?></div></div>

<!-- Navigation
================================================== -->
<!--
	<div class="topbar-wrapper" style="z-index: 5;">
		<div class="topbar" data-dropdown="dropdown" >
			<div class="topbar-inner">
				<div class="container-fluid">
					<h3><a href="index.php">MK3</a></h3>
          <?php
             switch ($def_level)     { 
                 case 0 : include('core/inc/nologin.php'); 
                            break;
                 case 1 : include('core/inc/admin.php');
                            break;
                 case 2 : include('core/inc/manager.php');
                            break;                             
                 case 3 : include('core/inc/dir.php');
                            break;             
                 default  : include('core/inc/user.php');
                            break;
             }                     
          ?>

		<?php if(isset($_SESSION['username'])) { ?>
		<ul class="nav secondary-nav">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle"><?php echo $_SESSION['username']; ?></a>
				<ul class="dropdown-menu">
		<?php if(in_array(1, $_SESSION['user_level'])) { ?>
					<li><a href="<?php echo $loc; ?>admin/index.php"><?php __('Пользователи');?></a></li> 
					<li><a href="<?php echo $loc; ?>hint.php"><?php __('Сообщение дня');?></a></li> 
          <li><a href="<?php echo $loc; ?>logos.php"><?php __('Лог системы');?></a></li>
          <li><a href="<?php echo $loc; ?>reset.php"><?php __('Смена паролей');?></a></li>
          <li><a href="<?php echo $loc; ?>block.php"><?php __('Блокировка');?></a></li>
    <?php } ?>
					<li><a href="<?php echo $loc; ?>my-account.php"><?php __('Профиль');?></a></li>
					<li><a href="#"><?php __('Помощь');?></a></li>
					<li class="divider"></li>
					<li><a href="<?php echo $loc; ?>logout.php"><?php __('Выход');?></a></li>
				</ul>
			</li>
		</ul>
		<?php } else { ?>
		<ul class="nav secondary-nav">
			<li><a href="login.php" class="signup-link"><em><?php __('Уже зарегистрированы?'); ?></em> <strong><?php __('Авторизуйтесь!');?></strong></a></li>
		</ul>
		<?php } ?>
				</div>
			</div><!-- /topbar-inner -->
		</div><!-- /topbar -->
	</div><!-- /topbar-wrapper -->
-->
<!-- Main content
================================================== -->
		<div class="container-fluid">
			<div class="content">
