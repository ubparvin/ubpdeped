<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Receivable $receivable
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Receivable'), ['action' => 'edit', $receivable->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Receivable'), ['action' => 'delete', $receivable->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receivable->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Receivables'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Receivable'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="receivables view content">
            <h3><?= h($receivable->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Refid') ?></th>
                    <td><?= h($receivable->refid) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $receivable->has('user') ? $this->Html->link($receivable->user->id, ['controller' => 'Users', 'action' => 'view', $receivable->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $receivable->has('order') ? $this->Html->link($receivable->order->id, ['controller' => 'Orders', 'action' => 'view', $receivable->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('School') ?></th>
                    <td><?= $receivable->has('school') ? $this->Html->link($receivable->school->name, ['controller' => 'Schools', 'action' => 'view', $receivable->school->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Office') ?></th>
                    <td><?= $receivable->has('office') ? $this->Html->link($receivable->office->name, ['controller' => 'Offices', 'action' => 'view', $receivable->office->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($receivable->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Estimated Delivery') ?></th>
                    <td><?= h($receivable->estimated_delivery) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($receivable->created) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
