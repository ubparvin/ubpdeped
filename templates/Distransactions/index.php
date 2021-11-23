<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Distransaction[]|\Cake\Collection\CollectionInterface $distransactions
 */
?>
<div class="distransactions index content">
    <?= $this->Html->link(__('New Distransaction'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Distransactions') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('int') ?></th>
                    <th><?= $this->Paginator->sort('distribution_id') ?></th>
                    <th><?= $this->Paginator->sort('received') ?></th>
                    <th><?= $this->Paginator->sort('release') ?></th>
                    <th><?= $this->Paginator->sort('type') ?></th>
                    <th><?= $this->Paginator->sort('userid') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($distransactions as $distransaction): ?>
                <tr>
                    <td><?= $this->Number->format($distransaction->int) ?></td>
                    <td><?= $distransaction->has('distribution') ? $this->Html->link($distransaction->distribution->id, ['controller' => 'Distributions', 'action' => 'view', $distransaction->distribution->id]) : '' ?></td>
                    <td><?= h($distransaction->received) ?></td>
                    <td><?= h($distransaction->release) ?></td>
                    <td><?= h($distransaction->type) ?></td>
                    <td><?= $this->Number->format($distransaction->userid) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $distransaction->int]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $distransaction->int]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $distransaction->int], ['confirm' => __('Are you sure you want to delete # {0}?', $distransaction->int)]) ?>
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
