
		
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
								<?php echo $this->Form->input('filter_type', array('default' => 'item', 'id' => 'filter_type', 'type' => 'hidden')); ?>
								
								<div class="col-md-12">
								 <?php echo $this->Form->control('program_id', 
									['label' => 'Program <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $params[0],
									'id'		=> 'program_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								
								
								<div class="col-md-12 nodisplay">
								 <?php echo $this->Form->control('category_id', 
									['label' 	=> 'Category <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'id'		=> 'category_id',
									'options' 	=> $params[1],
									'escape' 	=> false, 
									'class' => 'allcaps noradius form-control']
								); ?>
								</div>

								
								
								<div class="col-md-12 nodisplay">
								 <?php echo $this->Form->control('vendor_id', 
									['label' => 'Supplier / Vendor <span class="m-l-2 text-danger">*</span>',
									'empty' 	=> '-- ALL --',
									'id'		=> 'vendor_id',
									'options' => $params[2],
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-12 nodisplay">
								 <?php echo $this->Form->control('tagging_id', 
									['label' => 'Tagging <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $params[3],
									'id'	=> 'tagging_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-12 nodisplay">
								 <?php echo $this->Form->control('subcategory_id', 
									['label' => 'Sub-Category <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $params[4],
									'id'		=> 'subcategory_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
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
	


