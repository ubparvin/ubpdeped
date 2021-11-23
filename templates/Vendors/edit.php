<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($vendor, [
					'url' => [
						'controller' => 'vendors',
						'action' => 'editajax', $id
					],
					'class' => 'user',
					'id' => 'default_form'
				]) ?>
				
	
				
				<div class="text-left">
                    <span class="small text-info bold fs-11">SUPPLIER STATUS</span>
					<i class="nodisplay fa fa-edit fa-lg edit_btn pull-right bold"></i>
                </div>
				<div class="form-group">
					<div class="row">
							<div class="col-md-4">
							 <?php echo $this->Form->control('status', 
								['label' => 'Status <span class="m-l-2 text-info">*</span>', 
								'options' => array("ACTIVE" => "ACTIVE", "INACTIVE" => "INACTIVE"),
							
								'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
							); ?>
							</div>
							
							<div class="col-md-4 nopadding-right">
								<label>Registration Date</label>
								<div><?php echo (!empty($vendor->added) ? $vendor->added : "--"); ?></div>
								<div class="fs-9 bold text-warning"><?php echo  $vendor->added_by; ?></div>
								
							</div>
							
							<div class="col-md-4 nopadding-left">
								<label>Modified</label>
								<div><?php echo (!empty($vendor->modified) ? $vendor->modified : "--"); ?></div>
								<div class="fs-9 bold text-warning"><?php echo (!empty($vendor->modified_by) ? $vendor->modified_by : "--"); ?></div>
							</div>
					</div>
				</div>
				
				<div class="text-left">
                    <span class="small text-info bold fs-11">SUPPLIER INFORMATION</span>
					
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
						 <?php echo $this->Form->control('name', 
							['label' => 'Supplier/Vendor Name <span class="m-l-2 text-info">*</span>', 
							'disabled' => false,
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						<div class="col-md-12">
						 <?php echo $this->Form->control('operatedby', 
							['label' => 'Manage & Operated By <span class="m-l-2 text-info">*</span>', 
							
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
					
						<div class="col-md-3 nopadding-right">
						 <?php echo $this->Form->control('mobile_no', 
							['label' => 'Mobile No. <span class="m-l-2 text-info">*</span>', 
							
							'escape' => false, 'class' => 'noradius contact_no form-control']
						); ?>
						</div>
						<div class="col-md-3 nopadding">
						 <?php echo $this->Form->control('tel_no', 
							['label' => 'Tel. No. <span class="m-l-2 fs-8 text-warning">( Optional )</span>',
							
							'escape' => false, 'class' => 'noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-6 nopadding-left">
						 <?php echo $this->Form->control('email', 
							['label' => 'Email <span class="m-l-2 fs-8 text-warning">( Optional )</span>',
							
							'escape' => false, 'class' => 'noradius email form-control']
						); ?>
						</div>
						
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('contact_person', 
							['label' => 'Contact Person <span class="m-l-2 text-info">*</span>', 
							
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						
						<div class="col-md-3 nopadding">
						 <?php echo $this->Form->control('license_no', 
							['label' => 'License No. <span class="m-l-2 text-info">*</span>', 
							
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						<div class="col-md-3 nopadding-left">
						 <?php echo $this->Form->control('license_expires', 
							['label' => 'Expiration Date <span class="m-l-2 text-info">*</span>',
							
							'type' => date,
							'escape' => false, 'class' => 'noradius date form-control']
						); ?>
						</div>
						
					</div>
				</div>
				
				
				<div class="text-left">
                    <span class="small text-info bold fs-11">COMPLETE ADDRESS</span>
                </div>
				
				<div class="form-group m-t-10">
					<div class="row">
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('regCode', 
							['label' => 'Region <span class="m-l-2 text-info">*</span>', 
							'empty' => '--Choose',
							
							'escape' => false, 'options' => $regions, 'class' => 'loc_region noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('provCode', 
							['label' => 'Province <span class="m-l-2 text-info">*</span>', 
							
							'escape' => false, 'options' => $provinces, 'class' => 'loc_province noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('citymunCode', 
							['label' => 'City <span class="m-l-2 text-info">*</span>', 
							
							'escape' => false, 'options' => $cities, 'class' => 'loc_city noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('brgyCode', 
							['label' => 'Barangay <span class="m-l-2 text-info">*</span>', 
							
							'escape' => false, 'options' => $barangays, 'class' => 'loc_barangay noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->control('sitio', 
								['label' => 'Sub Division / Lot No. / Street Name <span class="m-l-2 text-info">*</span>', 
								'rows' => 2,
								
								'escape' => false, 'class' => 'sitio numbers_and_letters noradius form-control']
							); ?>
							
							<?php echo $this->Form->input('address', 
								['label' => false, 	
								'type' => 'hidden',
								'escape' => false, 'class' => 'address noradius form-control']
							); ?>
						
						</div>
					</div>
				</div>
				
				
				
				
				<?= $this->Form->button(__('Save Changes'), [
					'type' => 'button',
					'form' => '#default_form',
					'id'	=> 'btnsubmit',
					'action' => 'update',
					'url'	=> $this->Url->build(['controller' => 'vendors', 'action' => 'editajax', $id]),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>
