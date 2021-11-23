<div class="row">
	<div class="col-md-3 nopadding-right">
		<?php
			$details = array(
				'id' 	=> $distribution->id,
				'refid'	=> $distribution->refid
			);
			
			$details = base64_encode(json_encode($details));
			echo $this->element('qrcode', [
				'details' => $details]);
				
			
			//echo $this->Html->image('qrcode.png', ['class' => 'img-responsive']); 
		?>
	

		<div class="text-center m-t-20">
			<button class="btn btn-default btn-xs"><i class="fa fa-print f-a-lg"></i></button>
			<button class="btn btn-default btn-xs"><i class="fa fa-info f-a-lg"></i></button>
			<button class="btn btn-default btn-xs"><i class="fa fa-user-circle f-a-lg"></i></button>
		</div>
	</div>
	<div class="col-md-9">
			
			<div class="bold text-default">
				<?php echo $distribution->distributionitems[0]->product->name; ?>
				<div class="text-left fs-9 text-success bold">
					<i class="fa fa-map-marker f-a-lg"></i> <?php echo $distribution->diststaging->description; ?>
				</div>
			</div>
			<hr>
			<div class="text-warning fs-11 bold">SUB-ITEM: <?php echo $distribution->distributionitems[0]->product->subname; ?></div>
			<div class="text-warning fs-11 bold">CATEGORY: <?php echo $distribution->distributionitems[0]->product->category->name; ?></div>
			<div class="text-warning fs-11 bold">SUB-CATEGORY: <?php echo $distribution->distributionitems[0]->product->subcategory->name; ?></div>
	

			<ul class="list-group noradius noborder m-t-20 m-b-50">
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-6 nopadding">
							<div class="fs-9 bold text-success">PROGRAM</div>
							<div class="fs-20 bold text-default">
								<?php echo $distribution->distributionitems[0]->program->name; ?>
							</div>
						</div>
						<div class="col-md-6 nopadding">
							<div class="fs-9 bold text-success">QUANTITY TO DELIVER</div>
							<div class="fs-20 bold text-default">
								<?php echo $distribution->distributionitems[0]->qty; ?>
								( <?php echo $distribution->distributionitems[0]->product->tagging->name; ?> )
							</div>
						</div>
					</div>
				</li>
				
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-12 nopadding">
							<div class="fs-9 bold text-success">SCHOOL / BRANCH</div>
							<div class="fs-16 bold text-default">
								<?php echo $distribution->school->name; ?>
							</div>
						</div>
						
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-12 nopadding">
							<div class="fs-9 bold text-success">ADDRESS</div>
							<div class="fs-16 bold text-default">
								<?php echo $distribution->address; ?>
							</div>
						</div>
						
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-12 nopadding">
							<div class="fs-9 bold text-success">EST DELIVERY</div>
							<div class="fs-16 bold text-default">
								<?php echo $distribution->est_from.' - '.$distribution->est_to; ?>
							</div>
						</div>
						
					</div>
				</li>
			</ul>
	</div>
	
</div>