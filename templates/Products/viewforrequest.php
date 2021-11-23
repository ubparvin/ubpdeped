<div class="col-md-12">
	<div class="row">
		
		<div class="col-md-3">
			<?php echo $this->Html->image('no_image.jpg', ['class' => 'img-responsive']); ?>
		</div>
		<div class="col-md-9">
			<div class="bold"><?php echo $product->name; ?></div>
			<hr>
			<div class="text-warning fs-11 bold">SUB-ITEM: <?php echo $product->subname; ?></div>
			<div class="text-warning fs-11 bold">PROGRAM: <?php echo $product->program->name; ?></div>
			<div class="text-warning fs-11 bold">CATEGORY: <?php echo $product->category->name; ?></div>
			<div class="text-warning fs-11 bold">SUB-CATEGORY: <?php echo $product->subcategory->name; ?></div>
			<div class="text-warning fs-11 bold">TAGGING: <?php echo $product->tagging->name; ?></div>
			<hr>
			<div class="clear"></div>
			<?= $this->Form->create($request, [
					'url' => [
						'controller' => 'requests',
						'action' => 'saveajax'
					],
					'class' => 'requests',
					'id' => 'request_form'
				]) ?>
				
			<div class="row m-b-40">
				
				<div class="col-md-12 m-t-20 text-left">
							 <div class="small text-default bold fs-11">QUANTITY & ITEM SPECIFICATIONS </div>
							 <hr>
						</div>
				<div class="col-md-4 nopadding">
					<?php echo $this->Form->hidden('product_id', ['type' => 'text', 'default' => $product->id]); ?>
					
					<input type="text" value="1" name="qty" maxlength="6" class="bold fs-14 numbers_only qty noborder input-group-item form-control noradius" />								
				</div>
				<div class="col-md-4 nopadding">
					<div class="row">
						<div class="col-md-5 nopadding">
							<button type="button" class=" btn btn-default fs-12 bold btn-xs noradius dec btn-block"><i class="fa fa-minus-circle"></i></button>			
						</div>
						<div class="col-md-5 nopadding">
							<button type="button" class="  btn btn-default fs-12 bold  btn-xs noradius inc btn-block"><i class="fa fa-plus-circle"></i></button>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				
				<div class="col-md-12 m-t-10">
					<?php echo $this->Form->control('note', ['rows' => 3, 'label' => 'Note / Other Information', 'class' => 'form-control allcaps noradius']); ?>
				</div>
				
				<div class="col-md-8 m-t-20">
				<?= $this->Form->button('CONTINUE REQUEST FOR SUPPLY', [
					'type' => 'button',
					'form' => '#request_form',
					'id'	=> 'btn_request',
					'action' => 'new',
					'escape' => false,
					'url'	=> $this->Url->build(['controller' => 'requests', 'action' => 'saveajax']),
					'class' => 'btn btn-xs btn-block btn-success fs-11 bold noradius'
				]) ?>
				</div>
				
			</div>
			<?= $this->Form->end() ?>							
											
		</div>
		
	</div>
</div>
