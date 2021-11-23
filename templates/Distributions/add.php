<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Distribution $distribution
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Distributions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="distributions form content">
            <?= $this->Form->create($distribution) ?>
            <fieldset>
                <legend><?= __('Add Distribution') ?></legend>
                <?php
                    echo $this->Form->control('refid');
                    echo $this->Form->control('program_id', ['options' => $programs, 'empty' => true]);
                    echo $this->Form->control('school_id', ['options' => $schools]);
                    echo $this->Form->control('region_id', ['options' => $regions]);
                    echo $this->Form->control('province_id', ['options' => $provinces]);
                    echo $this->Form->control('city_id', ['options' => $cities]);
                    echo $this->Form->control('barangay_id', ['options' => $barangays]);
                    echo $this->Form->control('sitio');
                    echo $this->Form->control('address');
                    echo $this->Form->control('userid');
                    echo $this->Form->control('status');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
