<li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-tachometer-alt"></i>
							<span class="fs-11 bold">DASHBOARD</span>',
							['controller' => 'users', 'action' => 'dashboard'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
           <li class="nav-item m-t-30  fchild">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-tachometer-alt"></i>
							<span class="fs-11 bold">DEPED LOGISTICS</span><div class="fs-7 bold">MANAGEMENT</div>',
							['controller' => 'logistics', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>  
			
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-tag"></i>
							<span class="fs-11 bold">INVENTORY</span>',
							['controller' => 'products', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li> 
			
			<li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-gift"></i>
							<span class="fs-11 bold">DISTRIBUTION</span>',
							['controller' => 'distributions', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-user-circle"></i>
							<span class="fs-11 bold">SUPPLIER</span> <div class="fs-7 bold">MANAGEMENT</div>',
							['controller' => 'vendors', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
		
			
			<li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-truck-loading"></i>
							<span class="fs-11 bold"> SUPPLY MANAGEMENT</span>',
							['controller' => 'requests', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>

			<li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-shopping-basket"></i>
							<span class="fs-11 bold">PROCUREMENT</span>',
							['controller' => 'orders', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>

			
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-school"></i>
							<span class="fs-11 bold">SCHOOL</span> <div class="fs-7 bold">MANAGEMENT</div>',
							['controller' => 'schools', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-school"></i>
							<span class="fs-11 bold">DIVISION</span> <div class="fs-7 bold">MANAGEMENT</div>',
							['controller' => 'divisions', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-home"></i>
							<span class="fs-11 bold">WAREHOUSE</span> <div class="fs-7 bold">MANAGEMENT</div>',
							['controller' => 'warehouses', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			<li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-building"></i>
							<span class="fs-11 bold">OFFICE MANAGEMENT</span>',
							['controller' => 'offices', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			<li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-file"></i>
							<span class="fs-11 bold">REPORTS</span>',
							['controller' => 'groups', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			
           <li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-users"></i>
							<span class="fs-11 bold">ACCESS GROUP</span>',
							['controller' => 'groups', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>

			<li class="nav-item ">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-user-circle"></i>
							<span class="fs-11 bold">ACCOUNTS</span> <div class="fs-7 bold">MANAGEMENT</div>',
							['controller' => 'users', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-cog"></i>
							<span class="fs-11 bold">SETTINGS</span>',
							['controller' => 'products', 'action' => 'settings'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			<li class="nav-item lchild">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-power-off"></i>
							<span class="fs-11 bold">LOGOUT</span>',
							['controller' => 'users', 'action' => 'logout'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>