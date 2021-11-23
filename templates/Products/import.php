<div class="row">
	
	<div class="col-lg-12 col-md-12">
		<?= $this->Form->create($product, [
					'class' => 'products',
					'id' => 'product_import',
					'class' => 'products',
					'id' => 'product_form'
				]) ?>
		<div class="btn-group m-b-40 pull-right">
			 <a href="<?php echo $this->Url->webroot.'webroot/form/deped_import_product_form.csv'; ?>" download class="btn btn-xs btn-warning fs-10 noradius"><i class="fa fa-download fa-lg"></i> DOWNLOAD FORM</a>
			 <a href="<?php echo $this->Url->webroot.'webroot/form/deped_import_product_form_with_data.csv'; ?>" download class="btn btn-xs btn-warning fs-10 noradius"><i class="fa fa-download fa-lg"></i> DOWNLOAD FORM ( WITH DATA )</a>
			 
        </div>
		<div class="clear"></div>
		<div id="fileuploader" class="m-b-20">Upload</div>
		
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