<div class="row">
	
	<div class="col-lg-12 col-md-12">
		<?= $this->Form->create($school, [
					'class' => 'schools',
					'id' => 'school_import'
				]) ?>
		
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