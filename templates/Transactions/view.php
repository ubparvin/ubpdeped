<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Transaction $transaction
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Transaction'), ['action' => 'edit', $transaction->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Transaction'), ['action' => 'delete', $transaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $transaction->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Transactions'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Transaction'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="transactions view content">
            <h3><?= h($transaction->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Type') ?></th>
                    <td><?= h($transaction->type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $transaction->has('product') ? $this->Html->link($transaction->product->name, ['controller' => 'Products', 'action' => 'view', $transaction->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($transaction->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Current Qty') ?></th>
                    <td><?= $this->Number->format($transaction->current_qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Added Qty') ?></th>
                    <td><?= $this->Number->format($transaction->added_qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('New Qty') ?></th>
                    <td><?= $this->Number->format($transaction->new_qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Trans By') ?></th>
                    <td><?= $this->Number->format($transaction->trans_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($transaction->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
