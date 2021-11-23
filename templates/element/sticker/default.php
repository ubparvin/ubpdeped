
	<div class="col-md-7 print_content">
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
		<div class="col-md-6 pc_school">
			<h4 class="fs-26"><?php echo $couriertxtitem->couriercontract->name; ?></h4>
		</div>
		<div class="col-md-3 pc_school">
			<div class="fs-22">TX</div>
			<div class="fs-22"><?php echo $couriertxtitem->tx; ?></div>
		</div>
		<div class="col-md-3 pc_school">
			<div class="fs-22">TM</div>
			<div class="fs-22">26</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1 nopadding">
			<div class="sticker_code">SCHOOL/ADDRESS</div>
		</div>
		<div class="col-md-8 m-t-20">
			<div>SCHOOL ID NO. : 1231</div>
			<div>ADAMS NATIONAL HIGHSCHOOL</div>
			<div>This is the example address</div>
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
			<div>JUAN DELA TORRE</div>
			<div>TEL. NO. 1234566678</div>
			<div>test@sample.email.com</div>
		</div>
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12 text-center abt">Box</div>
				<div class="col-md-12 text-center abt p-b-10 p-t-10 fs-30">&nbsp;</div>
			</div>
		</div>
		
		<div class="col-md-4 m-b-10">
			<?php echo $this->Html->image('qrcode.png', ['class' => 'img-responsive']); ?>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 text-center abt">Delivery Attempt</div>
				<div class="col-md-6 text-center abt p-b-20 p-t-20 fs-30">1</div>
				<div class="col-md-6 text-center abt p-b-20 p-t-20 fs-30">2</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12 text-center abt">Return Attempt</div>
				<div class="col-md-6 text-center abt p-b-20 p-t-20 fs-30">1</div>
				<div class="col-md-6 text-center abt p-b-20 p-t-20 fs-30">2</div>
			</div>
		</div>
		
	</div>
	</div>
	
	<button type="button" class="m-t-20 nodisplay" id="btnPrint"> Print</button>
