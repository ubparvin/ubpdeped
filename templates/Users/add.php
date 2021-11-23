<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($user, [
					'url' => [
						'controller' => 'users',
						'action' => 'saveajax'
					],
					'class' => 'user',
					'id' => 'default_form'
				]) ?>
				
	
				<div class="text-left">
                    <span class="small text-info bold fs-11">ACCESS INFORMATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
						 <?php echo $this->Form->control('group_id', 
							['label' => 'Select Group <span class="m-l-2 text-info">*</span>', 
							'options' => $groups,
							'escape' => false, 'class' => 'noradius form-control']
						); ?>
						</div>
						
						
					</div>
				</div>
				
				
				<div class="text-left">
                    <span class="small text-info bold fs-11">PERSONAL INFORMATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4 nopadding-right">
						 <?php echo $this->Form->control('firstname', 
							['label' => 'Given Name <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						<div class="col-md-4 nopadding">
						 <?php echo $this->Form->control('middlename', 
							['label' => 'Middle Name <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						
						<div class="col-md-4 nopadding-left">
						 <?php echo $this->Form->control('lastname', 
							['label' => 'Last Name <span class="m-l-2 text-info">*</span>', 
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
						 <?php echo $this->Form->control('birthdate', 
							['label' => 'Date of Birth <span class="m-l-2 text-info">*</span>', 
							'type' => 'date',
							'escape' => false, 'class' => 'noradius date form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						 <?php echo $this->Form->control('email', 
							['label' => 'Email <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'noradius tel_no form-control']
						); ?>
						</div>
					</div>
				</div>
				
				
				<div class="text-left">
                    <span class="small text-info bold fs-11">COMPLETE ADDRESS</span>
                </div>
				
				<div class="form-group">
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
				
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
						 <?php echo $this->Form->control('school_id', 
							['label' => 'SCHOOL <span class="m-l-2 text-info">*</span>', 
							'empty' => '--Choose--',
							'escape' => false, 'class' => 'noradius form-control']
						); ?>
							<div class="text-danger fs-10 bold">Note: Applicable only for school custodian account</div>
						</div>
						<div class="col-md-12">
						 <?php echo $this->Form->control('warehouse_id', 
							['label' => 'WAREHOUSE <span class="m-l-2 text-info">*</span>', 
							'empty' => '--Choose--',
							'escape' => false, 'class' => 'noradius form-control']
						); ?>
							<div class="text-danger fs-10 bold">Note: Applicable only for warehouse account</div>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('courier_id', 
							['label' => 'COURIER / LOGISTIC <span class="m-l-2 text-info">*</span>', 
							'empty' => '--Choose--',
							'options' => $couriers,
							'escape' => false, 'class' => 'noradius form-control']
						); ?>
							<div class="text-danger fs-10 bold">Note: Applicable only for 3RD party logistic provider account</div>
						</div>
						
					</div>
				</div>
				
				<div class="text-left m-t-20">
                    <span class="small text-info bold fs-11">CONTACT PERSON IN CASE OF EMERGENCY</span>
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-8 nopadding-right">
						 <?php echo $this->Form->control('emergency_name', 
							['label' => 'Name <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						<div class="col-md-4 nopadding-left">
						 <?php echo $this->Form->control('emergency_contact', 
							['label' => 'Contact No. <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'noradius contact_no form-control']
						); ?>
						</div>
						
						
					</div>
				</div>
				
				
				<?= $this->Form->button(__('Create'), [
					'type' => 'button',
					'form' => '#default_form',
					'id'	=> 'btnsubmit',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'users', 'action' => 'saveajax']),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>
