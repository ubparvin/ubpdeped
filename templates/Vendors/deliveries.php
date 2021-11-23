
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
        <div class="btn-group">
		
		<?= $this->Html->link(__('<i class="fa fa-list"></i> <div>MANAGE</div>'), 
		['action' => 'index'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm noradius']) ?>
		

		<?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> <div>REGISTER NEW</div>'), 
		['action' => 'add'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm noradius modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Register New Supplier',
			'note' => 'Required fields are marked with *'
		],
			
		) ?>
		
		<button type="button" id="refresh_table" class= "nooutline fs-11 bold btn btn-success btn-sm modal_view_sub noradius"><i class="fa fa-sync"></i><div>REFRESH DATA</div></button>
		
		</div>
    </div>
	<div class="card-body">
		<div class="table-responsive">
		<?php echo $this->Form->create(); ?>
		   <table class="table table-condensed text-default table-striped" id="p_table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>NAME</th>
						<th>MANAGE & OPERATED BY</th>
						<th>LICENSE</th>
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


<?php 
	/*
	echo $this->Html->script('datatable/datatables.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/pdfmake.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/vfs_fonts', ['block' => 'scriptBottom']);	
	echo $this->Html->script('table/vendor_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/vendor', ['block' => 'scriptBottom']);	
		// Append into the 'script' block.
	$this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "vendors/indexajax")';
	$this->Html->scriptEnd();*/
?>

