<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4 noradius">
	<div class="card-header py-3">
        
		<div class="btn-group">
		
		
		<?= $this->Html->link(__('<i class="fa fa-list"></i><div>MANAGE</div>'), 
		['controller' => 'distributions', 'action' => 'index'], 
		['escape' => false, 'class' => 'fs-11 bold btn btn-success btn-sm']) ?>
	
		<?= $this->Html->link(__('<i class="fa fa-map-marker"></i> <div>FILTER BY PLACE</div>'), 
		['controller' => 'distributions', 'action' => 'filterproduct', "place"], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-danger modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Distribution by Place',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-question-circle"></i> <div>FILTER BY STATUS</div>'), 
		['controller' => 'distributions', 'action' => 'filterproduct', "status"], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-danger modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Distribution by Status',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-tag"></i> <div>FILTER BY ITEM</div>'), 
		['controller' => 'distributions', 'action' => 'filterproduct', "item"], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-danger modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Distribution by Item',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		
		<?= $this->Html->link(__('<i class="fa fa-school"></i> <div>FILTER BY SCHOOL</div>'), 
		['controller' => 'distributions', 'action' => 'filterproduct', "school"], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-danger modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Distribution by School',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-calendar-day"></i> <div>FILTER BY DATE</div>'), 
		['controller' => 'distributions', 'action' => 'filterproduct', 'date'], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-danger modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Distribution by Delivery Date',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-filter"></i> <div>COMBINE</div>'), 
		['controller' => 'distributions', 'action' => 'filterproduct', 'combine'], 
		['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-danger modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Distribution by Delivery Date',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		
		</div>
		
    </div>
	<div class="card-body m-b-50">
		<div class="row">
			<div class="col-md-8 nopadding-right">
				<div class="card shadow h-100 py-2 noradius">
					<div class="card-body">
						<div class="table-responsive">
						<?php echo $this->Form->create(); ?>
						   <table class="table table-condensed" id="p_table" width="100%" cellspacing="0">
								<thead>
									<tr>
										<th>#</th>
										<th>PROGRAM</th>
										<th>ITEM</th>
										<th>SCHOOL & ADDRESS</th>
										<th>STATUS</th>
										<th>ACTION</th>
									</tr>
								</thead>
								
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="row">
					<?php 
						$for_packaging = $this->cell('Distribution::displaystatus', [1, 'For Releasing', 'gift'], ['cache' => false]);

						echo $for_packaging; 
						
						$for_pickup = $this->cell('Distribution::displaystatus', [2, 'Picked-up From Warehouse', 'qrcode'], ['cache' => false]);

						echo $for_pickup; 
						
						$for_delivery = $this->cell('Distribution::displaystatus', [8, 'For Delivery', 'shipping-fast'], ['cache' => false]);

						echo $for_delivery; 
						
						$in_transit = $this->cell('Distribution::displaystatus', [4, 'In Transit / Shipment', 'ship'], ['cache' => false]);

						echo $in_transit; 
						
						$total_2021 = $this->cell('Distribution::displaytotal', [ date('Y').' Distribution Summary', date('Y')], ['cache' => false]);

						echo $total_2021; 
						
						//$total_2020 = $this->cell('Distribution::displaytotal', ['2020 Distribution Summary', '2020'], ['cache' => false]);

						//echo $total_2020; 
					 ?>

				</div>
				
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
	echo $this->Html->script('table/distribution_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/distributions', ['block' => 'scriptBottom']);	
	
	echo $this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "distributions/indexajax/")';
	echo $this->Html->scriptEnd();
?>

