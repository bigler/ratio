<?php            
   if (!defined('RATIO_1.0')) { header('Location:'.'is404.php');die(); }              
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Admin Dashboard Template</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="vendors/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="vendors/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="vendors/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->


<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<?php get_page_styles($css); ?>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="themes/<?php echo THEME; ?>/css/components.css" rel="stylesheet" type="text/css"/>
<link href="themes/<?php echo THEME; ?>/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="themes/<?php echo THEME; ?>/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="themes/<?php echo THEME; ?>/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="themes/<?php echo THEME; ?>/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<!-- BEGIN JQUERY LOAD -->
<script src="vendors/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="vendors/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- END JQUERY LOAD -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

