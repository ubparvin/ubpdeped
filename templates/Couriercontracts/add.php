<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($couriercontract, [
					'url' => [
						'controller' => 'couriercontracts',
						'action' => 'saveajax'
					],
					'class' => 'user',
					'id' => 'default_form'
				]) ?>
				
	
				
				<div class="text-left">
                    <span class="small text-info bold fs-11">CONTRACT INFORMATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
						 <?php echo $this->Form->control('name', 
							['label' => 'Name <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						<div class="col-md-12">
						 <?php echo $this->Form->control('description', 
							['label' => 'Description <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('level', 
							['label' => 'Grade Level <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						
						
						<div class="col-md-3 nopadding">
						 <?php echo $this->Form->control('program_id', 
							['label' => 'Select Program <span class="m-l-2 text-info">*</span>', 
							'options' => $programs,
							'empty' => false,
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						
						<div class="col-md-3 nopadding-left">
						 <?php echo $this->Form->control('contract_year', 
							['label' => 'Contract Year <span class="m-l-2 text-info">*</span>', 
							'type' => 'year',
							'empty' => false,
							'default' => date('Y'),
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('vendor_id', 
							['label' => 'Select Vendor / Supplier <span class="m-l-2 text-info">*</span>', 
							'options' => $vendors,
							'empty' => 'N/A',
							'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
						); ?>
						</div>
						
						
					
					</div>
				</div>
				
				
				
				
				
				
				
				<?= $this->Form->button(__('Create'), [
					'type' => 'button',
					'form' => '#default_form',
					'id'	=> 'btnsubmit',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'couriercontracts', 'action' => 'saveajax']),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>
