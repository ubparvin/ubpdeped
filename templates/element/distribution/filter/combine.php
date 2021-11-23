
		
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
								<?php echo $this->Form->input('filter_type', array('default' => 'combine', 'id' => 'filter_type', 'type' => 'hidden')); ?>
								
								<div class="col-md-12">
								 <?php echo $this->Form->control('regCode', 
									['label' => 'Region <span class="m-l-2 text-danger">*</span>', 
									'empty' => '-Choose',
									'escape' => false, 'options' => $params[0], 'id' => 'loc_region', 'class' => 'loc_region noradius form-control']
								); ?>
								</div>
								<div class="col-md-12">
								<?php echo $this->Form->control('provCode', 
									['label' => 'Province <span class="m-l-2 text-danger">*</span>', 
									'escape' => false, 'options' => $params[1], 'id' => 'loc_province', 'class' => 'loc_province noradius form-control']
								); ?>
								</div>
								<div class="col-md-12">
								 <?php echo $this->Form->control('citymunCode', 
									['label' => 'City <span class="m-l-2 text-danger">*</span>', 
									'escape' => false, 'options' => $params[2], 'id' => 'loc_city', 'class' => 'loc_city noradius form-control']
								); ?>
								</div>
								<div class="col-md-12">
								<?php echo $this->Form->control('brgyCode', 
									['label' => 'Barangay <span class="m-l-2 text-danger">*</span>', 
									'escape' => false, 'options' => $params[3], 'id' => 'loc_barangay', 'class' => 'loc_barangay noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-12">
								 <?php echo $this->Form->control('status', 
									['label' => 'Status <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $params[4],
									'id'		=> 'status',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-12">
								 <?php echo $this->Form->control('program_id', 
									['label' => 'Program <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $params[5],
									'id'		=> 'program_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								
								
								<div class="col-md-12 nodisplay">
								 <?php echo $this->Form->control('category_id', 
									['label' 	=> 'Category <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'id'		=> 'category_id',
									'options' 	=> $params[6],
									'escape' 	=> false, 
									'class' => 'allcaps noradius form-control']
								); ?>
								</div>

								
								
								<div class="col-md-12 nodisplay">
								 <?php echo $this->Form->control('vendor_id', 
									['label' => 'Supplier / Vendor <span class="m-l-2 text-danger">*</span>',
									'empty' 	=> '-- ALL --',
									'id'		=> 'vendor_id',
									'options' => $params[7],
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-12 nodisplay">
								 <?php echo $this->Form->control('tagging_id', 
									['label' => 'Tagging <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $params[8],
									'id'	=> 'tagging_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-12 nodisplay">
								 <?php echo $this->Form->control('subcategory_id', 
									['label' => 'Sub-Category <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $params[9],
									'id'		=> 'subcategory_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-12">
								 <?php echo $this->Form->control('school', 
									['label' => 'School <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $params[10],
									'id'		=> 'school',
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
	


