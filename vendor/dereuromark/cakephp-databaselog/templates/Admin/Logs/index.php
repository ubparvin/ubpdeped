<?php
/**
 * @var \App\View\AppView $this
 * @var \DatabaseLog\Model\Entity\DatabaseLog[] $logs
 * @var string|null $currentType
 * @var array $types
 */

use DatabaseLog\Model\Table\DatabaseLogsTable;

?>

<div class="card-body">
<nav class="large-12 medium-12 columns col-lg-12 col-md-12 actions">
	
		<div class="btn-group">
		
		<?php echo $this->Form->postLink(__('<i class="fa fa-trash"></i> REMOVE {0}', __('DUPLICATES')),
			['action' => 'removeDuplicates'],
			['escape' => false, 'class' => 'btn btn-danger btn-xs noradius fs-11 bold']
		); ?>
		<?php if ($currentType) { ?>
			<?php echo $this->Form->postLink(__('<i class="fa fa-sync"></i> RESET {0}', '"' . $currentType . '" ' . __('LOGS')), 
				['action' => 'reset', '?' => ['type' => $currentType]],
				['escape' => false, 'class' => 'btn btn-danger btn-xs noradius fs-11 bold'],
				['confirm' => 'Sure?']); ?>
		<?php } ?>
		<?php echo $this->Form->postLink(__('<i class="fa fa-sync"></i> RESET {0}', __('LOGS')), 
			['action' => 'reset'], 
			['escape' => false, 'class' => 'btn btn-danger btn-xs noradius fs-11 bold'],
			['confirm' => 'Sure?']); ?>
		</div>
		
</nav>

<div class="large-12 medium-12 columns col-lg-12 col-md-12 content">

<h5 class="text-uppercase fs-12 bold m-t-10"><?php echo $currentType ? $this->Log->typeLabel($currentType) : 'All'; ?> Logs</h5>

	<?php
	if (DatabaseLogsTable::isSearchEnabled()) {
		echo $this->element('DatabaseLog.search');
	}
	?>

<div class="col-md-12 nopadding">
	<?php echo $this->Html->link('ALL', 
		['controller' => 'Logs', 'action' => 'index'],
		['escape' => false, 'class' => 'fs-11 bold btn btn-primary btn-xs']
	); ?>
<?php
foreach ($types as $type) {
	
	echo $this->Html->link($this->Log->typeLabel($type), 
		['controller' => 'Logs', 'action' => 'index', '?' => ['type' => $type]], 
		['escape' => false, 'class' => 'btn btn-xs']
	);
	
}
?>
</div>

<div class="table-responsive2">
	<table class="table table-condensed table-striped">
		<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('type');?></th>
			<th><?php echo $this->Paginator->sort('summary');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($logs as $log):
			$message = $log->summary;
			$pos = strpos($message, 'Stack Trace:');
			if ($pos) {
				$message = trim(substr($message, 0, $pos));
			}
			$pos = strpos($message, 'Trace:');
			if ($pos) {
				$message = trim(substr($message, 0, $pos));
			}
			?>
			<tr>
				<td><?php echo $this->Time->nice($log->created); ?>&nbsp;</td>
				<td>
					<?php echo $this->Log->typeLabel($log->type); ?>
					<?php
					if ($log->isCli()) {
						echo '<span class="badge badge-secondary label label secondary round radius">cli</span>';
					}

					echo '<div><small>' . $this->Text->truncate($log->uri, 100) . '</small></div>';
					?>

					<?php if ($log->count > 1) { ?>
						<div class="log-count">
							<small>(<?php echo h($log->count); ?>x)</small>
						</div>
					<?php } ?>
				</td>
				<td>
					<?php echo nl2br(h($message)); ?>&nbsp;
				</td>
				<td class="actions">
					<?php 
						echo $this->Html->link(__('<i class="fa fa-eye"></i>'), 
							['action' => 'view', $log->id, '?' => $this->request->getQuery()],
							['escape' => false]
						); 
						
						if($log->type!=="_info"){
							echo $this->Form->postLink(__('<i class="fa fa-trash"></i>'), 
							['action' => 'delete', $log->id], 
							['escape' => false, 'class' => 'm-l-10'],
							['confirm' => __('Are you sure you want to delete this log # {0}?', $log->id)]
							);
							
						}
					?>
				
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	<?php echo $this->element('DatabaseLog.paging'); ?>

</div>
</div>
</div>
