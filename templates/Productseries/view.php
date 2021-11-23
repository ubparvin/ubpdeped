<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Productseries $productseries
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Productseries'), ['action' => 'edit', $productseries->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Productseries'), ['action' => 'delete', $productseries->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productseries->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Productseries'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Productseries'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productseries view content">
            <h3><?= h($productseries->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $productseries->has('product') ? $this->Html->link($productseries->product->name, ['controller' => 'Products', 'action' => 'view', $productseries->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Series') ?></th>
                    <td><?= h($productseries->series) ?></td>
                </tr>
                <tr>
                    <th><?= __('Start') ?></th>
                    <td><?= h($productseries->start) ?></td>
                </tr>
                <tr>
                    <th><?= __('End') ?></th>
                    <td><?= h($productseries->end) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($productseries->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($productseries->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received By') ?></th>
                    <td><?= $this->Number->format($productseries->received_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Receive') ?></th>
                    <td><?= h($productseries->receive) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
