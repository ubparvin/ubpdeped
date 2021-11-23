<li class="nav-item m-t-30 fchild">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-tachometer-alt"></i>
							<span class="fs-11 bold">DASHBOARD</span>',
							['controller' => 'users', 'action' => 'dashboard'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			

            

           <li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-tag"></i>
							<span class="fs-11 bold">INVENTORY MANAGEMENT</span>',
							['controller' => 'products', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li> 
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-store"></i>
							<span class="fs-11 bold">PURCHASE MANAGEMENT</span>',
							['controller' => 'requests', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li> 
			
			

			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-user-circle"></i>
							<span class="fs-11 bold">MY PROFILE</span>',
							['controller' => 'users', 'action' => 'index'],
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