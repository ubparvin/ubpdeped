
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($programseries, [
					'url' => [
						'controller' => 'programs',
						'action' => 'saveajax'
					],
					'class' => 'programs',
					'id' => 'settings_form'
				]) ?>
				
	
				<div class="text-left">
                    <span class="small text-danger bold fs-11">PROGRAM SERIES INFORMATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('program_id', 
							['label' => 'Select Program <span class="m-l-2 text-danger">*</span>', 
							'options' => $programs, 
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('series', 
							['label' => 'Series <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('start', 
							['label' => 'Series Start <span class="m-l-2 text-danger">*</span>', 
							
							'escape' => false, 'class' => 'numbers_only noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-6 nopadding-left">
						 <?php echo $this->Form->control('end', 
							['label' => 'Series End <span class="m-l-2 text-danger">*</span>', 
							
							'escape' => false, 'class' => 'numbers_only noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('date_start', 
							['label' => 'Date Start <span class="m-l-2 text-danger">*</span>', 
							'type' => date,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-6 nopadding-left">
						 <?php echo $this->Form->control('date_end', 

							['label' => 'Date End <span class="m-l-2 text-danger">*</span>', 
							'type' => date,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						

						<div class="col-md-12">
						 <?php echo $this->Form->control('status', 
							['label' => 'Status <span class="m-l-2 text-danger">*</span>', 
							'options' => ['ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE'],
							'escape' => false, 'class' => 'stat allcaps noradius form-control']
						); ?>
						</div>
						
						<?php echo $this->Form->hidden('table', array('class' => 'table')); ?>
						<?php echo $this->Form->hidden('controller', array('class' => 'controller')); ?>
						
					</div>
				</div>
				
				
				<?= $this->Form->button(__('Create'), [
					'type' => 'button',
					'form' => '#settings_form',
					'id'	=> 'btnsettings',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'programseries', 'action' => 'saveajax']),
					'class' => 'btn btn-success pull-right m-t-30 m-b-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>



