<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Officeitem[]|\Cake\Collection\CollectionInterface $officeitems
 */
?>
<div class="officeitems index content">
    <?= $this->Html->link(__('New Officeitem'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Officeitems') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('school_id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($officeitems as $officeitem): ?>
                <tr>
                    <td><?= $this->Number->format($officeitem->id) ?></td>
                    <td><?= $officeitem->has('school') ? $this->Html->link($officeitem->school->name, ['controller' => 'Schools', 'action' => 'view', $officeitem->school->id]) : '' ?></td>
                    <td><?= $officeitem->has('product') ? $this->Html->link($officeitem->product->name, ['controller' => 'Products', 'action' => 'view', $officeitem->product->id]) : '' ?></td>
                    <td><?= $this->Number->format($officeitem->qty) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $officeitem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $officeitem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $officeitem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $officeitem->id)]) ?>
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
