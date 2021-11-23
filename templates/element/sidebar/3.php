			<li class="nav-item m-t-30 fchild">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-truck"></i>
							<span class="fs-11 bold">LOGISTICS MANAGEMENT</span>',
							['controller' => 'logistics', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>

           <li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-tag"></i>
							<span class="fs-11 bold">INVENTORY MANAGEMENT</span>',
							['controller' => 'products', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li> 
			<li class="nav-item nodisplay">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-store"></i>
							<span class="fs-11 bold">PURCHASE MANAGEMENT</span>',
							['controller' => 'requests', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li> 
			
			
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-book-reader"></i>
							<span class="fs-11 bold">DELIVERABLE CONTRACT</span>',
							['controller' => 'couriercontracts', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-book"></i>
							<span class="fs-11 bold">TXT <div>INVENTORY</div> </span>',
							['controller' => 'couriertxtitems', 'action' => 'selectprogram'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
			<li class="nav-item">
				<?php echo $this->Html->link('<i class="fa fa-fw fa-tv"></i>
							<span class="fs-11 bold">DCP <div>INVENTORY</div></span>',
							['controller' => 'courierdcpitems', 'action' => 'index'],
							['escape' => false, 'class' => 'nav-link']
						); ?>
						
            </li>
