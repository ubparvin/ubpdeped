
<!-- DataTales Example -->
<div class="col-md-8 nopadding">
<div class="card shadow mb-4">
	<div class="card-header py-3">
        <div class="btn-group">
		
		<?= $this->Html->link(__('<i class="fa fa-list"></i> MANAGE'), 
		['action' => 'index'], 
		['escape' => false, 'class' => 'fs-10 bold btn btn-info btn-sm noradius']) ?>
		

		<?= $this->Html->link(__('<i class="fa fa-plus-circle"></i>REGISTER'), 
		['action' => 'add'], 
		['escape' => false, 'class' => 'fs-10 bold btn btn-info btn-sm noradius modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Register New Supplier',
			'note' => 'Required fields are marked with *'
		],
			
		) ?>
		
		
		</div>
    </div>
	<div class="card-body">
		<div class="table-responsive">
		<?php echo $this->Form->create(); ?>
		   <table class="table table-condensed text-default table-striped" id="p_table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>NAME & ADDRESS</th>
						<th>OWNER & CONTACT</th>
						<th>LICENSE NO.</th>
						<th>REGISTRATION</th>
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


<?php 
	
	echo $this->Html->script('datatable/datatables.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/pdfmake.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/vfs_fonts', ['block' => 'scriptBottom']);	
	echo $this->Html->script('table/vendor_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/vendor', ['block' => 'scriptBottom']);	
		// Append into the 'script' block.
	$this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "vendors/indexajax")';
	$this->Html->scriptEnd();
?>

