<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Deped - Inventory System</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array('login', 'admin/sb-admin-2', 'util'));
		//echo $this->Html->script(array('jQuery-2.2.0.min', 'bootstrap.min'));		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

</head>
<body><?php echo $this->fetch('content'); ?>
</body>
</html>

<?= $this->Html->script([
		'admin/vendor/jquery/jquery.min', 
		'admin/inputmask.bundle', 
		'admin/login'
	]) ?>

<?= $this->fetch('script') ?>
<?php //echo $this->fetch('scriptBottom'); ?>	