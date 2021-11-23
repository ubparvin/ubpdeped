
			
						
			<div class="col-lg-12 col-md-12">
						
						
				<?= $this->Form->create($product, [
							'url' => [
								'controller' => 'transactions',
								'action' => 'editajax', $product->id, $product->refid
							],
							'id' => 'release_form',
							//'method' => 'get'
					]) ?>
							
					
						<div class="form-group">
							<div class="row">
								
								
								<div class="col-md-12">
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
											<div class="bold fs-16 m-b-20"><?php echo $product->name; ?></div>
									
											<div class="text-default fs-11 bold">SUB-ITEM: <?php echo $product->subname; ?></div>
											<div class="text-default fs-11 bold">PROGRAM: <?php echo $product->program->name; ?></div>
											<div class="text-default fs-11 bold">CATEGORY: <?php echo $product->category->name; ?></div>
											<div class="text-default fs-11 bold">SUB-CATEGORY: <?php echo $product->subcategory->name; ?></div>
											
												<div class="col-md-12 nopadding m-t-10">
													 <div class="small text-warning bold fs-11">IN STOCKS</div>
													 <div class="small text-success bold fs-20"><?php echo $product->on_hand; ?> <?php echo $product->tagging->name; ?> </div>
													 
												</div>
								
										</div>	
									</div>
								</div>	
								<div class="clear"></div>
									
									
										
										
																
								
								
								
								
							
							</div>
						</div>
						
					<hr>
					<div class="form-group">
						
						<div class="row">
									<div class="col-md-6 nopadding-right">
										<span class="small text-default bold fs-11">QUANTITY TO RELEASE</span>
									</div>
									<div class="col-md-6 nopadding-left">
										<span class="small text-default bold fs-11">ESTIMATED DELIVERY</span>
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
									<div class="col-md-3 nopadding">
											<?php echo $this->Form->control('est_from', ['label' => false, 'type' => 'date', 'class' => 'form-control input-lg noradius noborder']); ?>
										
									</div>
									<div class="col-md-3 nopadding-left">
											<?php echo $this->Form->control('est_to', ['label' => false, 'type' => 'date', 'class' => 'form-control input-lg noradius noborder']); ?>
										
									</div>
						</div>
						
					</div>
					
					<div class="text-left">
						<span class="small text-danger bold fs-11">DESTINATION SCHOOL & ADDRESS</span>
					</div>
				
				<div class="form-group">
					<div class="row">
						<div class="col-md-12">
						 <?php echo $this->Form->control('school_id', 
							['label' => 'School / Branch <span class="m-l-2 text-danger">*</span>', 
							'empty' => '--Choose',
							'escape' => false, 'options' => $schools, 'class' => '= noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('regCode', 
							['label' => 'Region <span class="m-l-2 text-danger">*</span>', 
							'empty' => '--Choose',
							'escape' => false, 'options' => $regions, 'class' => 'loc_region noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('provCode', 
							['label' => 'Province <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $provinces, 'class' => 'loc_province noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-right">
						 <?php echo $this->Form->control('citymunCode', 
							['label' => 'City <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $cities, 'class' => 'loc_city noradius form-control']
						); ?>
						</div>
						<div class="col-md-6 nopadding-left">
						<?php echo $this->Form->control('brgyCode', 
							['label' => 'Barangay <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'options' => $barangays, 'class' => 'loc_barangay noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
							<?php echo $this->Form->control('sitio', 
								['label' => 'Sub Division / Lot No. / Street Name <span class="m-l-2 text-danger">*</span>', 
								'rows' => 2,
								'escape' => false, 'class' => 'sitio numbers_and_letters noradius form-control']
							); ?>
							
							<?php echo $this->Form->input('address', 
								['label' => false, 	
								'type' => 'hidden',
								'escape' => false, 'class' => 'address noradius form-control']
							); ?>
						
						</div>
					</div>
				</div>
				
				<?= $this->Form->button(__('Continue Distribution'), [
					'type' => 'button',
					'form' => '#release_form',
					'id'	=> 'release_item',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'distributions', 'action' => 'editajax', $product->id, $product->refid]),
					'class' => 'btn btn-success pull-right m-t-30'
				]) ?>
				
				<?= $this->Form->end() ?>			
					
			</div>
			<div class="clear"></div>
			