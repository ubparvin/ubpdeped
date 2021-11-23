
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-default">GROUP
		
		<div class="btn-group float-right">
		<?= $this->Html->link(__('<i class="fa fa-sync"></i> Refresh'), 
		['action' => 'index'], 
		['escape' => false, 'class' => 'btn btn-warning btn-sm float-right']) ?>


		 <?= $this->Html->link(__('<i class="fa fa-download"></i> Report'), 
		['action' => 'add'], 
		['escape' => false, 'class' => 'btn btn-success btn-sm float-right modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content', 'title' => 'Create New Group']) ?>

		<?= $this->Html->link(__('<i class="fa fa-plus-circle"></i> Create'), 
		['action' => 'add'], 
		['escape' => false, 'class' => 'btn btn-success btn-sm float-right modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content', 'title' => 'Create New Group']) ?>
		</div>
		<?php echo $group->count; ?>

		</h6>
    </div>
	<div class="card-body">
		<div class="table-responsive">
		   <table class="table table-condensed" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name</th>
						<th>Added</th>
						<th>Status</th>
						<th class="actions">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($groups as $group): ?>
					<tr>
						<td><?= $this->Number->format($group->id) ?></td>
						<td><?= h($group->name) ?></td>
						<td><?= h($group->added) ?></td>
						<td><?php echo (($group->status =="1") ? '<span class="text-success">ACTIVE</span>' : '<span class="text-danger">DEACTIVATED</span>'); ?></td>
						<td class="actions">
							<div class="btn-group float-right">
								<?= $this->Html->link(__('<i class="fa fa-eye"></i>'), 
								['action' => 'view', $group->id], 
								['escape' => false, 'class'  => 'btn btn-success btn-sm float-right modal_view', 
								'data-toggle' => 'modal', 'data-target' => '#form_content',  'title' => 'Group Details']) ?>
								
								<?= $this->Html->link(__('<i class="fa fa-pen"></i>'), 
								['action' => 'edit', $group->id], 
								['escape' => false, 'class'  => 'btn btn-danger btn-sm float-right modal_view', 
								'data-toggle' => 'modal', 'data-target' => '#form_content',  'title' => 'Update Group Details']) ?>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
    
<?php echo $this->element('modal/modal_normal'); ?>





