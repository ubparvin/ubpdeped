<div class="row">
	<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($request, [
					'url' => [
						'controller' => 'requests',
						'action' => 'saveajax'
					],
					'class' => 'requests',
					'id' => 'product_form'
				]) ?>

			
				
					<div class="card mb-4 noradius">
						<div class="card bg-default text-black disabled shadow noborder noradius">
							
							<div class="card-body fs-11 bold">
								<div class="row">
								<div class="col-md-2 nopadding-right">NAME</div>
								<div class="col-md-10 nopadding-left">
									<?php echo $user['firstname'].' '.$user['lastname']; ?>
									<i class="fa fa-user-circle pull-right fa-lg" title="Requestor Information"></i>
								</div>
								
								<div class="col-md-2 nopadding-right">MOBILE NO</div>
								<div class="col-md-10 nopadding-left"><?php echo $user['mobile_no']; ?></div>
								
								<div class="col-md-2 nopadding-right">EMAIL</div>
								<div class="col-md-10 nopadding-left"><?php echo $user['email']; ?></div>
								
								</div>
							</div>
						</div>
					</div>
					
				
				<div class="form-group">
					<div class="row">
	
							
						
						
						<div class="col-md-12">
							 <?php echo $this->Form->control('school', [
								'label' => false,
								'rows' => 1,
								'placeholder' => 'Requesting School *',
								'escape' => false, 'class' => 'allcaps noborder noradius form-control'
								]);
							 ?>
							<span class="fs-9 text-warning">Put N/A if not applicable</span>
						</div>
						
						<div class="col-md-12">
							  <?php echo $this->Form->control('office', [
								'label' => false,
								'rows' => 1,
								'placeholder' => 'Requesting Office *',
								'escape' => false, 'class' => 'allcaps noborder noradius form-control'
								]);
							 ?>
							<span class="fs-9 text-warning">Put N/A if not applicable</span>
						</div>
						
						<div class="col-md-12">
							 <?php echo $this->Form->control('delivery_address', [
								'label' => false,
								'rows' => 2,
								'placeholder' => 'Delivery Address *',
								'escape' => false, 'class' => 'allcaps noborder noradius form-control'
								]);
							 ?>
							
						</div>
						
						
						
						<div class="col-md-12 m-t-20 text-left">
							 <div class="small text-warning bold fs-11">QUANTITY & ITEM SPECIFICATIONS <span class="m-l-2 text-danger">*</span></div>
							 <hr>
						</div>
						
						<div class="col-md-12">
							
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
										<input type="text" name="item[]" class="noborder form-control noradius allcaps" placeholder="Item / Description" />
									  </div>
								  </div>
								  
							  </div>
							 <button class="m-t-10 btn btn-default pull-right fs-9 bold" id="add_more"><i class="fa fa-plus-circle"></i> ADD MORE </button>
							  
						 
						</div>
						<div class="col-md-12 m-t-5">
							  <?php echo $this->Form->control('note', [
								'label' => false,
								'rows' => 2,
								'placeholder' => 'Note / Other Details *',
								'escape' => false, 'class' => 'allcaps noborder noradius form-control'
								]);
							 ?>
							
							<span class="fs-9 text-warning">Put N/A if not applicable</span>
						</div>
						
						
					</div>
				</div>
				
				
				<?= $this->Form->button(__('Submit'), [
					'type' => 'button',
					'form' => '#product_form',
					'id'	=> 'btnpro',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'requests', 'action' => 'saveajax']),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
</div>


