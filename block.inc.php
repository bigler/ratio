<style>
   body { margin: 0 10px; }
    
</style>
<?php
$duration = $end-$cr;
$hours = (int)($duration/60/60);
$minutes = (int)($duration/60)-$hours*60;
$seconds = (int)$duration-$hours*60*60-$minutes*60;
?>
    <div class="block-overlay">

    	<div class="block_info img-polaroid">
      <div style="background: #dfdfdf; margin: 10px;padding: 20px;height: 340px; border-radius: 10px;">
		<h4>Система временно недоступна. <br>Ведутся внутренние работы до <?php echo $tm; ?></h4>
    <h4>Осталось: <?php echo sprintf("%02s",$hours).':'.sprintf("%02s",$minutes).':'.sprintf("%02s",$seconds);?></h4>
    <img src="images/bl.gif">
      </div>
		

		<?php //print_r($_SESSION); ?>
  	</div>

    </div> <!-- /container -->

 <div style="height: 500px;">
 </div>

<?php include('footer.php'); ?>