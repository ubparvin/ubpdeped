
						<div class="table-responsive">
						<?= $this->Form->create($logistic, [
								'url' => [
									'controller' => 'groups',
									'action' => 'saveajax'
								],
								'class' => 'groups',
								'id' => 'settings_form'
							]) ?>
						   <table class="table table-condensed table-striped" id="i_table" width="100%" cellspacing="0">
								<thead>
									<tr>
										
										<th colspan="3"><?php echo $title; ?></th>
										
									</tr>
									<tr>
										
										<th>#</th>
										<th>ITEM CODE</th>
										<th>PROGRAM</th>
										<th>PA & DATE</th>
										
									</tr>
									
								</thead>
								<tbody>
									
								
									<?php if(!empty($logistics)): ?>
										<?php foreach($logistics as $i): ?>
											<tr>
												<td><input type="checkbox" name="bid[]" value="<?php echo $i['id']; ?>" /></td>
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
							
							<?= $this->Form->button(__('Receive Selected Item'), [
								'type' => 'button',
								'form' => '#settings_form',
								'id'	=> 'btnreceiveall',
								'action' => 'new',
								'url'	=> $this->Url->build(['controller' => 'logistics', 'action' => 'editajax']),
								'class' => 'btn btn-success pull-right m-t-30 m-b-30'
							]) ?>
							
							<?= $this->Form->end() ?>
							
						</div>
					


