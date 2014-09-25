<?php  if (!defined('RATIO_1.0')) { header('Location:'.'is404.php');die(); }        ?>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="vendors/respond.min.js"></script>
<script src="vendors/excanvas.min.js"></script> 
<![endif]-->
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="vendors/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="vendors/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="vendors/jquery.blockui.min.js" type="text/javascript"></script>
<script src="vendors/jquery.cokie.min.js" type="text/javascript"></script>
<script src="vendors/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="vendors/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?php  get_page_scripts($scripts); ?>
<!-- END PAGE LEVEL SCRIPTS -->
</body>
</html>