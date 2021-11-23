<?php
/**
 * @var \App\View\AppView $this
 * @var \DatabaseLog\Model\Entity\DatabaseLog $log
 */
?>
<div class="card shadow mb-4">
<div class="card-header py-3">
	<span class="fs-12 bold text-warning">SYSTEM LOGS MANAGEMENT</span>
</div>
<div class="card-body">

<nav class="large-12 medium-12 columns col-lg-12 col-md-12 actions">
		<?php echo $this->Html->link(__('<i class="fa fa-arrow-left"></i> BACK'), 
			['action' => 'index', '?' => $this->request->getQuery()],
			['escape' => false, 'class' => 'btn btn-success btn-xs noradius fs-11 bold']
			); ?>
		
		
		<?php 
			
			if($log->type!=="_info"){
				echo $this->Form->postLink(__('<i class="fa fa-trash"></i> DELETE {0}', __('LOG')), 
					['action' => 'delete', $log->id], 
					['escape' => false, 'class' => 'btn btn-danger btn-xs noradius fs-11 bold'],
					['confirm' => __('Are you sure?')
				]); 
			}
		?>
		
	
</nav>

<div class="large-12 medium-12 columns col-lg-12 col-md-12 content">


	<div style="float: right">
		<?php echo $this->Html->link(__('Formatted'), [$log->id, '?' => ['formatted' => true] + $this->request->getQuery()], ['class' => 'btn btn-default']); ?>
	</div>

	<dl>
		<dt><?php echo __('type'); ?></dt>
		<dd>
			<?php echo $this->Log->typeLabel($log->type); ?>
			<?php
			$isCli = $log->isCli();
			if ($isCli) {
				echo '<span class="badge badge-secondary label label secondary round radius">cli</span>';
			}
			?>
		</dd>

		<?php if ($log->summary && !$log->message) { ?>
		<dt><?php echo __('Summary'); ?></dt>
		<dd>
			<?php if ($this->request->getQuery('formatted')) {
				echo '<pre>' . trim(h($log->summary)) . '</pre>';
			} else {
				echo trim(nl2br(h($log->summary)));
			} ?>
		</dd>
		<?php } ?>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php if ($this->request->getQuery('formatted')) {
				echo '<pre>' . trim(h($log->message)) . '</pre>';
			} else {
				echo trim(nl2br(h($log->message)));
			} ?>
		</dd>

		<dt><?php echo __('Context'); ?></dt>
		<dd>
			<?php if ($this->request->getQuery('formatted')) {
				echo '<pre>' . trim(h($log->context)) . '</pre>';
			} else {
				echo trim(nl2br(h($log->context)));
			} ?>
		</dd>
		<dt><?php echo $isCli ? __('Command') :  __('Uri'); ?></dt>
		<dd>
			<?php echo h($log->uri); ?>
		</dd>

		<?php if (!$isCli) { ?>
		<dt><?php echo __('Referrer'); ?></dt>
		<dd>
			<?php echo h($log->refer); ?>
		</dd>
		<?php } ?>

		<dt><?php echo __('Hostname'); ?></dt>
		<dd>
			<?php echo h($log->hostname); ?>
		</dd>
		<dt><?php echo __('IP'); ?></dt>
		<dd>
			<?php echo h($log->ip); ?>
		</dd>

		<dt><?php echo __('User Agent'); ?></dt>
		<dd>
			<?php echo h($log->user_agent); ?>
		</dd>

		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo $this->Time->nice($log->created); ?>
		</dd>
	</dl>

</div>
</div>
</div>
