<div class="col-xl-12 col-md-12 mb-4">
                            <div class="card shadow h-100 py-2 noradius">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
											<?php echo $title; ?>
											</div>
                                            <div class="fs-30 mb-0 bold text-gray-800">
											
												<table class="table table-bordered table-condensed">
													<tbody><tr>
													<?php foreach($data as $p): ?>
														<td>
															<div class="text-warning fs-12 bold">
																<?php echo $p['program']; ?>
															</div>
															<div class="text-success fs-15 bold">
																<?php echo $p['total']; ?>
															</div>
														</td>
													<?php endforeach; ?>
													</tr></tbody>
												</table>
												
											</div>
                                        </div>
                                      
										
                                    </div>
                                </div>
                            </div>
              </div>