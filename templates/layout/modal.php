<!DOCTYPE html>
<html lang="en">

<head>

	<?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        DEPED ADMINISTRATOR - <?= $this->fetch('title') ?>
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
		//'admin/uploadfile'
		//'admin/uploadfile.custom'
	]) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
	
</head>

<body id="page-top">

					
					<div class="main_content">	
					
						<?php echo $this->fetch('content'); ?>
					</diiv>
             
</body>
</html>
