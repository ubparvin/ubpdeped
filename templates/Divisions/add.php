<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($division, [
					'url' => [
						'controller' => 'divisions',
						'action' => 'saveajax'
					],
					'class' => 'user',
					'id' => 'default_form'
				]) ?>
				
	
				<div class="text-left">
                    <span class="small text-info bold fs-11">DIVISION INFORMATION</span>
                </div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
						 <?php echo $this->Form->control('regCode', 
							['label' => 'Region <span class="m-l-2 text-info">*</span>', 
							'empty' => '-Choose',
							'escape' => false, 'options' => $regions, 'class' => 'loc_region noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
						<?php echo $this->Form->control('name', 
							['label' => 'Division / Name  <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
						 <?php echo $this->Form->control('sds', 
							['label' => 'Schools Division Superintendent <span class="m-l-2 text-info">*</span>', 
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
						<?php echo $this->Form->control('asds', 
							['label' => 'Assistant Schools Division Superintendent/s <span class="m-l-2 text-info">*</span>', 
							'cols' => 4,
							'escape' => false,  'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
						<?php echo $this->Form->control('hqco', 
							['label' => 'Headquarters & Contact Numbers <span class="m-l-2 text-info">*</span>', 
							'cols' => 4,
							'escape' => false,'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
						<?php echo $this->Form->control('supply_officer', 
							['label' => 'Regional/Division Supply Officer <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-right">
						<?php echo $this->Form->control('contact_no', 
							['label' => 'Contact no. <span class="m-l-2 text-info">*</span>', 
							'escape' => false, 'class' => 'contact_no noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('email', 
							['label' => 'Email <span class="m-l-2 text-info">*</span>', 
							'escape' => false,  'class' => 'email noradius form-control']
						); ?>
						</div>
						
					</div>
				</div>
				
				
				
				<?= $this->Form->button(__('Create'), [
					'type' => 'button',
					'form' => '#default_form',
					'id'	=> 'btnsubmit',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'divisions', 'action' => 'saveajax']),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>


