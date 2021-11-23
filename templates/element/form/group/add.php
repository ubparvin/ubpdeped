<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($group, [
					'url' => [
						'controller' => 'groups',
						'action' => 'saveajax'
					],
					'class' => 'user',
					'id' => 'default_form'
				]) ?>
				
				<div class="text-left">
                    <span class="small">Name</span>
                </div>
				<div class="form-group">
					 <?php echo $this->Form->control('name', 
						['label' => false, 'class' => 'noradius letters_only form-control', 'placeholder' => 'e.g. Branch Personnel']
					); ?>
				</div>
				<div class="text-left">
                    <span class="small">Description</span>
                </div>
				
				<div class="form-group">
					 <?php echo $this->Form->control('description', 
						['label' => false, 'type' => 'textarea', 'class' => 'noradius letters_only form-control', 'placeholder' => 'e.g. Receives all the items']
					); ?>
				</div>
				<div class="text-left">
                    <span class="small">Select Group Status</span>
                </div>
				 <?php echo $this->Form->control('status', array(
					'type' => 'select',
					'label' => false,
					'options' => array('0' => 'DEACTIVATE', '1' => 'ACTIVATE'),
					'class' => 'form-control noradius'
				 )); ?>
				
				
				
				<?= $this->Form->button(__('Create'), [
					'confirm' => 'You are about to submit the information. Please click OK to confirm.',
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>