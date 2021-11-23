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
            <?= $this->Html->link(__('Edit Warehouseinventory'), ['action' => 'edit', $warehouseinventory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Warehouseinventory'), ['action' => 'delete', $warehouseinventory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $warehouseinventory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Warehouseinventories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Warehouseinventory'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="warehouseinventories view content">
            <h3><?= h($warehouseinventory->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Warehouse') ?></th>
                    <td><?= $warehouseinventory->has('warehouse') ? $this->Html->link($warehouseinventory->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $warehouseinventory->warehouse->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Logistic') ?></th>
                    <td><?= $warehouseinventory->has('logistic') ? $this->Html->link($warehouseinventory->logistic->id, ['controller' => 'Logistics', 'action' => 'view', $warehouseinventory->logistic->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Item Series') ?></th>
                    <td><?= h($warehouseinventory->item_series) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= h($warehouseinventory->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received By') ?></th>
                    <td><?= h($warehouseinventory->received_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($warehouseinventory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received Date') ?></th>
                    <td><?= h($warehouseinventory->received_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
