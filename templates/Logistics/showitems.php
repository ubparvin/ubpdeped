
						<div class="table-responsive">
						<?php echo $this->Form->create(); ?>
						   <table class="table table-condensed table-striped" id="i_table" width="100%" cellspacing="0">
								<thead>
									<tr>
										
										<th colspan="3"><?php echo $title; ?></th>
										
									</tr>
									<tr>
										
										<th>ITEM CODE</th>
										<th>PROGRAM</th>
										<th>PA & DATE</th>
										
									</tr>
									
								</thead>
								<tbody>
									
								
									<?php if(!empty($logistics)): ?>
										<?php foreach($logistics as $i): ?>
											<tr>
												<td><?php echo $i['qrcode']; ?></td>
												<td><?php echo $i['program']; ?></td>
												<td>
													<?php echo $i['pa']; ?>
													<div><?php echo date('m/d/Y H:i A', strtotime($i['inspect_date'])); ?></div>
												</td>
												
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
					


