<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Diststaging[]|\Cake\Collection\CollectionInterface $diststagings
 */
?>
<div class="diststagings index content">
    <?= $this->Html->link(__('New Diststaging'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Diststagings') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('code') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($diststagings as $diststaging): ?>
                <tr>
                    <td><?= $this->Number->format($diststaging->id) ?></td>
                    <td><?= h($diststaging->code) ?></td>
                    <td><?= h($diststaging->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $diststaging->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $diststaging->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $diststaging->id], ['confirm' => __('Are you sure you want to delete # {0}?', $diststaging->id)]) ?>
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
