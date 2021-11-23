<h5>
	<?php echo $group->name; ?>
</h5>
<div><?php echo $group->description; ?></div>
<div><?php echo $group->added; ?></div>
<hr>
<?php 
		echo $this->Html->link(__('<i class="fa fa-edit"></i> Update'), 
		['action' => 'edit', $group->id],
		['escape' => false, 'class' => 'btn btn-success btn-sm float-right modal_view', 
		'data-toggle' => 'modal', 'data-target' => '#form_content', 'title' => 'Create Access Group']) 
	?>
