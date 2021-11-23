<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4 noradius">
	<div class="card-header py-3">
        
		<div class="btn-group">
		<?php $pending = $this->cell('Common::newrequest', ['PENDING'], ['cache' => false]); ?>
		<?= $this->Html->link(__('<span class="badge badge-danger badge-counter">'.$pending.'</span> <div>NEW REQUEST</div> '), 
		['controller' => 'orders', 'action' => 'newrequest'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-primary btn-sm noradius']) ?>
		
		
		
		<?= $this->Html->link(__('<i class="fa fa-list"></i> <div>MANAGE</div>'), 
		['controller' => 'orders', 'action' => 'index'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm noradius']) ?>
		
	
		
		<?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> <div>CREATE NEW</div>'), 
		['controller' => 'orders', 'action' => 'add'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm noradius modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Register New Supplier',
			'note' => 'Required fields are marked with *'
		],
		
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-filter"></i> <div>FILTER</div>'), 
		['action' => 'add'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-danger btn-sm noradius modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Register New Supplier',
			'note' => 'Required fields are marked with *'
		],
		
		) ?>
		
	
		</div>
		
    </div>
	<div class="card-body">
		<div class="filte_index">
			
		</div>
		
		<div class="table-responsive">
		<?php echo $this->Form->create(); ?>
		   <table class="table table-condensed" id="p_table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>#</th>
						<th>REQUESTOR DETAILS</th>
						<th>ITEM DETAILS</th>
						<th>DELIVERY ADDRESS</th>
						<th>CREATED</th>
						<th>STATUS</th>
						<th>ACTION</th>
					</tr>
				</thead>
				
			</table>
		</div>
	</div>
</div>
   
<?php echo $this->element('modal/modal_lg_with_place'); ?>
<?php echo $this->element('modal/modal_normal_sub'); ?>

<?php 
	
	echo $this->Html->script('datatable/datatables.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/pdfmake.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/vfs_fonts', ['block' => 'scriptBottom']);	
	echo $this->Html->script('table/request_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/request', ['block' => 'scriptBottom']);	
		// Append into the 'script' block.
	echo $this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "requests/indexajax/'.$group.'")';
	echo $this->Html->scriptEnd();
?>

