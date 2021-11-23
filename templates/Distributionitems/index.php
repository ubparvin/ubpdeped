<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Distributionitem[]|\Cake\Collection\CollectionInterface $distributionitems
 */
?>
<div class="distributionitems index content">
    <?= $this->Html->link(__('New Distributionitem'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Distributionitems') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('distribution_id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('program_id') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('added') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($distributionitems as $distributionitem): ?>
                <tr>
                    <td><?= $this->Number->format($distributionitem->id) ?></td>
                    <td><?= $distributionitem->has('distribution') ? $this->Html->link($distributionitem->distribution->id, ['controller' => 'Distributions', 'action' => 'view', $distributionitem->distribution->id]) : '' ?></td>
                    <td><?= $distributionitem->has('product') ? $this->Html->link($distributionitem->product->name, ['controller' => 'Products', 'action' => 'view', $distributionitem->product->id]) : '' ?></td>
                    <td><?= $distributionitem->has('program') ? $this->Html->link($distributionitem->program->name, ['controller' => 'Programs', 'action' => 'view', $distributionitem->program->id]) : '' ?></td>
                    <td><?= $this->Number->format($distributionitem->qty) ?></td>
                    <td><?= h($distributionitem->added) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $distributionitem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $distributionitem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $distributionitem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $distributionitem->id)]) ?>
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
