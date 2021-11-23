
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($program, [
					'url' => [
						'controller' => 'subcategories',
						'action' => 'saveajax'
					],
					'class' => 'subcategories',
					'id' => 'settings_form'
				]) ?>
				
	
				<div class="text-left">
                    <span class="small text-danger bold fs-11">SUB-CATEGORY INFORMATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('name', 
							['label' => 'Name <span class="m-l-2 text-danger">*</span>', 
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
					'url'	=> $this->Url->build(['controller' => 'subcategories', 'action' => 'saveajax']),
					'class' => 'btn btn-success pull-right m-t-30 m-b-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>



