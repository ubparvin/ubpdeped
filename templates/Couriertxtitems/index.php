<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="col-md-6">
<div class="card shadow mb-4 noradius">
	
	<div class="card-header py-3">
        <h2 class="fs-14 bold text-info nomargin nopadding"><?php echo $contract->name; ?></h2>
		<div class="btn-group">
		
		<?= $this->Html->link(__('<i class="fa fa-arrow-left"></i> BACK'), 
		['controller' => 'couriertxtitems', 'action' => 'selectprogram'], 
		['escape' => false, 'class' => 'fs-10 bold btn btn-info btn-sm']) ?>
		
		
		<?= $this->Html->link(__('<i class="fa fa-filter"></i> FILTER ITEMS'), 
		['action' => 'filter', 'controller' => 'couriertxtitems'], 
		['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-info modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Product Display',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-download"></i> IMPORT ITEMS'), 
		['action' => 'import', 'controller' => 'couriertxtitems'], 
		['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-info modal_view btn-sm', 
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
						<th>#</th>
						<th>REGION / DIVISION</th>
						<th>SCHOOL / ADDRESS </th>
						<th>ACTION</th>
						
					</tr>
				</thead>
				
			</table>
		</div>
	</div>
</div>
</div>
    
<?php echo $this->element('modal/modal_lg_with_place'); ?>
<?php echo $this->element('modal/modal_normal_sub'); ?>

<?php 
	
	echo $this->Html->script('datatable/datatables.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/pdfmake.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/vfs_fonts', ['block' => 'scriptBottom']);	
	echo $this->Html->script('table/couriertxtitem_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/couriertxtitems', ['block' => 'scriptBottom']);	
	//echo $this->Html->script('admin/controller/categories', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/jquery.uploadfile.min', ['block' => 'scriptBottom']);	
		// Append into the 'script' block.
	echo $this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "couriertxtitems/indexajax/'.$id.'")';
	echo $this->Html->scriptEnd();
?>

