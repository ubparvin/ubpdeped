<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Receivable $receivable
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Receivables'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="receivables form content">
            <?= $this->Form->create($receivable) ?>
            <fieldset>
                <legend><?= __('Add Receivable') ?></legend>
                <?php
                    echo $this->Form->control('refid');
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('order_id', ['options' => $orders]);
                    echo $this->Form->control('school_id', ['options' => $schools]);
                    echo $this->Form->control('office_id', ['options' => $offices]);
                    echo $this->Form->control('estimated_delivery');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
