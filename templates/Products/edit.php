<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($product, [
					'url' => [
						'controller' => 'products',
						'action' => 'editajax', $id
					],
					'class' => 'products',
					'id' => 'product_form'
				]) ?>
				
	
				<div class="text-left">
                    <span class="small text-danger bold fs-11">PRODUCT INFORMATION</span>
					<i class="nodisplay fa fa-edit fa-lg edit_btn pull-right m-t-10 bold"></i>
					<div class="clear"></div>
                </div>
				<div class="form-group">
					<div class="row">
						
						<div class="col-md-9 nopadding-right">
						 <?php echo $this->Form->control('program_id', 
							['label' => 'Select Program <span class="m-l-2 text-danger">*</span>', 
							'options' => $programs,
							'disabled' => true,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
							<span class="fs-9 text-warning">Select N/A for not applicable</span>
						</div>
						
						<div class="col-md-3 nopadding-left">
						 <?php echo $this->Form->control('sku', 
							['label' => 'SKU', 
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('category_id', 
							['label' => 'Category <span class="m-l-2 text-danger">*</span>', 
							'options' => $categories,
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
							<span class="fs-9 text-warning">Select N/A for not applicable</span>
						</div>

						<div class="col-md-12">
						 <?php echo $this->Form->control('name', 
							['label' => 'Item Name <span class="m-l-2 text-danger">*</span>', 
							'rows' => 2,
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('subname', 
							['label' => 'Sub-Item', 
							'rows' => 2,
						
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('label', 
							['label' => 'Item Label <span class="m-l-2 text-danger">*</span>',
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-9 nopadding-right">
						 <?php echo $this->Form->control('brand', 
							['label' => 'Item Brand <span class="m-l-2 text-danger">*</span>',
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-3 nopadding-left">
						 <?php echo $this->Form->control('part_number', 
							['label' => 'Part Number <span class="m-l-2 text-danger">*</span>',
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('vendor_id', 
							['label' => 'Supplier / Vendor <span class="m-l-2 text-danger">*</span>', 
							'options' => $vendors,
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
							<span class="fs-9 text-warning">Select N/A for not applicable</span>
						</div>
						
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('tagging_id', 
							['label' => 'Select Tagging <span class="m-l-2 text-danger">*</span>', 
							'options' => $taggings,
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
							<span class="fs-9 text-warning">Select N/A for not applicable</span>
						</div>
						
						<div class="col-md-6 nopadding-left">
						 <?php echo $this->Form->control('subcategory_id', 
							['label' => 'Select Sub-Category <span class="m-l-2 text-danger">*</span>', 
							'options' => $subcategories,
							
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
							<span class="fs-9 text-warning">Select N/A for not applicable</span>
						</div>
						
						
						
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('date_received', 
							['label' => 'Date Received <span class="m-l-2 text-danger">*</span>', 
							'disabled' => true,
							'escape' => false, 'class' => 'date noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-3 nopadding">
						 <?php echo $this->Form->control('expiration', 
							['label' => 'Expiration Date', 
							
							'escape' => false, 'class' => 'date noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-3 nopadding-left">
						 <?php echo $this->Form->control('warranty_expires', 
							['label' => 'Warranty Expiration', 
							
							'escape' => false, 'class' => 'date noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('note', 
							['label' => 'Note / Other Descriptions <span class="m-l-2 text-danger">*</span>', 
							'rows' => 3,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
					
						
						
					</div>
				</div>
				
				
				<?= $this->Form->button(__('Save Changes'), [
					'type' => 'button',
					'form' => '#product_form',
					'id'	=> 'btnpro',
					'action' => 'update',
					'url'	=> $this->Url->build(['controller' => 'products', 'action' => 'editajax', $id]),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>


