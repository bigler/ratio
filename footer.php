<!-- Footer
================================================== -->

      <footer>
        <p><a href="http://mk3.ru" target="_TOP"><?php __('Инжиниринговая компания MK3');?> 2012-2014</a></p>
      </footer>

    </div> <!-- /content -->
</div> <!-- /container-fluid -->
	<?php if(stristr($_SERVER['PHP_SELF'], 'admin') or stristr($_SERVER['PHP_SELF'], 'install.php')) $loc = '../'; else $loc = ''; ?>

	<!-- Le javascript -->
  <!--	<script src="<?php echo $loc; ?>assets/js/bootstrap.min.new.js"></script>     -->
		<script src="<?php echo $loc; ?>assets/js/bootstrap-dropdown.js"></script>  
	
     

	<script src="<?php echo $loc; ?>assets/js/jquery.jigowatt.js"></script> 
	<?php if ($loc != '') { ?><script src="assets/js/ajax_search.js"></script><?php } ?>  

  </body>
</html>