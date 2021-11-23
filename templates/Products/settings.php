<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="col-md-3 nopadding">
<div class="card shadow mb-4 noradius">
	<div class="card-header py-3">
		<div class="btn-group2">
		<?= 
		$this->Html->link(__('<i class="fa fa-cog fa-lg"></i> <div class="bold fs-14">PROGRAM</div> <div>Add / Update Inventory Program</div>'), 
		['action' => 'index', 'controller' => 'programs'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nooutline fs-12  btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'program_table',
			'data-controller' 	=> 'programs',
			'title' 			=> 'PROGRAM SETTINGS',
			'note' 				=> 'List of all inventory programs'
		]
			
		) ?>
		
		<?= 
		$this->Html->link(__('<i class="fa fa-cog fa-lg"></i><div class="bold fs-14">PROGRAM SERIES</div> <div>Add / Update Program Series</div>'), 
		['action' => 'index', 'controller' => 'programseries'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nooutline fs-12 bold btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'programseries_table',
			'data-controller' 	=> 'programseries',
			'title' 			=> 'PROGRAM SERIES',
			'note' 				=> 'List of all inventory sub-items'
		]
			
		) ?>
		
		<?= 
		$this->Html->link(__('<i class="fa fa-cog fa-lg"></i> <div class="bold fs-14">CATEGORY</div> <div>Add / Update Inventory Category</div>'), 
		['action' => 'index', 'controller' => 'categories'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nooutline fs-12 btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'category_table',
			'data-controller' 	=> 'categories',
			'title' 			=> 'CATEGORY SETTINGS',
			'note' 				=> 'List of all inventory categories'
		]
			
		) ?>
		
		<?= 
		$this->Html->link(__('<i class="fa fa-cog"></i> <div class="bold fs-14">SUB-CATEGORY</div> <div>Add / Update Inventory Sub-category</div>'), 
		['action' => 'index', 'controller' => 'subcategories'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nooutline fs-12 bold btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'subcategory_table',
			'data-controller' 	=> 'subcategories',
			'title' 			=> 'SUB-CATEGORY SETTINGS',
			'note' 				=> 'List of all inventory sub-categories'
		]
			
		) ?>
		
		<?php 
		
		/*$this->Html->link(__('<i class="fa fa-cog fa-lg"></i><div class="bold fs-14">SUB-ITEM</div> <div>Add / Update Inventory Sub-item</div>'), 
		['action' => 'index', 'controller' => 'subitems'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nooutline fs-12 bold btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'subitem_table',
			'data-controller' 	=> 'subitems',
			'title' 			=> 'SUB-ITEM SETTINGS',
			'note' 				=> 'List of all inventory sub-items'
		]
			
		)*/ ?>
		
		
		
		<?= 
		$this->Html->link(__('<i class="fa fa-cog fa-lg"></i> <div class="bold fs-14">TAGGING</div> <div>Add / Update Inventory Tagging</div>'), 
		['action' => 'index', 'controller' => 'taggings'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nooutline fs-12 bold btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'tagging_table',
			'data-controller' 	=> 'taggings',
			'title' 			=> 'TAGGING SETTINGS',
			'note' 				=> 'List of all inventory tagging'
		]
			
		) ?>
		
		<?= 
		$this->Html->link(__('<i class="fa fa-cog fa-lg"></i><div class="bold fs-14">ACCESS GROUP</div> <div>Add / Update System Access Group</div>'), 
		['action' => 'index', 'controller' => 'groups'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nooutline fs-12 btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'group_table',
			'data-controller' 	=> 'groups',
			'title' 			=> 'ACCESS GROUP SETTINGS',
			'note' 				=> 'List of all access group'
		]
			
		) ?>
		
		<?= 
		$this->Html->link(__('<i class="fa fa-cog fa-lg"></i> <div class="bold fs-14">ACCESS ROLE</div> <div>Add / Update System Access Role</div>'), 
		['action' => 'index', 'controller' => 'roles'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nooutline fs-12  btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'role_table',
			'data-controller' 	=> 'roles',
			'title' 			=> 'ACCESS ROLE SETTINGS',
			'note' 				=> 'List of all access role'
		]
			
		) ?>
		
		<?= 
		$this->Html->link(__('<i class="fa fa-cog fa-lg"></i> <div class="bold fs-14">AUDIT TRAIL</div> <div>Manage System Logs</div>'), 
		['controller' => 'admin', 'action' => 'database-log', 'Logs'], 
		[
			'escape' 			=> false, 
			'class' 			=> 'nodisplay nooutline fs-12  btn btn-info modal_view btn-lg btn-block noradius', 
			'data-toggle' 		=> 'modal', 
			'data-target' 		=> '#form_content', 
			'data-table' 		=> 'role_table',
			'data-controller' 	=> 'roles',
			'title' 			=> 'ACCESS ROLE SETTINGS',
			'note' 				=> 'List of all access role'
		]
			
		) ?>
		
		
		</div>
    </div>
</div>
</div>
    
<?php echo $this->element('modal/modal_settings'); ?>
<?php echo $this->element('modal/modal_normal_sub'); ?>

<?php 
	
	echo $this->Html->script('datatable/datatables.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/pdfmake.min', ['block' => 'scriptBottom']);	
	echo $this->Html->script('datatable/vfs_fonts', ['block' => 'scriptBottom']);	
	echo $this->Html->script('table/settings_table', ['block' => 'scriptBottom']);	
	echo $this->Html->script('admin/controller/settings', ['block' => 'scriptBottom']);	
		
	//echo $this->Html->scriptStart(['block' => 'scriptBottom']);
		//echo '
	//echo $this->Html->scriptEnd();
?>