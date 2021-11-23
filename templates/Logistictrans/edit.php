<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Logistictran $logistictran
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $logistictran->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $logistictran->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Logistictrans'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="logistictrans form content">
            <?= $this->Form->create($logistictran) ?>
            <fieldset>
                <legend><?= __('Edit Logistictran') ?></legend>
                <?php
                    echo $this->Form->control('logistic_id', ['options' => $logistics]);
                    echo $this->Form->control('status');
                    echo $this->Form->control('date');
                    echo $this->Form->control('pa_refid');
                    echo $this->Form->control('pa_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
