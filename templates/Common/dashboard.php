
                   

                    <!-- Content Row -->
                    <div class="row">

                         <!-- Area Chart -->
                       <div class="col-xl-8 col-lg-8">
                            <div class="card shadow mb-4 noradius">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-warning fs-12">INVENTORY & DISTRIBUTION OVERVIEW</h6>
                                    <i class="fa fa-eye fa-w pull-right"></i>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
									<div class="row">
										
											<div class="col-md-6 nopadding-right">
												<?php 
													$status = $this->cell('Distribution::currentstatus', ['Inventory Summary', date('Y')], ['cache' => false]);

													echo $status; 
												?>
											</div>
											
											<div class="col-md-6 nopadding-left">
												<div class="row">
												<?php 
													$total_2021 = $this->cell('Distribution::displaytotal', [ date('Y').' Distribution Summary', date('Y')], ['cache' => false]);

													echo $total_2021; 
													
													
													$for_packaging = $this->cell('Distribution::displaystatus', [1, 'For Releasing', 'gift', 1], ['cache' => false]);

													echo $for_packaging; 
													
													$for_pickup = $this->cell('Distribution::displaystatus', [2, 'Picked-up From Warehouse', 'qrcode', 1], ['cache' => false]);

													echo $for_pickup; 
													
													$for_delivery = $this->cell('Distribution::displaystatus', [8, 'For Delivery', 'shipping-fast', 1], ['cache' => false]);

													echo $for_delivery; 
													
													$in_transit = $this->cell('Distribution::displaystatus', [4, 'In Transit / Shipment', 'ship', 1], ['cache' => false]);

													echo $in_transit; 
													
													
													//$total_2020 = $this->cell('Distribution::displaytotal', ['2020 Distribution Summary', '2020'], ['cache' => false]);

													//echo $total_2020; 
												 ?>

											
												</div>
											</div>
									</div>
								</div>
							</div>
						</div>
						 
						 
						
				</div>
				

                   