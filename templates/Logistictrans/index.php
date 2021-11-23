<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Logistictran[]|\Cake\Collection\CollectionInterface $logistictrans
 */
?>
<div class="logistictrans index content">
    <?= $this->Html->link(__('New Logistictran'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Logistictrans') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('logistic_id') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('date') ?></th>
                    <th><?= $this->Paginator->sort('pa_refid') ?></th>
                    <th><?= $this->Paginator->sort('pa_name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logistictrans as $logistictran): ?>
                <tr>
                    <td><?= $this->Number->format($logistictran->id) ?></td>
                    <td><?= $logistictran->has('logistic') ? $this->Html->link($logistictran->logistic->id, ['controller' => 'Logistics', 'action' => 'view', $logistictran->logistic->id]) : '' ?></td>
                    <td><?= h($logistictran->status) ?></td>
                    <td><?= h($logistictran->date) ?></td>
                    <td><?= h($logistictran->pa_refid) ?></td>
                    <td><?= h($logistictran->pa_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $logistictran->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $logistictran->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $logistictran->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logistictran->id)]) ?>
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
