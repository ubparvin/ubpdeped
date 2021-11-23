<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Warehouseinventory[]|\Cake\Collection\CollectionInterface $warehouseinventories
 */
?>
<div class="warehouseinventories index content">
    <?= $this->Html->link(__('New Warehouseinventory'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Warehouseinventories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('warehouse_id') ?></th>
                    <th><?= $this->Paginator->sort('logistic_id') ?></th>
                    <th><?= $this->Paginator->sort('item_series') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('received_by') ?></th>
                    <th><?= $this->Paginator->sort('received_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($warehouseinventories as $warehouseinventory): ?>
                <tr>
                    <td><?= $this->Number->format($warehouseinventory->id) ?></td>
                    <td><?= $warehouseinventory->has('warehouse') ? $this->Html->link($warehouseinventory->warehouse->name, ['controller' => 'Warehouses', 'action' => 'view', $warehouseinventory->warehouse->id]) : '' ?></td>
                    <td><?= $warehouseinventory->has('logistic') ? $this->Html->link($warehouseinventory->logistic->id, ['controller' => 'Logistics', 'action' => 'view', $warehouseinventory->logistic->id]) : '' ?></td>
                    <td><?= h($warehouseinventory->item_series) ?></td>
                    <td><?= h($warehouseinventory->qty) ?></td>
                    <td><?= h($warehouseinventory->received_by) ?></td>
                    <td><?= h($warehouseinventory->received_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $warehouseinventory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $warehouseinventory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $warehouseinventory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $warehouseinventory->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
