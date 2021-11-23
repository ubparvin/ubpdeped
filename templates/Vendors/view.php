<div class="col-md-12">
	<div class="row">
			<div class="col-md-10 text-warning bold"><?php echo $vendor->name; ?></div>
			<div class="col-md-2 text-right fs-11 bold"><?php echo $vendor->status; ?></div>
	</div>
	<ul class="list-group noradius noborder m-t-20 m-b-50">
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-12 nopadding">
							<div class="fs-9 bold text-success">OWNED & MANAGE BY</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->operatedby; ?>
							</div>
						</div>
						
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4 nopadding">
							<div class="fs-9 bold text-success">CONTACT PERSON</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->contact_person; ?>
							</div>
						</div>
						<div class="col-md-4 nopadding">
							<div class="fs-9 bold text-success">CONTACT NO.</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->mobile_no; ?> / <?php echo $vendor->tel_no; ?>
							</div>
						</div>
						<div class="col-md-4 nopadding">
							<div class="fs-9 bold text-success">EMAIL</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->email; ?>
							</div>
						</div>
						
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-12 nopadding">
							<div class="fs-9 bold text-success">ADDRESS</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->address; ?>
							</div>
						</div>
						
					</div>
				</li>
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-6 nopadding">
							<div class="fs-9 bold text-success">PERMIT / LICENSE</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->license_no; ?>
							</div>
						</div>
						<div class="col-md-6 nopadding">
							<div class="fs-9 bold text-success">EXPIRATAION</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->license_expires; ?> 
							</div>
						</div>
						
					</div>
				</li>
				
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-6 nopadding">
							<div class="fs-9 bold text-success">REGISTRATION</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->added; ?>
								<div class="fs-9 bold text-warning"><?php echo $vendor->added_by; ?></div>
							</div>
						</div>
						<div class="col-md-6 nopadding">
							<div class="fs-9 bold text-success">UPDATE</div>
							<div class="fs-14 bold text-default">
								<?php echo $vendor->modified; ?> 
								<div class="fs-9 bold text-warning"><?php echo $vendor->modified_by; ?></div>
							</div>
						</div>
						
					</div>
				</li>
				
			</ul>
</div>
