<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Receivable[]|\Cake\Collection\CollectionInterface $receivables
 */
?>
<div class="receivables index content">
    <?= $this->Html->link(__('New Receivable'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Receivables') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('refid') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('order_id') ?></th>
                    <th><?= $this->Paginator->sort('school_id') ?></th>
                    <th><?= $this->Paginator->sort('office_id') ?></th>
                    <th><?= $this->Paginator->sort('estimated_delivery') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($receivables as $receivable): ?>
                <tr>
                    <td><?= $this->Number->format($receivable->id) ?></td>
                    <td><?= h($receivable->refid) ?></td>
                    <td><?= $receivable->has('user') ? $this->Html->link($receivable->user->id, ['controller' => 'Users', 'action' => 'view', $receivable->user->id]) : '' ?></td>
                    <td><?= $receivable->has('order') ? $this->Html->link($receivable->order->id, ['controller' => 'Orders', 'action' => 'view', $receivable->order->id]) : '' ?></td>
                    <td><?= $receivable->has('school') ? $this->Html->link($receivable->school->name, ['controller' => 'Schools', 'action' => 'view', $receivable->school->id]) : '' ?></td>
                    <td><?= $receivable->has('office') ? $this->Html->link($receivable->office->name, ['controller' => 'Offices', 'action' => 'view', $receivable->office->id]) : '' ?></td>
                    <td><?= h($receivable->estimated_delivery) ?></td>
                    <td><?= h($receivable->created) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $receivable->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $receivable->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $receivable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receivable->id)]) ?>
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
