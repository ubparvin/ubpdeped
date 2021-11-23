<div class="row">	
	<div class="col-md-4 nopadding-right">
		
		
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
			
			<div class="bold text-default">
				<div class="row">
					<div class="col-md-11">
						<?php echo $product->name; ?>
					</div>
					<div class="col-md-1">
						<button class="btn btn-default btn-xs pull-right"><i class="fa fa-print f-a-lg"></i></button>
					</div>
				</div>
				
			
			</div>
			<hr>
			<div class="row">
				<div class="col-md-2 nopadding">
					<?php
							$details = array(
								'id' 	=> $product->id,
								'refid'	=> $product->refid
							);
							
							$details = base64_encode(json_encode($details));
							echo $this->element('qrcode', [
								'details' => $details]);
								
							
							 
						?>
				</div>
				<div class="col-md-10 nopadding m-t-5">
					<div class="text-warning fs-11 bold">SUB-ITEM: <?php echo $product->subname; ?></div>
					<div class="text-warning fs-11 bold">CATEGORY: <?php echo $product->category->name; ?></div>
					<div class="text-warning fs-11 bold">SUB-CATEGORY: <?php echo $product->subcategory->name; ?></div>
					
				</div>
				
			</div>

			<ul class="list-group noradius noborder m-t-20 m-b-50">
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-3 nopadding">
							<div class="fs-9 bold text-success">PROGRAM</div>
							<div class="fs-20 bold text-default">
								<?php echo $product->program->name; ?>
							</div>
						</div>
						<div class="col-md-3 nopadding">
							<div class="fs-9 bold text-success">TOTAL QUANTITY</div>
							<div class="fs-20 bold text-default">
								<?php echo $product->qty; ?>

							</div>
						</div>
						<div class="col-md-3 nopadding">
							<div class="fs-9 bold text-success">AVAILABLE</div>
							<div class="fs-20 bold text-default">
								
								<?php echo $product->on_hand; ?> 
								<div class="fs-10 bold">
									<?php echo $product->tagging->name; ?>
								
								</div>
							</div>
						</div>
						<div class="col-md-3 nopadding">
							<div class="fs-9 bold text-success">WITH DEFECT</div>
							<div class="fs-20 bold text-default">
								
								<?php echo $product->has_defect; ?>
							</div>
						</div>
					</div>
				</li>
				
				
				
			</ul>
	</div>
</div>