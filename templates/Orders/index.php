
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
        <div class="btn-group">
		
		<?= $this->Html->link(__('<i class="fa fa-list"></i> <div>MANAGE</div>'), 
		['controller' => 'orders', 'action' => 'index'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm noradius']) ?>
		
	
		
		<?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> <div>CREATE P.O.</div>'), 
		['controller' => 'orders', 'action' => 'add'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm noradius modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'CREATE PURCHASE ORDER',
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
		
		<?php $pending = $this->cell('Common::newrequest', ['PENDING'], ['cache' => false]); ?>
		<?= $this->Html->link(__('<i class="fa fa-user-circle"></i> <div>SUPPLY REQUEST <span class="badge badge-success badge-counter fs-12 bold">'.$pending.'</span></div> '), 
		['controller' => 'requests', 'action' => 'index'], 
		['escape' => false, 'class' => 'pull-right fs-11 bold btn btn-primary btn-sm noradius']) ?>
		
		
		
    </div>
	<div class="card-body">
		<div class="table-responsive">
		<?php echo $this->Form->create(); ?>
		   <table class="table table-condensed text-default table-striped" id="p_table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>PO #</th>
						<th>VENDOR</th>
						<th>ITEM</th>
						<th>TOTAL</th>
						<th>DISCOUNT</th>
						<th>DUE</th>
						<th>PAID</th>
						<th>BALANCE</th>
						<th>PAYMENT</th>
						<th>TERM</th>
						<th>STATUS</th>
						<th>ACTION</th>
					</tr>
				</thead>
				
			</table>
		</div>
	</div>
</div>
    
<?php echo $this->element('modal/modal_lg_with_place'); ?>


<?php 
	
	echo $this->Html->script('datatable/datatables.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/pdfmake.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/vfs_fonts', ['block' => 'scriptBottom']);	
	echo $this->Html->script('table/order_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/order', ['block' => 'scriptBottom']);	
	echo $this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "orders/indexajax")';
	echo $this->Html->scriptEnd();
?>

