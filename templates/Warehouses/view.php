<div class="col-md-12">
	<div class="row">
			<div class="col-md-10 text-warning bold"><?php echo $warehouse->name; ?></div>
			<div class="col-md-2 text-right fs-11 bold"><?php echo $warehouse->status; ?></div>
	</div>
	<ul class="list-group noradius noborder m-t-20 m-b-50">
				
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4 nopadding">
							<div class="fs-9 bold text-success">CONTACT PERSON</div>
							<div class="fs-14 bold text-default">
								<?php echo $warehouse->contact_person; ?>
							</div>
						</div>
						<div class="col-md-4 nopadding">
							<div class="fs-9 bold text-success">CONTACT NO.</div>
							<div class="fs-14 bold text-default">
								<?php echo $warehouse->mobile_no; ?> / <?php echo $warehouse->tel_no; ?>
							</div>
						</div>
						<div class="col-md-4 nopadding">
							<div class="fs-9 bold text-success">EMAIL</div>
							<div class="fs-14 bold text-default">
								<?php echo $warehouse->email; ?>
							</div>
						</div>
						
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-12 nopadding">
							<div class="fs-9 bold text-success">ADDRESS</div>
							<div class="fs-14 bold text-default">
								<?php echo $warehouse->address; ?>
							</div>
						</div>
						
					</div>
				</li>
				
				
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-6 nopadding">
							<div class="fs-9 bold text-success">REGISTRATION</div>
							<div class="fs-14 bold text-default">
								<?php echo $warehouse->added; ?>
								<div class="fs-9 bold text-warning"><?php echo $warehouse->added_by; ?></div>
							</div>
						</div>
						<div class="col-md-6 nopadding">
							<div class="fs-9 bold text-success">UPDATE</div>
							<div class="fs-14 bold text-default">
								<?php echo $warehouse->modified; ?> 
								<div class="fs-9 bold text-warning"><?php echo $warehouse->modified_by; ?></div>
							</div>
						</div>
						
					</div>
				</li>
				
			</ul>
</div>
