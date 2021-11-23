<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Receife[]|\Cake\Collection\CollectionInterface $receives
 */
?>
<div class="receives index content">
    <?= $this->Html->link(__('New Receife'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Receives') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('refid') ?></th>
                    <th><?= $this->Paginator->sort('receiveable_id') ?></th>
                    <th><?= $this->Paginator->sort('school_id') ?></th>
                    <th><?= $this->Paginator->sort('office_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('received_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($receives as $receife): ?>
                <tr>
                    <td><?= $this->Number->format($receife->id) ?></td>
                    <td><?= h($receife->refid) ?></td>
                    <td><?= $this->Number->format($receife->receiveable_id) ?></td>
                    <td><?= $receife->has('school') ? $this->Html->link($receife->school->name, ['controller' => 'Schools', 'action' => 'view', $receife->school->id]) : '' ?></td>
                    <td><?= $receife->has('office') ? $this->Html->link($receife->office->name, ['controller' => 'Offices', 'action' => 'view', $receife->office->id]) : '' ?></td>
                    <td><?= $receife->has('user') ? $this->Html->link($receife->user->id, ['controller' => 'Users', 'action' => 'view', $receife->user->id]) : '' ?></td>
                    <td><?= h($receife->received_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $receife->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $receife->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $receife->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receife->id)]) ?>
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
