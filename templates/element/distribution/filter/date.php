
		
			<div class="col-lg-12 col-md-12">
						<?= $this->Form->create($product, [
							'url' => [
								'controller' => 'products',
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
								<?php echo $this->Form->input('filter_type', array('default' => 'date', 'id' => 'filter_type', 'type' => 'hidden')); ?>
								
								<div class="col-md-6 nopadding-right">
								 <?php echo $this->Form->control('d_from', 
									['label' => 'FROM <span class="m-l-2 text-danger">*</span>', 
									'type' =>'date',
									'id'	 => 'date_from',
									'escape' => false, 'class' => 'noradius form-control']
								); ?>
								</div>
								<div class="col-md-6 nopadding-left">
								 <?php echo $this->Form->control('d_from', 
									['label' => 'UNTIL <span class="m-l-2 text-danger">*</span>', 
									'type' =>'date',
									'id'	 => 'date_to',
									'escape' => false, 'class' => 'noradius form-control']
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
	


