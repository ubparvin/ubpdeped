<!-- Sidebar -->
        <!--ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion toggled _toggled fixed-top" id="accordionSidebar"-->
        <ul class="navbar-nav sidebar accordion toggled _toggled fixed-top" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand m-t-30 d-flex align-items-center justify-content-center">
                <div class="sidebar-brand-icon rotate-n-0">
                   <?php echo $this->html->image('logo.png', array('width' => '100%', 'class' => 'main_logo')); ?>
                </div>
                
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0 nodisplay">
			
			<?php echo $this->element('sidebar/'.$user['group_id']); ?>
			
			
            <!-- Heading -->
            <div class="sidebar-heading nodisplay">
                System
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item nodisplay">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#settings"
                    aria-expanded="true" aria-controls="settings">
                    <i class="fa fa-fw fa-cog"></i>
                    <span class="fs-11 bold">SETTINGS</span>
                </a>
                <div id="settings" class="collapse " aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-dark py-2 collapse-inner noradius">
						<?php echo $this->Html->link('<i class="fa fa-fw fa-users m-r-5"></i> ACCESS GROUP',
							['controller' => 'groups', 'action' => 'index'],
							['escape' => false, 'class' => 'fs-10 bold collapse-item link_white noradius']
						); ?>
						<?php echo $this->Html->link('<i class="fa fa-fw fa-user-circle m-r-5"></i> SYSTEM ACCOUNT',
							['controller' => 'users', 'action' => 'index'],
							['escape' => false, 'class' => 'fs-10 bold collapse-item link_white noradius']
						); ?>
				
                        
                    </div>
                </div>
            </li>

           
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline nodisplay">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            <div class="sidebar-card d-none d-lg-flex nodisplay">
               
                <p class="text-center mb-2">Example Message Here</p>
                <a class="btn btn-success btn-sm" href="#">Button</a>
            </div>

        </ul>
        <!-- End of Sidebar -->