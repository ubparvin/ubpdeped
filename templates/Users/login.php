

		<div class="login-page">
			<div class="form">
				<div class="row">
				<div class="col-md-7">
					<?php echo $this->Html->image('logo_1.png', array('width' => '220px')); ?>
				</div>
				<div class="col-md-4">
				<?php echo $this->Html->image('logo_2.png', array('width' => '140px')); ?>
				</div>
				<div class="clear"></div>
				</div>
				<div class="separator"></div>
				
				<h1 class="nopadding nomargin bold fs-20 text-primary">INVENTORY MANAGEMENT SYSTEM</h1>
				<h6 class="nopadding nomargin bold fs-10 m-b-20 text-primary">
					SIGN-IN TO CONTINUE
				</h6>
				<?= $this->Form->create($user, [
					'url' => [
						'controller' => 'users',
						'action' => 'login'
					],
					'class' => 'user',
					'id' => 'default_form'
				]) ?>
				
					<?= $this->Flash->render() ?>
					
					<div class="row">
					<div class="col-md-6 nopadding">
					<?php echo $this->Form->control('username', [
							'placeholder' => 'USERNAME', 
							'label' => false, 
							'maxlength' => 20,
							'class' => 'numbers_and_letters username nooutline bold color-ccc noshadow noborder form-control input-lg graybg'
						]); ?>					
					</div>
					<div class="col-md-6 nopadding">
					<?php echo $this->Form->control('password', [
						'placeholder' => 'PASSWORD', 
						'label' => false, 
						'maxlength' => 20,
						'class' => 'numbers_and_letters password nooutline bold color-ccc noshadow noborder form-control input-lg graybg'
						]); ?>
						
					</div>
						<?php echo $this->Form->button(__('CONTINUE'), [
						'type' => 'submit',
						'class' => 'btn btn-danger bold noborder nooutline'
					]); ?>
					<div class="clear"></div>
					</div>		
				
				
				
				<?php echo $this->Form->end(); ?>
				
					<div class="col-md-12 m-t-30">
						<?php 
						
							echo $this->Html->link('FORGOT PASSWORD', 
							['controller' => 'users', 'action' => 'forgotpassword'],
							['escape' => false, 'class' => 'm-r-10 fs-10 bold']);
						?>
						
						<?php 
						
							echo $this->Html->link('REGISTER WITH CODE', 
							['controller' => 'users', 'action' => 'forgotpassword'],
							['escape' => false, 'class' => 'm-l-10 fs-10 bold']);
						?>
					</div>
			</div>
		</div>
	




