<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($office, [
					'url' => [
						'controller' => 'offices',
						'action' => 'saveajax'
					],
					'class' => 'user',
					'id' => 'default_form'
				]) ?>
				
	
				<div class="text-left">
                    <span class="small text-danger bold fs-11">OFFICE INFORMATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
						 <?php echo $this->Form->control('name', 
							['label' => 'Name <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius allcaps form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('contact_person', 
							['label' => 'Contact Person <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius letters_only form-control']
						); ?>
						</div>
						<div class="col-md-3 nopadding">
						 <?php echo $this->Form->control('mobile_no', 
							['label' => 'Mobile No. <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius numbers_only form-control']
						); ?>
						</div>
						<div class="col-md-3 nopadding-left">
						 <?php echo $this->Form->control('tel_no', 
							['label' => 'Tel. No. <span class="m-l-2 text-danger">*</span>', 
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
						 <?php echo $this->Form->control('regCode', 
							['label' => 'Region <span class="m-l-2 text-danger">*</span>', 
							'empty' => '--Choose',
							'escape' => false, 'options' => $regions, 'class' => 'loc_region noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('provCode', 
							['label' => 'Province <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $provinces, 'class' => 'loc_province noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('citymunCode', 
							['label' => 'City <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $cities, 'class' => 'loc_city noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('brgyCode', 
							['label' => 'Barangay <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $barangays, 'class' => 'loc_barangay noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->control('sitio', 
								['label' => 'Sub Division / Lot No. / Street Name <span class="m-l-2 text-danger">*</span>', 
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
				
				
				
				<?= $this->Form->button(__('Create'), [
					'type' => 'button',
					'form' => '#default_form',
					'id'	=> 'btnsubmit',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'offices', 'action' => 'saveajax']),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>
