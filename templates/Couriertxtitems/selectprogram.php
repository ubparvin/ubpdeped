<?php //$this->assign('title', "Office Management"); ?>
<!-- DataTales Example -->
<div class="card shadow mb-4 noradius">
	
	<div class="card-body">
		
		<div class="row">
		<?php foreach($contracts as $i): ?>
						<div class="col-xl-3 col-lg-3">
                            <div class="card shadow mb-4 noradius">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-default fs-12"><?php echo $i->level; ?></h6>
                                    <i class="nodisplay text-default fa fs-10 fa-info-circle fa-w pull-right"> <?php echo $i->id; ?></i>
                                    <span class="pull-right fs-10"># <?php echo $i->id; ?></span>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
									<div class="row">
										<div class="col-md-12 fs-12 text-info bold m-b-20">
										<?php echo $i->description; ?>
										<div class="clear"></div>
										<hr>
										<?php 
										
											echo $this->Html->link('SHOW ITEMS',
											['controller' => 'couriertxtitems', 'action' => 'index', $i->id, $i->name],
											['escape' => false, 'class' => 'm-t-10 noradius btn btn-warning btn-xs fs-10 bold']
											);
										?>
										<hr>
										</div>
										<div class="col-md-6">
											<div class="bold text-default fs-12">ITEM RECEIVED</div>
											<div class="bold text-info fs-11">
												<?php
													$item_received = $this->cell('Txtitems::displaystatus', [$i->id], ['cache' => false]);

													echo $item_received; 
												?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="bold text-danger fs-12">READY FOR DISPATCH</div>
											<div class="bold text-info fs-11"><?php echo $item_received;  ?></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
		<?php endforeach; ?>
		</div>
		
		
	</div>
</div>


