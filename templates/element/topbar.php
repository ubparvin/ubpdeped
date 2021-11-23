<!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow fixed-top">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
					
					<div class="p_title">
						
						<?php 
							$headertitle = $this->cell('Common::headertitle', [], ['cache' => false]);

							echo $headertitle; 
						 ?>
						<div class="text-warning"><?php echo (isset($title) && !empty($title) ? $title : ""); ?></div>
					</div>
					
                    <!-- Topbar Search -->
                    <form
                        class="nodisplay d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                       
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								
                                <div class="mr-2 d-none d-lg-inline text-primary">
									<div class="fs-9 text-default bold">WELCOME</div>
									<div class="fs-12 bold"><?php echo $user['firstname'].' '.$user['lastname']; ?></div>
								</div>
                                <!--img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg"-->
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="noradius dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
								<?php 
									echo $this->Html->link('<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile',
									['controller' => 'users', 'action' => 'profile'],
									['escape' => false, 'class' => 'dropdown-item']
									);
							
									echo $this->Html->link('<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i> Activity Log',
									['controller' => 'users', 'action' => 'activitylog'],
									['escape' => false, 'class' => 'dropdown-item']
									);
								?>
								 <div class="dropdown-divider"></div>
								<?php
									echo $this->Html->link('<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Log Out',
									['controller' => 'users', 'action' => 'logout'],
									['escape' => false, 'class' => 'dropdown-item']
									);
								?>
                               
                               
                                
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->