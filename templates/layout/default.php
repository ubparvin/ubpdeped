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

    <!-- Page Wrapper -->
    <div id="wrapper">
		<?php $user = $this->request->getSession()->read('Auth.User'); ?>	
        <?php echo $this->element('sidebar', array('user' => $user)); ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <?php echo $this->element('topbar', array('user' => $user)); ?>
			
                <!-- Begin Page Content -->
                <div class="container-fluid ">

                    <!-- Page Heading -->
                    <!--div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div-->
					
					<div class="main_content">	
					
						<?php echo $this->fetch('content'); ?>
					</diiv>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php //echo $this->element('footer'); ?>

        </div>
        <!-- End of Content Wrapper -->
		
		
	
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-backdrop="static" keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you still there?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">You have been idle for a specific time range. Please logout then login again.</div>
                <div class="modal-footer">
                    
                    <?php 
						echo $this->Html->link('<i class="fa fa-logout fa-lg"></i> Ok',
						['controller' => 'users', 'action' => 'logout'],
						['escape' => false, 'class'=> 'btn btn-success btn-xs']
						);
					?>
                </div>
            </div>
        </div>
    </div>
	
	
	<?php echo $this->element('notification/loading'); ?>
	<?php echo $this->element('notification/success'); ?>
	<?php echo $this->element('notification/error'); ?>
	<?php echo $this->element('notification/processing'); ?>

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
