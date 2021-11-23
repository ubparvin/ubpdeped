
			
						
			<div class="col-lg-12 col-md-12 nopadding">
						
						
				<?= $this->Form->create($product, [
							'url' => [
								'controller' => 'transactions',
								'action' => 'editajax', $product->id, $product->refid
							],
							'id' => 'receive_form',
							//'method' => 'get'
					]) ?>
							
					
						<div class="form-group">
							<div class="row">
								
								<div class="col-md-4">
										<?php
											$image = $product->productimage->file;
											
											if(!empty($image)){
												$image = $img_dir . $image.'.webp';
											}else{
												$image =  $img_dir . 'no_image.jpg';
											}
												   
										?>

										<img src="<?php echo $image; ?>" class="img-responsive" />
										
										
								</div>
								<div class="col-md-8">
									<div class="bold m-b-20"><?php echo $product->name; ?></div>
									
									<div class="text-default fs-11 bold">SUB-ITEM: <?php echo $product->subname; ?></div>
									<div class="text-default fs-11 bold">PROGRAM: <?php echo $product->program->name; ?></div>
									<div class="text-default fs-11 bold">CATEGORY: <?php echo $product->category->name; ?></div>
									<div class="text-default fs-11 bold">SUB-CATEGORY: <?php echo $product->subcategory->name; ?></div>
									
								</div>
							</div>
								<hr>
							<div class="row">
								
								
								<div class="col-md-12">
									
									<div class="row m-b-40 m-t-20">
										<div class="col-md-4">
											
											<?php
												/*$details = array(
													'id' 	=> $product->id,
													'refid'	=> $product->refid
												);
												
												$details = base64_encode(json_encode($details));
												echo $this->element('qrcode', [
													'details' => $details]);*/
													
											?>
										</div>
										<div class="col-md-7">
											
											<div class="row">
												<div class="col-md-4 nopadding-right">
													<?php echo $this->Form->control('series', 
														['options' => $series, 'label' => 'Program Series', 'class' => 'bold noborder input-group-item fs-16 form-control noradius']
													); ?>
																
												</div>
												<div class="col-md-4 nopadding-right">
													<?php echo $this->Form->control('series_start', 
														['maxlength' => 8, 'label' => 'Start', 'class' => 'series_start bold numbers_only noborder input-group-item fs-16 form-control noradius']
													); ?>
													<div class="fs-9 text-warning">NO LEADING ZERO ( 0 )</div>			
												</div>
												<div class="col-md-4 nopadding-left">
													<?php echo $this->Form->control('series_end', 
														['maxlength' => 8, 'label' => 'End', 'class' => 'series_end bold numbers_only noborder input-group-item fs-16 form-control noradius']
													); ?>
													<div class="fs-9 text-warning">NO LEADING ZERO ( 0 )</div>						
												</div>
												
												<div class="col-md-12 m-t-20 m-b-20 text-left">
															 <div class="small text-warning bold fs-11">ITEM QUANITY</div>
															 <div class="small text-success bold fs-20"><?php echo $product->tagging->name; ?> </div>
															
														</div>
												<div class="col-md-3 nopadding-right qty_wrapper">
													<?php echo $this->Form->hidden('product_id', ['type' => 'text', 'default' => $product->id]); ?>
													
													<input type="text" value="1" name="qty" maxlength="6" class="bold numbers_only qty noborder input-group-item fs-16 form-control noradius" />								
												</div>
												<div class="col-md-3 nopadding">
													<div class="row ">
														<div class="col-md-5 nopadding-right ">
															<button type="button" class="p-b-10 p-t-10 btn btn-default fs-12 bold btn-lg noradius dec btn-block"><i class="fa fa-minus-circle"></i></button>			
														</div>
														<div class="col-md-5 nopadding-left">
															<button type="button" class="p-b-10 p-t-10 btn btn-default fs-12 bold  btn-lg noradius inc btn-block"><i class="fa fa-plus-circle"></i></button>
														</div>
													</div>
												</div>
												<div class="col-md-6">
												<?= $this->Form->button('RECEIVE ITEM', [
													'type' => 'button',
													'form' => '#receive_form',
													'id'	=> 'receive_item',
													'action' => 'new',
													'escape' => false,
													'url'	=> $this->Url->build(['controller' => 'transactions', 'action' => 'editajax', $product->id, $product->refid]),
													'class' => 'noradius btn btn-xs btn-block btn-success bold'
												]) ?>
												</div>
											</div>
										</div>
										
										<div class="clear"></div>
						
										
										
										
									</div>
												
																	
								</div>
								
								
								
							
							</div>
						</div>
						
						
					<?= $this->Form->end() ?>					
					
			</div>
			<div class="clear"></div>
			