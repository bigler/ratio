<?php include('check.php'); check_login(array(1)); ?>
<?php include('header.php'); ?>

<div class="row">
	<div class="span16">
		<h1>Пример страницы!</h1>

		<h3>Вы просматриваете защищенный ресурс! (ТОЛЬКО Администраторы)</h3>
		<p>Вы имеете доступ к данной странице, если обладаете правом <span class="label important">Администратор</span></p>

		<?php //print_r($_SESSION); ?>
	</div>
</div>

<?php include('footer.php'); ?>