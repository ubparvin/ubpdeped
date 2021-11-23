<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Courierdcpitem $courierdcpitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Courierdcpitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="courierdcpitems form content">
            <?= $this->Form->create($courierdcpitem) ?>
            <fieldset>
                <legend><?= __('Add Courierdcpitem') ?></legend>
                <?php
                    echo $this->Form->control('true');
                    echo $this->Form->control('region');
                    echo $this->Form->control('division');
                    echo $this->Form->control('school');
                    echo $this->Form->control('municipality');
                    echo $this->Form->control('barangay');
                    echo $this->Form->control('address');
                    echo $this->Form->control('package_no');
                    echo $this->Form->control('latop');
                    echo $this->Form->control('smart_tv');
                    echo $this->Form->control('lapel');
                    echo $this->Form->control('package_lms');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
