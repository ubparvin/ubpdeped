<div class="row">
	
	<div class="col-lg-12 col-md-12">
		<?= $this->Form->create($courierdcpitem, [
					'class' => 'products',
					'id' => 'product_import',
					'class' => 'products',
					'id' => 'product_form'
				]) ?>
		
		<div class="col-md-12 nopadding">
			<?php echo $this->Form->control('couriercontract_id', 
				['label' => 'Select Contract <span class="m-l-2 text-info">*</span>', 
				'options' => $contracts,
				'empty' => '--- Select Contract',
				'id' => 'couriercontract_id',
				'escape' => false, 'class' => 'noradius numbers_and_letters form-control']
			); ?>
		</div>
						
		<div class="clear"></div>
		<div id="fileuploader" class="m-b-20 m-t-20"></div>
		
		<div class="clear"></div>
		<?= $this->Form->button(__('Continue Upload'), [
					'type' => 'button',
					'id'	=> 'uploadbtn',
					'class' => 'btn btn-success pull-right btn-xs m-t-10 m-b-10'
				]) ?>
		<div class="clear"></div>
		<?= $this->Form->end() ?>
		
		
		<div class="table-responsive">
			<div id="upload_response"></div>	
		</div>
	</div>
</div>