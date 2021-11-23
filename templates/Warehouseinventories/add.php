<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Warehouseinventory $warehouseinventory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Warehouseinventories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="warehouseinventories form content">
            <?= $this->Form->create($warehouseinventory) ?>
            <fieldset>
                <legend><?= __('Add Warehouseinventory') ?></legend>
                <?php
                    echo $this->Form->control('warehouse_id', ['options' => $warehouses]);
                    echo $this->Form->control('logistic_id', ['options' => $logistics]);
                    echo $this->Form->control('item_series');
                    echo $this->Form->control('qty');
                    echo $this->Form->control('received_by');
                    echo $this->Form->control('received_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
