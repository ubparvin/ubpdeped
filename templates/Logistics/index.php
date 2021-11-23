<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4 noradius">
	<div class="card-header py-3">
        
		<div class="btn-group">
		
		
		<?= $this->Html->link(__('<i class="fa fa-sync fa-xs"></i> REALTIME'), 
		['controller' => 'logistics', 'action' => 'index'], 
		['escape' => false, 'class' => 'refresh_table nodisplay fs-10 bold btn btn-info btn-sm']) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-sync fa-xs"></i> REFRESH DATA'), 
		['controller' => 'logistics', 'action' => 'index'], 
		['escape' => false, 'class' => 'fs-10 bold btn btn-info btn-sm']) ?>
	
		<?= $this->Html->link(__('<i class="fa fa-user fa-xs"></i> VENDOR'), 
		['controller' => 'logistics', 'action' => 'filterproduct', "vendor"], 
		['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-info modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Logistic Monitoring by vendor',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		<?= $this->Html->link(__('<i class="fa fa-info-circle fa-xs"></i> STATUS'), 
		['controller' => 'logistics', 'action' => 'filterproduct', "status"], 
		['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-info modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Logistic Monitoring by Status',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		<?= $this->Html->link('<i class="fa fa-school fa-xs"></i> SCHOOL', 
		['controller' => 'logistics', 'action' => 'filterproduct', "school"], 
		['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-info modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Logistic Monitoring by School',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		
		<?= $this->Html->link('<i class="fa fa-home fa-xs"></i> WAREHOUSE', 
		['controller' => 'logistics', 'action' => 'filterproduct', "warehouse"], 
		['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-info modal_view_sub btn-sm', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
			'title' => 'Filter Logistic Monitoring by Warehouse',
			'note' => 'Please select from the dropdown below'
		],
			
		) ?>
		
		
		<?= $this->Html->link(__('<i class="fa fa-box"></i> INVENTORY'), 
		['controller' => 'schoolitems', 'action' => 'index'], 
		['escape' => false, 'class' => 'fs-10 bold btn btn-info btn-sm noradius modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
			'title' => 'School Inventory',
			'note' => ''
		],
			
		) ?>
		
		</div>
		
    </div>
	<div class="card-body m-b-50">
		<div class="row">
			<div class="col-md-10 nopadding-right">
				<div class="card shadow h-100 py-2 noradius">
					<div class="card-body">
						<div class="table-responsive">
						<?php echo $this->Form->create(); ?>
						   <table class="table table-condensed table-striped" id="p_table" width="100%" cellspacing="0">
								<thead>
									<tr>
										
										<th>LOGISTIC STATUS</th>
										
									</tr>
								</thead>
								
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<div class="fs-12 bold">PACKAGE COUNTER</div>
				
				<div class="row m-t-20">
					<?php 
						$for_packaging = $this->cell('Distribution::displaystatus', [1, 'For Picked-up from vendor', 'qrcode'], ['cache' => false]);

						echo $for_packaging; 
						
						
						
						$for_pickup = $this->cell('Distribution::displaystatus', [2, 'In-Transit', 'shipping-fast'], ['cache' => false]);

						echo $for_pickup; 
						
						$for_delivery = $this->cell('Distribution::displaystatus', [4, 'Received By Warehouse', 'home'], ['cache' => false]);

						echo $for_delivery; 
						
						$for_packaging = $this->cell('Distribution::displaystatus', [9, 'For Picked-up from warehouse', 'qrcode'], ['cache' => false]);

						echo $for_packaging; 
						
						
						$in_transit = $this->cell('Distribution::displaystatus', [3, 'Received By School', 'school'], ['cache' => false]);

						echo $in_transit; 
						
						//$total_2021 = $this->cell('Distribution::displaytotal', [ date('Y').' Distribution Summary', date('Y')], ['cache' => false]);

						//echo $total_2021; 
						
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
	echo $this->Html->script('table/logistic_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/logistic', ['block' => 'scriptBottom']);	
	
	echo $this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'showIndexTable("#p_table", getTheWebroot()  + "logistics/indexajax/")';
		
	echo $this->Html->scriptEnd();
	
?>

