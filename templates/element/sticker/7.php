
	<div class="col-md-12 print_content">
	<div class="row">	
		<div class="col-md-10 pc_region">
			<h2 class="p-t-10"><?php echo $couriertxtitem->division; ?>
				
			</h2>
		</div>
		<div class="col-md-2">
			<span class="fs-22">TCL</span>
		</div>
	</div>
	<div class="clear"></div>
	
	<div class="row">	
		<div class="col-md-10 pc_school">
			<h4 class="fs-26"><?php echo $couriertxtitem->couriercontract->name; ?></h4>
		</div>
		<div class="col-md-2 pc_school">
			<div class="fs-22">TX</div>
			<div class="fs-22"><?php echo $couriertxtitem->kg_total; ?></div>
		</div>
		
	</div>
	<div class="row">
		<div class="col-md-1 nopadding">
			<div class="sticker_code">SCHOOL/ADDRESS</div>
		</div>
		<div class="col-md-8 m-t-20">
			
			<div><?php echo $couriertxtitem->recipient_district; ?></div>
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
			<div>&nbsp;</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
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
