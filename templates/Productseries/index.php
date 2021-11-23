<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Productseries[]|\Cake\Collection\CollectionInterface $productseries
 */
?>
<div class="productseries index content">
    <?= $this->Html->link(__('New Productseries'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Productseries') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('series') ?></th>
                    <th><?= $this->Paginator->sort('start') ?></th>
                    <th><?= $this->Paginator->sort('end') ?></th>
                    <th><?= $this->Paginator->sort('qty') ?></th>
                    <th><?= $this->Paginator->sort('receive') ?></th>
                    <th><?= $this->Paginator->sort('received_by') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productseries as $productseries): ?>
                <tr>
                    <td><?= $this->Number->format($productseries->id) ?></td>
                    <td><?= $productseries->has('product') ? $this->Html->link($productseries->product->name, ['controller' => 'Products', 'action' => 'view', $productseries->product->id]) : '' ?></td>
                    <td><?= h($productseries->series) ?></td>
                    <td><?= h($productseries->start) ?></td>
                    <td><?= h($productseries->end) ?></td>
                    <td><?= $this->Number->format($productseries->qty) ?></td>
                    <td><?= h($productseries->receive) ?></td>
                    <td><?= $this->Number->format($productseries->received_by) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $productseries->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productseries->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productseries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productseries->id)]) ?>
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
