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
                    <span class="small text-danger bold fs-11">SYTEM ACCESS</span>
                </div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-8 nopadding-right">
							 <?php echo $this->Form->control('group_id', 	
								[
									'options' => $groups, 
									'label' => 'Select Group<span class="m-l-2 text-danger">*</span>', 
									'escape' => false,
									'class' => 'noradius form-control'
								]
							); ?>
						</div>
						<div class="col-md-4 nopadding-left">
							 <?php echo $this->Form->control('role_id', 	
								[
									'options' => $roles, 
									'label' => 'Select Role<span class="m-l-2 text-danger">*</span>', 
									'escape' => false,
									'class' => 'noradius form-control'
								]
							); ?>
						</div>
					</div>
				</div>
				
	
				<div class="text-left">
                    <span class="small text-danger bold fs-11">PERSONAL INFORMATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-4 nopadding-right">
						 <?php echo $this->Form->control('firstname', 
							['label' => 'Given Name <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius letters_only form-control']
						); ?>
						</div>
						<div class="col-md-4 nopadding">
						 <?php echo $this->Form->control('middlename', 
							['label' => 'Middle Name <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius letters_only form-control']
						); ?>
						</div>
						<div class="col-md-4 nopadding-left">
						 <?php echo $this->Form->control('lastname', 
							['label' => 'Last Name <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius letters_only form-control']
						); ?>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-8 nopadding-right">
						 <?php echo $this->Form->control('email', 
							['label' => 'Email <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius email form-control']
						); ?>
						</div>
						<div class="col-md-4 nopadding-left">
						 <?php echo $this->Form->control('mobile_no', 
							['label' => 'Mobile No. <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius numbers_only form-control']
						); ?>
						</div>
						
					</div>
				</div>
				
				<div class="text-left">
                    <span class="small text-danger bold fs-11">COMPLETE ADDRESS</span>
                </div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('region_id', 
							['label' => 'Region <span class="m-l-2 text-danger">*</span>', 
							'empty' => '--Choose',
							'escape' => false, 'options' => $regions, 'class' => 'loc_region noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('province_id', 
							['label' => 'Province <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $provinces, 'class' => 'loc_province noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('city_id', 
							['label' => 'City <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $cities, 'class' => 'loc_city noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('barangay_id', 
							['label' => 'Barangay <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $barangays, 'class' => 'loc_barangay noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->control('sitio', 
								['label' => 'Sub Division / Lot No. / Street Name <span class="m-l-2 text-danger">*</span>', 
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
				
				<div class="text-left">
                    <span class="small text-danger bold fs-11">CURRENT AFFILIATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('school_id', 
							['label' => 'School <span class="m-l-2 text-danger">*</span>', 
							'options' => $schools,
							'escape' => false, 'class' => 'noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						 <?php echo $this->Form->control('office_id', 
							['label' => 'Office <span class="m-l-2 text-danger">*</span>', 
							'options' => $offices,
							'escape' => false, 'class' => 'noradius form-control']
						); ?>
						</div>
						
					</div>
				</div>
			
				
				
				
				<?= $this->Form->button(__('Create'), [
					'confirm' => 'You are about to submit the information. Please click OK to confirm.',
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>