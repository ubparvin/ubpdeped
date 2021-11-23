<div class="col-lg-12 col-md-12">
<div class="row">

	<div class="col-lg-12 col-md-12">
		<?= $this->Form->create($product, [
					'class' => 'products',
					'id' => 'product_image',
					'class' => 'products',
					'id' => 'product_form'
				]) ?>
		<?php echo $this->Form->hidden('productid', ['type' => 'text', 'id' => 'd_id', 'default' => $product->id]); ?>
		<?php echo $this->Form->hidden('productrefid', ['type' => 'text', 'id' => 'd_refid', 'default' => $product->refid]); ?>
		<div class="clear"></div>
		<div class="fs-14 bold m-t-10 m-b-10"><?php echo $product->name; ?></div>
		<div id="imagefile" class="m-b-20">Upload</div>
		
		<div class="clear"></div>
		<?= $this->Form->button(__('Upload Image'), [
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
</div>