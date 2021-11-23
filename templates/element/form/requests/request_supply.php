<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($product, [
					'url' => [
						'controller' => 'products',
						'action' => 'saveajax'
					],
					'class' => 'products',
					'id' => 'product_form'
				]) ?>
				
	
				<div class="text-left">
                    <span class="small text-warning bold fs-11">SUPPLIER & PAYMENT INFORMATION</span>
                </div>
				<div class="form-group">
					<div class="row">
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('vendor_id', 
							['label' => 'Supplier / Vendor <span class="m-l-2 text-danger">*</span>', 
							'empty' => '-- Choose --',
							'options' => $vendors,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
							
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('receiver_address', 
							['label' => 'Delivery Address', 
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-4 nopadding-right">
						 <?php echo $this->Form->control('payment_type', 
							['label' => 'Payment Type <span class="m-l-2 text-danger">*</span>', 
							'options' => $payment_types,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>

						<div class="col-md-4 nopadding">
						 <?php echo $this->Form->control('payment_term', 
							['label' => 'Payment Status <span class="m-l-2 text-danger">*</span>', 
							'options' => $payment_terms,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-4 nopadding-left">
						 <?php echo $this->Form->control('payment_status', 
							['label' => 'Payment Status <span class="m-l-2 text-danger">*</span>', 
							'options' => $payment_status,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-4 nopadding-right">
						 <?php echo $this->Form->control('status', 
							['label' => 'PACKAGE STATUS <span class="m-l-2 text-danger">*</span>',
							'options' => array("FOR PACKAGING"),
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-4 nopadding-left">
						 <?php echo $this->Form->control('order_status', 
							['label' => 'ORDER STATUS <span class="m-l-2 text-danger">*</span>', 
							'options' => array("APPROVED"),
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						
					</div>
				</div>
				<div class="text-left">
							 <div class="small text-warning bold fs-11">QUANTITY & ITEM SPECIFICATIONS <span class="m-l-2 text-danger">*</span></div>
							 <hr>
						</div>
						
						<div class="col-md-12 nopadding">
							
							   <div class="items">
							   
								  <div class="row m-b-5">
									  <div class="col-md-3 nopadding-right qty_wrapper">
											
												
												<div class="row">
													<div class="col-md-6 nopadding-right">
														<input type="text" value="1" name="qty[]" maxlength="6" class="numbers_only noborder qty input-group-item form-control noradius" />
														
													</div>
													<div class="col-md-6 nopadding">
														<div class="btn-group m-t-1">
															<button type="button" class=" btn btn-default noradius dec"><i class="fa fa-minus-circle"></i></button>
															
															<button type="button" class="  btn btn-default noradius inc"><i class="fa fa-plus-circle"></i></button>
														
														</div>
													</div>
												</div>
											
									  </div>
									  <div class="col-md-2 nopadding">
										 <select name="type[]" class="noborder form-control noradius">
											<?php echo $this->element('form/requests/item_measurement'); ?>
										 </select>
										
										</div>
									
									  <div class="col-md-7 nopadding-left">
										<select name="item[]" class="noborder form-control noradius">
											<?php echo $this->element('form/requests/item_list', ['items' => $products]); ?>
										 </select>
									  </div>
								  </div>
								  
							  </div>
							 <button class="m-t-10 btn btn-default pull-right fs-9 bold" id="add_more"><i class="fa fa-plus-circle"></i> ADD MORE </button>
							  
						 
						</div>
				<div class="clear"></div>
				<div class="text-left">
                    <span class="small text-warning bold fs-11">AMOUNT DUE & DISCOUNT</span>
                </div>
				<div class="form-group">
					<div class="row">
						
						
						<div class="col-md-4 nopadding-right">
						 <?php echo $this->Form->control('total_amount', 
							['label' => 'Total Amount', 
							'escape' => false, 'class' => 'amount noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-4 nopadding">
						 <?php echo $this->Form->control('discount', 
							['label' => 'Discount (%)', 
							'escape' => false, 'class' => 'amount noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-4 nopadding-left">
						 <?php echo $this->Form->control('amount_due', 
							['label' => 'Amount Due', 
							'escape' => false, 'class' => 'amount noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-4 nopadding-right">
						 <?php echo $this->Form->control('paid_amount', 
							['label' => 'Paid Amount', 
							'escape' => false, 'class' => 'amount noradius form-control']
						); ?>
						</div>
						
						
						<div class="col-md-4 nopadding">
						 <?php echo $this->Form->control('balance', 
							['label' => 'Balance <span class="m-l-2 text-danger">*</span>',
							'escape' => false, 'class' => 'amount noradius form-control']
						); ?>
						</div>
						
						
						
					</div>
				</div>
				
				<?= $this->Form->button(__('Create'), [
					'type' => 'button',
					'form' => '#product_form',
					'id'	=> 'btnpro',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'products', 'action' => 'saveajax']),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>


