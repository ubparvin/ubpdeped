
<!-- DataTales Example -->
<div class="col-md-10 nopadding">
<div class="card shadow mb-4">
	<div class="card-header py-3">
        <div class="btn-group">
		
		<?= $this->Html->link(__('<i class="fa fa-list"></i> MANAGE'), 
		['action' => 'index'], 
		['escape' => false, 'class' => 'fs-10 bold btn btn-info btn-sm noradius']) ?>
		

		<?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> REGISTER'), 
		['action' => 'add'], 
		['escape' => false, 'class' => 'fs-10 bold btn btn-info btn-sm noradius modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Create New System User',
			'note' => 'Required fields are marked with *'
		],
			
		) ?>
		
		
		<?= $this->Html->link(__('<i class="fa fa-search"></i> SHOW FILTER'), 
		['action' => 'filter', 'controller' => 'users'], 
		['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-info modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Account Display',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		
		</div>
    </div>
	<div class="card-body">
		<div class="table-responsive">
		<?php echo $this->Form->create(); ?>
		   <table class="table table-condensed table-striped" id="p_table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>NAME & CONTACT INFO</th>
						<th>ACCESS GROUP</th>
						<th>CREATED</th>
						<th>MODIFIED</th>
						<th>LAST ACCESS</th>
						<th>STATUS</th>
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
	echo $this->Html->script('table/users_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/users', ['block' => 'scriptBottom']);	
		// Append into the 'script' block.
	$this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "users/indexajax")';
	$this->Html->scriptEnd();
?>

