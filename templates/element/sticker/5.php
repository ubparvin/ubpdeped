
	<div class="col-md-12 print_content">
	<div class="row">	
		<div class="col-md-10 pc_region">
			<h2 class="p-t-10"><?php echo $couriertxtitem->division; ?>
				
			</h2>
		</div>
		<div class="col-md-2 pc_region">
			<span class="fs-22">TCL</span>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="row">	
		<div class="col-md-8">
			<h4 class="fs-26"><?php echo $couriertxtitem->couriercontract->name; ?></h4>
		</div>
		<div class="col-md-4">
			<div class="fs-22 text-center">MA</div>
			<div class="row">
				<div class="col-md-6">
					<div class="fs-16 text-center">TX</div>
					<div class="fs-22 text-center"><?php echo $couriertxtitem->ma_tx; ?></div>
				</div>
				<div class="col-md-6">
					<div class="fs-16 text-center">TM</div>
					<div class="fs-22 text-center"><?php echo $couriertxtitem->ma_tm; ?></div>
				</div>
			</div>
		</div>
		 <div class="col-md-12 pc_school">
			<div class="fs-14">DN : <?php echo $couriertxtitem->dn; ?></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1 nopadding">
			<div class="sticker_code">SCHOOL/ADDRESS</div>
		</div>
		<div class="col-md-8 m-t-20">
			
			<div>SCHOOL ID : <?php echo $couriertxtitem->school_beis; ?></div>
			<div><?php echo $couriertxtitem->school; ?></div>
			<div><?php echo $couriertxtitem->address; ?></div>
			
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
			<div><?php echo $couriertxtitem->cust_name; ?></div>
			<div><?php echo $couriertxtitem->cust_contact; ?></div>
			<div><?php echo $couriertxtitem->cust_email; ?></div>
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
					'id' 	=> $couriertxtitem->id,
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
