<!DOCTYPE html>
<html lang="en">

<head>

	<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        DepEd IMS <?php echo (isset($title) && !empty($title) ? $title : ""); ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css([
		//'normalize.min', 
		//'milligram.min', 
		//'cake',
		'admin/vendor/fontawesome-free/css/all.min',
		'admin/sb-admin-2',
		//'admin/vendor/datatables/dataTables.bootstrap4.min',
		//'admin/jquery.dataTables.min',
		'datatable/datatables.min',
		//'bootstrap/bootstrap.min',
		'admin/fonts',
		'util',
		'admin/custom',
		'admin/uploadfile'
		//'admin/uploadfile.custom'
	]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
	
</head>

<body id="page-top">
	<?php echo $this->fetch('content'); ?>
</body>
</html>
<?= $this->Html->script([
		'webroot',
		'admin/vendor/jquery/jquery.min', 
		'admin/vendor/bootstrap/js/bootstrap.bundle.min', 
		'admin/vendor/jquery-easing/jquery.easing.min', 
		'admin/sb-admin-2.min', 
		'admin/inputmask.bundle', 
		//'admin/vendor/chart.js/Chart.min', 
		//'admin/demo/chart-area-demo', 
		//'admin/demo/chart-pie-demo',
		//'admin/vendor/datatables/jquery.dataTables.min',
		//'admin/jquery.dataTables.min',
		//'admin/vendor/datatables/dataTables.bootstrap4.min',
		'idle-timer.min',
		'admin/common',
		'admin/printThis',
		'admin/jquery.uploadfile.min',
		
	]) ?>

<?= $this->fetch('script') ?>
<?php echo $this->fetch('scriptBottom'); ?>	
<script type="text/javascript">
	$(document).ready( function(){
		 window.print();
	});
</script>