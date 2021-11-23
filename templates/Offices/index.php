<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4 noradius">
	<div class="card-header py-3">
        
		<div class="btn-group">
		
		
		
		<?= $this->Html->link(__('<i class="fa fa-list"></i> <div>MANAGE</div>'), 
		['action' => 'index'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm noradius']) ?>
		

		<?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> <div>REGISTER OFFICE</div>'), 
		['action' => 'add'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm noradius modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'Register Office',
			'note' => 'Required fields are marked with *'
		],
			
		) ?>

		</div>
    </div>
	<div class="card-body">
		<div class="table-responsive">
		<?php echo $this->Form->create(); ?>
		   <table class="table table-condensed" id="p_table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>NAME & ADDRESS</th>
						<th>CONTACT PERSON</th>
						<th>CONTACT NO.</th>
						<th>CREATED</th>
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
	echo $this->Html->script('table/office_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/office', ['block' => 'scriptBottom']);	
		// Append into the 'script' block.
	$this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "offices/indexajax")';
	$this->Html->scriptEnd();
?>

