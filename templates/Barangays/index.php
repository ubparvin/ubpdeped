<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Barangay[]|\Cake\Collection\CollectionInterface $barangays
 */
?>
<div class="barangays index content">
    <?= $this->Html->link(__('New Barangay'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Barangays') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('brgyCode') ?></th>
                    <th><?= $this->Paginator->sort('regCode') ?></th>
                    <th><?= $this->Paginator->sort('provCode') ?></th>
                    <th><?= $this->Paginator->sort('citymunCode') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barangays as $barangay): ?>
                <tr>
                    <td><?= $this->Number->format($barangay->id) ?></td>
                    <td><?= h($barangay->brgyCode) ?></td>
                    <td><?= h($barangay->regCode) ?></td>
                    <td><?= h($barangay->provCode) ?></td>
                    <td><?= h($barangay->citymunCode) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $barangay->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $barangay->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $barangay->id], ['confirm' => __('Are you sure you want to delete # {0}?', $barangay->id)]) ?>
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
