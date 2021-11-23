<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4 noradius">
	<div class="card-header py-3">
        
		<div class="btn-group">
		
		<?= $this->Html->link(__('<i class="fa fa-list"></i><div>MANAGE</div>'), 
		['controller' => 'products', 'action' => 'index'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm']) ?>
		
		
		<?= $this->Html->link(__('<i class="fa fa-sync"></i><div>REFRESH DATA</div>'), 
		['controller' => 'products', 'action' => 'index'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm']) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> <div>REGISTER ITEM</div>'), 
		['action' => 'add', 'controller' => 'products'], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-success modal_view btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Register New Item',
			'note' => 'Required fields are marked with *'
		],
			
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-clock"></i> <div>EXPIRED</div>'), 
		['controller' => 'products', 'action' => 'index', 'expired'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm']) 
		?>
		
		<?= $this->Html->link(__('<i class="fa fa-layer-group"></i> <div>OUR OF STOCKS</div>'), 
		['controller' => 'products', 'action' => 'index', 'out-of-stocks'], 
		['escape' => false, 'class' => 'btn btn-success btn-sm fs-11 bold']) 
		?>
		
		<?= $this->Html->link(__('<i class="fa fa-sticky-note"></i> <div>RECEIVED LOGS</div>'), 
		['controller' => 'products', 'action' => 'index', 'out-of-stocks'], 
		['escape' => false, 'class' => 'btn btn-success btn-sm fs-11 bold']) 
		?>

		<?= $this->Html->link(__('<i class="fa fa-upload"></i> <div>IMPORT ITEMS</div>'), 
		['action' => 'import', 'controller' => 'products'], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-warning modal_view btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Import Products',
			'note' => 'Required fields are marked with *'
		],
			
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-filter"></i> <div>FILTER DISPLAY</div>'), 
		['action' => 'filter', 'controller' => 'products'], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-danger modal_view btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Filter Product Display',
			'note' => 'Please select from the dropdown below'
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
						<th>NAME</th>
						<th>EXPIRATION</th>
						<th>WARRANTY EXPIRES</th>
						<th>QUANTITY</th>
						<th>REGISTERED</th>
						<th>MODIFIED</th>
						<th>STATUS</th>
						<th>ACTION</th>
					</tr>
				</thead>
				
			</table>
		</div>
	</div>
</div>
    
<?php echo $this->element('modal/modal_lg_with_place'); ?>
<?php //echo $this->element('modal/modal_normal'); ?>

<?php 
	
	echo $this->Html->script('datatable/datatables.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/pdfmake.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/vfs_fonts', ['block' => 'scriptBottom']);	
	echo $this->Html->script('table/product_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/products', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/categories', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/jquery.uploadfile.min', ['block' => 'scriptBottom']);	
?>

