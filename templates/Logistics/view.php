<div class="row">	
	
	<div class="col-md-12">
			
			<div class="bold text-default nodisplay">
				<div class="row">
					<div class="col-md-11">
						
					</div>
					<div class="col-md-1">
						<button class="btn btn-default btn-xs pull-right"><i class="fa fa-print f-a-lg"></i></button>
					</div>
				</div>
				
			
			</div>
		
			<div class="row">
				<div class="col-md-4 nopadding-right text-center">
					
					<?php
							
							
							
							echo $this->element('qrcode', [
								'details' => $logistic->qrcode]);
								
							
							 
						?>
					
				</div>
				<div class="col-md-8">
					

				<ul class="list-group noradius noborder m-b-20">
					<li class="list-group-item">
						<div class="fs-9 bold text-success">CODE</div>
						<div class="fs-16 bold text-default">
							<?php echo strtoupper($logistic->qrcode); ?>
						</div>
					</li>
					<li class="list-group-item">
						<div class="fs-9 bold text-success">VENDOR</div>
						<div class="fs-16 bold text-default">
							<?php echo $logistic->vendor->name; ?>
						</div>
					</li>
					<li class="list-group-item">
						<div class="fs-9 bold text-success">INSPECTION PERSONNEL (PA)</div>
						<div class="fs-14 bold text-default">
						<?php 
							$auth = $logistic->pa_inspector;
							
							if(!empty($auth)){
								$i_author = $this->cell('Common::authorname', [$auth], ['cache' => false]);
								echo $i_author;
							}else{
								echo " - ";
							}
							
						?>
							
						
							
						</div>
						<div class="fs-10 m-t-10 bold text-info">DATE/TIME : <?php echo $logistic->inspect_date; ?> </div>
					</li>
					<li class="list-group-item">
						<div class="fs-9 bold text-success">IN-TRANSIT (PA)</div>
						<div class="fs-14 bold text-default">
						<?php 
							$auth = $logistic->pa_transit;
							if(!empty($auth)){
								$i_author = $this->cell('Common::authorname', [$auth], ['cache' => false]);
								echo $i_author;
							}else{
								echo " - ";
							}
						?>
							
						
							
						</div>
						<div class="fs-10 m-t-10 bold text-info">DATE/TIME : <?php echo $logistic->transit_date; ?> </div>
					</li>
					<li class="list-group-item">
						<div class="fs-9 bold text-success">RECEIVED BY SCHOOL (PA)</div>
						<div class="fs-14 bold text-default">
						<?php 
							$auth = $logistic->pa_school;
							if(!empty($auth)){
								$i_author = $this->cell('Common::authorname', [$auth], ['cache' => false]);
								echo $i_author;
							}else{
								echo " - ";
							}
						?>
							
						
							
						</div>
						<div class="fs-12 bold text-default"><?php echo $logistic->school->name; ?> </div>
						<div class="fs-10 m-t-10 bold text-info">DATE/TIME : <?php echo $logistic->sreceived_date; ?> </div>
					</li>
					<li class="list-group-item">
						<div class="fs-9 bold text-success">RECEIVED BY WAREHOUSE (PA)</div>
						<div class="fs-14 bold text-default">
						<?php 
							$auth = $logistic->pa_warehouse;
							if(!empty($auth)){
								$i_author = $this->cell('Common::authorname', [$auth], ['cache' => false]);
								echo $i_author;
							}else{
								echo " - ";
							}
						?>
							
						
							
						</div>
						<div class="fs-12 bold text-default"><?php echo $logistic->warehouse->name; ?> </div>
						<div class="fs-10 m-t-10 bold text-info">DATE/TIME : <?php echo $logistic->wreceived_date; ?> </div>
					</li>
					
					
					
				</ul>
				</div>
			</div>
	</div>
</div>