
		
			<div class="col-lg-12 col-md-12">
						<?= $this->Form->create($user, [
							'url' => [
								'controller' => 'users',
								'action' => 'index'
							],
							'id' => 'filter_form',
							//'method' => 'get'
						]) ?>
						
			
					<div class="text-left">
							<span class="small text-danger bold fs-11">PROVIDE THE FILTER DETAILS</span>
						</div>
						<div class="form-group">
							<div class="row">
								
								<?php echo $this->Form->input('type', array('default' => 'filter', 'type' => 'hidden')); ?>
								
								<div class="col-md-12">
								 <?php echo $this->Form->control('group_id', 
									['label' => 'Group <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $groups,
									'id'		=> 'group_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								
								
								<div class="col-md-12">
								 <?php echo $this->Form->control('courier_id', 
									['label' 	=> 'Courier <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'id'		=> 'courier_id',
									'options' 	=> $couriers,
									'escape' 	=> false, 
									'class' => 'allcaps noradius form-control']
								); ?>
								</div>

								
								
							</div>
						</div>
						
						
						<?= $this->Form->button(__('Create Filter'), [
							'type' => 'button',
							'form' => '#filter_form',
							'id'	=> 'btnfilter',
							'action' => 'new',
							'url'	=> $this->Url->build(['controller' => 'products', 'action' => 'saveajax']),
							'class' => 'btn btn-success pull-right m-t-30 m-b-30'
						]) ?>
						
						<?= $this->Form->end() ?>
			</div>
	


