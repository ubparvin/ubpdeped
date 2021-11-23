<div class="col-xl-12 col-md-12 mb-4">
                            <div class="card  shadow h-100 py-2 noradius">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
											<?php echo $title; ?>
											<div class="fs-9 text-danger">As of <?php echo date('m/d/Y'); ?></div>
											</div>
                                            <div class="fs-30 mb-0 bold text-gray-800">
											<?php echo $total; ?>
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-<?php echo $icon; ?> fa-2x text-gray-300"></i>
                                        </div>
										
										<div class="col-md-12">
											<button type="button" class="btn btn-sm btn-warning fs-10 view_details_vstat" status-id="<?php echo $status; ?>" >DETAILS</button>
											
											<?= $this->Html->link(__('SHOW ITEMS'), 
											['controller' => 'logistics', 'action' => 'showitems', $status], 
											['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-info modal_view btn-sm', 
											'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
												'title' => 'Logistic Items',
												'note' => ''
											],
												
											) ?>
											
											<?php if($status=="1"): ?>
											<?= $this->Html->link(__('RECEIVE'), 
											['controller' => 'logistics', 'action' => 'bulkreceive', $status], 
											['escape' => false, 'class' => 'nooutline fs-10 bold btn btn-danger modal_view btn-sm', 
											'data-toggle' => 'modal', 'data-target' => '#form_content_with_place', 
												'title' => 'Logistic Items',
												'note' => ''
											],
												
											) ?>
											
											<?php endif; ?>
										</div>
										
                                    </div>
                                </div>
                            </div>
                        </div>