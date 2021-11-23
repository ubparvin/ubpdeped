
	<div class="col-md-12 print_content">
	<div class="row">	
		<div class="col-md-10 pc_region">
			<h2 class="p-t-10"><?php echo $courierdcpitem->division; ?>
				
			</h2>
		</div>
		<div class="col-md-2 pc_region">
			<span class="fs-22">TCL</span>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="row">	
		
		<div class="col-md-4">
			<div class="fs-22">LAPTOP</div>
			<div class="fs-22"><?php echo $courierdcpitem->latop; ?></div>
		</div>
		<div class="col-md-4">
			<div class="fs-22">SMART TV</div>
			<div class="fs-22"><?php echo $courierdcpitem->smart_tv; ?></div>
		</div>
		<div class="col-md-4">
			<div class="fs-22">LAPEL</div>
			<div class="fs-22"><?php echo $courierdcpitem->lapel; ?></div>
		</div>
		 <div class="col-md-12 pc_school">
			<div class="fs-14">DN : <?php echo $courierdcpitem->dn; ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1 nopadding">
			<div class="sticker_code">SCHOOL/ADDRESS</div>
		</div>
		<div class="col-md-8 m-t-20">
			
			<div>SCHOOL ID : <?php echo $courierdcpitem->school_beis; ?></div>
			<div><?php echo $courierdcpitem->school; ?></div>
			<div><?php echo $courierdcpitem->address; ?></div>
			
		</div>
		<div class="col-md-3">
			<div class="row m-t-10">
				<div class="col-md-12 text-center abt">Weight</div>
				<div class="col-md-12 text-center abt p-b-10 p-t-10 fs-30">&nbsp;</div>
			</div>
		</div>
		
		<div class="col-md-1 nopadding">
			<div class="sticker_code1">CUSTODIAN</div>
		</div>
		<div class="col-md-8 m-t-5">
			<div><?php echo $courierdcpitem->cust_name; ?></div>
			<div><?php echo $courierdcpitem->cust_contact; ?></div>
			<div><?php echo $courierdcpitem->cust_email; ?></div>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12 text-center abt">Box</div>
				<div class="col-md-12 text-center abt p-b-10 p-t-10 fs-30">&nbsp;</div>
			</div>
		</div>
		
		<div class="col-md-4 m-b-10">
			<?php
				$details = array(
					'id' 	=> $courierdcpitem->id,
					'cid'	=> $product->couriercontract->id,
					'cname'	=> $product->couriercontract->name
				);
							
				$details = base64_encode(json_encode($details));
				echo $this->element('qrcode', [
				'details' => $details]);
								
							
							 
			?>
						
			
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 text-center abt">Delivery Attempt</div>
				<div class="col-md-6 text-center abt p-b-10 p-t-10 fs-30">1</div>
				<div class="col-md-6 text-center abt p-b-10 p-t-10 fs-30">2</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 text-center abt">Return Attempt</div>
				<div class="col-md-6 text-center abt p-b-10 p-t-10 fs-30">1</div>
				<div class="col-md-6 text-center abt p-b-10 p-t-10 fs-30">2</div>
			</div>
		</div>
		
	</div>
	</div>
	
	<button type="button" class="m-t-20 nodisplay" id="btnPrint"> Print</button>
