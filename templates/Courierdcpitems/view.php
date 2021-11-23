
<div class="row">
	<div class="col-md-6 nopadding-right">
		<?php echo $this->element('sticker/dcp', ['courierdcpitem' => $courierdcpitem]); ?>
	</div>
	<div class="col-md-6 nopadding-right">
		<div class="col-lg-12 col-md-12">
				<?= $this->Form->create($courierdcpitem, [
					'url' => [
						'controller' => 'groups',
						'action' => 'saveajax'
					],
					'class' => 'groups',
					'id' => 'settings_form'
				]) ?>
				
	
				
				<div class="form-group">
					<div class="row">
						
						<?php if($courierdcpitem->status=="1"): ?>
						<div class="col-md-12">
							<div class="fs-10 text-danger">DISPATCHED DATE</div>
							<div class="fs-16 bold text-success"><?php echo $courierdcpitem->dispatch_date; ?></div>
						</div>
						<?php endif; ?>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('school', 
							['label' => 'School Name <span class="m-l-2 text-danger">*</span>', 
							'rows' => 4,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('school_beis', 
							['label' => 'School ID No. <span class="m-l-2 text-danger">*</span>', 
							'type' => 'text',
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('address', 
							['label' => 'Address <span class="m-l-2 text-danger">*</span>', 
							'rows' => 4,
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						<div class="col-md-12">
						 <?php echo $this->Form->control('cust_name', 
							['label' => 'School Custodian <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'allcaps noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('cust_contact', 
							['label' => 'Contact No. <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'contact_no noradius form-control']
						); ?>
						</div>
						
						<div class="col-md-12">
						 <?php echo $this->Form->control('cust_email', 
							['label' => 'Email <span class="m-l-2 text-danger">*</span>', 
							'escape' => false, 'class' => 'noradius form-control']
						); ?>
						</div>
						
					</div>
				</div>
				
				<?php 
					
					$txt = ($courierdcpitem->status=="1") ? "Save Changes" : "Continue Dispatch";
					
					echo $this->Html->link('Print Sticker', 
					['controller' => 'courierdcpitems', 'action' => 'printsticker', $id, $courierdcpitem->couriercontract->id],
					['target' => '_blank', 'escape' => false, 'class' => 'btn btn-warning pull-left m-t-30 m-b-30']
					);
				?>
				
				<?= $this->Form->button($txt, [
					'type' => 'button',
					'form' => '#settings_form',
					'id'	=> 'btndispatch',
					'action' => 'new',
					'url'	=> $this->Url->build(['controller' => 'courierdcpitems', 'action' => 'editajax', $id]),
					'class' => 'btn btn-success pull-right m-t-30 m-b-30'
				]) ?>
				
				<?= $this->Form->end() ?>
	</div>
	</div>
</div>