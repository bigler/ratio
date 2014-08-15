<?php include('check.php'); check_login(array(1)); ?>
<?php include('header.php'); ?>
<link rel="stylesheet" media="all" type="text/css" href="js/datetime/jquery-ui-timepicker-addon.css" />
<script type="text/javascript" src="js/datetime/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/datetime/i18n/jquery-ui-timepicker-<?php echo $_SESSION['lang'];?>.js"></script>

<script type='text/javascript'>

$(document).ready(function() {

   $('#tm').datetimepicker({
      language: '<?php echo $_SESSION['lang'];?>'
    
   });
  
   $('#block').click(function(){
              $('#alert').empty();
              $.ajax({
                      url: "json.php",
                      cashe: false,
                      type: 'POST',
                      data:({action:'block_site', date: $('#tm').val()}),
                      success: function(res) {
                                $('#alert').append(res);
                                $('#alert').show(250).delay(3500).hide(250);
                              
                             }
                      }); 
          
   });
});
</script>
<div id="alert" class="success alert-message" style="display:none"></div>
<a class="btn primary" id="block" href="#"><?php __('Заблокировать систему до:');?> </a>
<input id="tm" name="tm" type="text" class="text ui-widget-content ui-corner-all"> 


<?php include('footer.php'); ?>