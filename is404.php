<?php
  require( dirname( __FILE__ ) . '/loader.php' );
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title><?php echo RATIO_TITLE; ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="themes/<?php echo THEME; ?>/pages/css/error.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="page-404-3">
<div class="page-inner">
	<img src="themes/<?php echo THEME; ?>/pages/media/pages/earth.jpg" class="img-responsive" alt="">
</div>
<div class="container error-404">
	<h1>404</h1>
	<h2><?php __('Houston, we have a problem.');?></h2>
	<p>
		<?php __('Actually, the page you are looking for does not exist.'); ?>
	</p>
	<p>
		<a href="index.php">
		<?php __('Return home');?> </a>
		<br>
	</p>
</div>
</body>
<!-- END BODY -->
</html>