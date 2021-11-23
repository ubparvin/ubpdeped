<div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2 noradius">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-default text-uppercase mb-1">
											<?php echo $title; ?>
											<div class="text-warning fs-11 bold">AS OF <?php echo date('m/d/Y'); ?></div>
											</div>
                                            <div class="fs-30 p-b-30 mb-0 bold text-gray-800">
											
												<table class="table table-bordered table-condensed">
													<tbody>
													<?php foreach($data as $p): ?>
														<tr><td>
															
															
															<div class="row">
																<div class="col-md-4 text-left text-default fs-14 bold">
																<?php echo $p['program']; ?>
																</div>
																<div class="col-md-4 text-success  bold">
																	<div class="text-warning fs-9 bold">TOTAL QUANTITY</div>
																	<div class="text-success fs-20 bold"><?php echo $p['qty']; ?></div>
																</div>
																<div class="col-md-4 text-success  bold">
																	<div class="text-warning fs-9 bold">IN-STOCKS ( AVAILABLE )</div>
																	<div class="text-success fs-20 bold"><?php echo $p['on_hand']; ?></div>
																</div>
															</div>
															
														</td>	</tr>
													<?php endforeach; ?>
												</tbody>
												</table>
												
											</div>
                                        </div>
                                      
										
                                    </div>
                                </div>
                            </div>
              </div>