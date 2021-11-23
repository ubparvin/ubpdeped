<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schoolinventory[]|\Cake\Collection\CollectionInterface $schoolinventories
 */
?>
<div class="schoolinventories index content">
    <?= $this->Html->link(__('New Schoolinventory'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Schoolinventories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('school_id') ?></th>
                    <th><?= $this->Paginator->sort('logistic_id') ?></th>
                    <th><?= $this->Paginator->sort('item_series') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('received_by') ?></th>
                    <th><?= $this->Paginator->sort('received_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($schoolinventories as $schoolinventory): ?>
                <tr>
                    <td><?= $this->Number->format($schoolinventory->id) ?></td>
                    <td><?= $schoolinventory->has('school') ? $this->Html->link($schoolinventory->school->name, ['controller' => 'Schools', 'action' => 'view', $schoolinventory->school->id]) : '' ?></td>
                    <td><?= $schoolinventory->has('logistic') ? $this->Html->link($schoolinventory->logistic->id, ['controller' => 'Logistics', 'action' => 'view', $schoolinventory->logistic->id]) : '' ?></td>
                    <td><?= h($schoolinventory->item_series) ?></td>
                    <td><?= h($schoolinventory->qty) ?></td>
                    <td><?= h($schoolinventory->received_by) ?></td>
                    <td><?= h($schoolinventory->received_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $schoolinventory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $schoolinventory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $schoolinventory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolinventory->id)]) ?>
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
