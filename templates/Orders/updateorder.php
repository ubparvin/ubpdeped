<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h5 class="bold">PURCHASE ORDER</h5>
		
		<?= $this->Form->create($order, [
							'url' => [
								'controller' => 'orders',
								'action' => 'saveajax'
							],
							'class' => 'orders',
							'id' => 'order_form'
						]) ?>
						
		<div class="row">
			
						
						
						
						<div class="col-lg-7 nopadding">
							<div class="card mb-4 noradius">
								<div class="col-md-12">
								
									<div class="text-left">
										<span class="small text-warning bold fs-11">ITEM INFORMATION</span>
									</div>
									<div class="form-group">
										<table class="table table-condensed">
											<thead>
												<tr class="fs-11 text-success">
													<th>ITEM</th>
													<th width="15%">QTY</th>
													<th>PRICE</th>
													<th>AMOUNT</th>
													<th>ACTION</th>
												</tr>
											</thead>
											<tbody>
											<?php if(!empty($items)): ?>
												<?php foreach($items as $i): ?>
												<tr>
													<td class="fs-11 bold text-default">
														<?php echo $i['name']; ?>
														
														<input type="hidden" name="item[]" value="<?php echo $i['id']; ?>" />
													</td>
													<td>
														<input type="text" p-id="<?php echo $i['id']; ?>" class="qty qty_<?php echo $i['id']; ?> form-control numbers_only noradius noborder" name="qty[]" value="<?php echo $i['qty']; ?>" />
														<div class="bold fs-11 text-warning m-t-5"><?php echo $i['tagging']; ?></div>
													</td>
													<td>
														<input type="text" p-id="<?php echo $i['id']; ?>" class="price price_<?php echo $i['id']; ?> form-control amount noradius noborder" name="price[]" value="<?php echo $i['price']; ?>" />
													</td>
													<td>
														<input type="text" p-id="<?php echo $i['id']; ?>" class="amount amount_<?php echo $i['id']; ?> form-control amount noradius noborder" name="total_price[]" value="<?php echo $i['total_price']; ?>" />
													</td>
													<td>
														<button class="btn btn-xs btn-danger fs-10 bold noradius noborder"><i class="fa fa-trash"></i></button>
													</td>
												</tr>
												<?php endforeach; ?>
											<?php endif; ?>
											<tbody>
										</table>
										
									</div>
									
									
								</div>
							</div>
						</div>
						
						<div class="col-lg-5 nopadding-right">
							<div class="card mb-4 noradius">
								<div class="col-md-12">
								
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
											'rows' => 2,
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
									<span class="small text-warning bold fs-11">AMOUNT DUE & DISCOUNT</span>
								</div>
								<div class="form-group">
									<div class="row">
										
										
										<div class="col-md-4 nopadding-right">
										 <?php echo $this->Form->control('total_amount', 
											['label' => 'Total Amount', 
											'type' => 'money',
											'escape' => false, 'class' => 'amount noradius form-control']
										); ?>
										</div>
										
										<div class="col-md-4 nopadding">
										 <?php echo $this->Form->control('discount', 
											['label' => 'Discount (%)',
											'type' => 'money',
											'escape' => false, 'class' => 'amount noradius form-control']
										); ?>
										</div>
										
										<div class="col-md-4 nopadding-left">
										 <?php echo $this->Form->control('amount_due', 
											['label' => 'Amount Due', 
											'type' => 'money',
											'escape' => false, 'class' => 'amount noradius form-control']
										); ?>
										</div>
										
										<div class="col-md-4 nopadding-right">
										 <?php echo $this->Form->control('paid_amount', 
											['label' => 'Paid Amount', 
											'type' => 'money',
											'escape' => false, 'class' => 'amount noradius form-control']
										); ?>
										</div>
										
										
										<div class="col-md-4 nopadding">
										 <?php echo $this->Form->control('balance', 
											['label' => 'Balance <span class="m-l-2 text-danger">*</span>',
											'type' => 'money',
											'escape' => false, 'class' => 'amount noradius form-control']
										); ?>
										</div>
										
										
										
									</div>
								</div>
								
								
								
								</div>
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


<?php 
	
	echo $this->Html->script('admin/controller/order_po', ['block' => 'scriptBottom']);	
	echo $this->Html->scriptStart(['block' => 'scriptBottom']);
		echo 'inputMasking();';
	echo $this->Html->scriptEnd();
?>
