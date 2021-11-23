<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Productimage[]|\Cake\Collection\CollectionInterface $productimages
 */
?>
<div class="productimages index content">
    <?= $this->Html->link(__('New Productimage'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Productimages') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('added') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productimages as $productimage): ?>
                <tr>
                    <td><?= $this->Number->format($productimage->id) ?></td>
                    <td><?= $productimage->has('product') ? $this->Html->link($productimage->product->name, ['controller' => 'Products', 'action' => 'view', $productimage->product->id]) : '' ?></td>
                    <td><?= h($productimage->added) ?></td>
                    <td><?= h($productimage->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $productimage->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productimage->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productimage->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productimage->id)]) ?>
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
