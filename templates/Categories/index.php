
<div class="programs index content">
		<div class="btn-group">
			<?= 
			$this->Html->link(__('<i class="fa fa-plus-circle fa-lg"></i><div>CREATE NEW</div>'), 
			['action' => 'add', 'controller' => 'categories'], 
			['escape' => false, 'class' => 'nooutline fs-11 bold btn btn-success btn-sm modal_view_sub', 
			'data-toggle' => 'modal', 'data-target' => '#form_content_sub', 
				'data-table' => 'category_table',
				'data-controller' => 'categories',
				'title' => 'Register New Data',
				'note' => 'Required fields are marked with *'
			],
				
			) ?>
			
			<button type="button" id="refresh_table" class= "nooutline fs-11 bold btn btn-success btn-sm modal_view_sub noradius"><i class="fa fa-sync"></i><div>REFRESH DATA</div></button>
			
		</div>
		<hr>
		
		<div class="table-responsive">
		<?php echo $this->Form->create(); ?>
		   <table class="table table-condensed table-striped" id="category_table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>NAME</th>
						<th>STATUS</th>
						<th>ACTION</th>
					</tr>
				</thead>
			</table>
		</div>
	
</div>
