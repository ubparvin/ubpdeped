
			
						
			<div class="col-lg-12 col-md-12 nopadding">
						
						
			
					<?= $this->Form->create($orders, [
							'url' => [
								'controller' => 'products',
								'action' => 'index'
							],
							'id' => 'order_form',
							//'method' => 'get'
					]) ?>
					
						<div class="form-group">
							<div class="row">
								
								<?php echo $this->Form->input('type', array('default' => 'filter', 'type' => 'hidden')); ?>
								
								<div class="col-md-4 nopadding-right">
								 <?php echo $this->Form->control('program_id', 
									['label' => 'Program <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $programs,
									'id'		=> 'program_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								
								<div class="col-md-4 nopadding">
								 <?php echo $this->Form->control('tagging_id', 
									['label' => 'Tagging <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $taggings,
									'id'	=> 'tagging_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-4 nopadding-left">
								 <?php echo $this->Form->control('subcategory_id', 
									['label' => 'Sub-Category <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'options' => $subcategories,
									'id'		=> 'subcategory_id',
									'escape' => false, 'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								
								<div class="col-md-12">
								 <?php echo $this->Form->control('category_id', 
									['label' 	=> 'Category <span class="m-l-2 text-danger">*</span>', 
									'empty' 	=> '-- ALL --',
									'id'		=> 'category_id',
									'options' 	=> $categories,
									'escape' 	=> false, 
									'class' => 'allcaps noradius form-control']
								); ?>
								</div>
								<input type="hidden" name="ids" class="ids" value="" />
							
							</div>
						</div>
						
						
						<?= $this->Form->button(__('Show Filter Results'), [
							'type' => 'button',
							'form' => '#order_form',
							'id'	=> 'show_item',
							'action' => 'new',
							'url'	=> $this->Url->build(['controller' => 'products', 'action' => 'saveajax']),
							'class' => 'btn btn-warning noradius pull-left m-b-30'
						]) ?>
						
						<?= $this->Form->button(__('Continue'), [
							'type' => 'button',
							'form' => '#order_form',
							'id'	=> 'continue_btn',
							'action' => 'new',
							'url'	=> $this->Url->build(['controller' => 'products', 'action' => 'saveajax']),
							'class' => 'btn btn-danger noradius pull-right m-b-30'
						]) ?>
						
						<?= $this->Form->end() ?>
			</div>
			<div class="clear"></div>
			<div class="item_to_show">
				 <table class="table table-condensed" id="pc_table" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>#</th>
							<th>ITEM</th>
							<th>ACTION</th>
						</tr>
					</thead>
					
				</table>
			</div>