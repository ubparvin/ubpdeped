
	<div class="modal" tabindex="-1" id="form_content">
  <div class="modal-dialog modal-xs noradius">
    <div class="modal-content noradius">
      <div class="modal-header">
        <h5 class="modal-title fs-11 bold text-uppercase"><?php echo $title; ?></h5>
		
        <a href="#" data-dismiss="modal" aria-label="Close"><i class="fas fa-fw fa-times-circle"></i></a>
      </div>
      <div class="modal-body">
		
		<?php echo $this->element($element, ['group' => $group]); ?>

      </div>
          <?php echo $this->element('notification/modal_loading'); ?>
    </div>
    </div>
  </div>
</div>
