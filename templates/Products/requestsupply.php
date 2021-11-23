<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4 noradius">
	<div class="card-header py-3">
        
		<div class="btn-group">
		
		
		<?= $this->Html->link(__('<i class="fa fa-sync"></i><div>REFRESH DATA</div>'), 
		['controller' => 'products', 'action' => 'requestsupply'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm']) ?>
		
		
		<?= $this->Html->link(__('<i class="fa fa-filter"></i> <div>FILTER ITEMS</div>'), 
		['action' => 'filter', 'controller' => 'products'], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-danger modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Product Display',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		
		</div>
		
    </div>
	<div class="card-body">
		<div class="filte_index">
			
		</div>
		
		<!--div class="tabs">
		  <ul id="tabs-nav">
			<li><a href="#tab1">Step 1</a><div class="text-warning">Select Items</div></li>
			<li><a href="#tab2">Step 2</a><div class="text-warning">Delivery Details</div></li>
			<li><a href="#tab2">Step 3</a><div class="text-warning">Confirm & Done</div></li>
			
		  </ul> 
		  <div id="tabs-content">
			<div id="tab1" class="tab-content">
			  <h2>Silent Bob</h2>
			  <p>"You know, there's a million fine looking women in the world, dude. But they don't all bring you lasagna at work. Most of 'em just cheat on you."</p>
			</div>
			<div id="tab2" class="tab-content">
			  <h2>Dante Hicks</h2>
			  <p>"My friend here's trying to convince me that any independent contractors who were working on the uncompleted Death Star were innocent victims when it was destroyed by the Rebels."</p>
			</div>
			<div id="tab3" class="tab-content">
			  <h2>Randall Graves</h2>
			  <p>"In light of this lurid tale, I don't even see how you can romanticize your relationship with Caitlin. She broke your heart and inadvertently drove men to deviant lifestyles."</p>
			</div>
			
		  </div> 
		</div-->



		<div class="table-responsive">
		<?php echo $this->Form->create(); ?>
		   <table class="table table-condensed" id="p_table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>ITEM DETAILS</th>
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
	echo $this->Html->script('table/product_table_request', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/products_request', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/categories', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/jquery.uploadfile.min', ['block' => 'scriptBottom']);	
		// Append into the 'script' block.
	echo $this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "products/requestsupplyajax/'.$params.'")';
	echo $this->Html->scriptEnd();
?>

