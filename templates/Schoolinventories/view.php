<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schoolinventory $schoolinventory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Schoolinventory'), ['action' => 'edit', $schoolinventory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Schoolinventory'), ['action' => 'delete', $schoolinventory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolinventory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Schoolinventories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Schoolinventory'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schoolinventories view content">
            <h3><?= h($schoolinventory->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('School') ?></th>
                    <td><?= $schoolinventory->has('school') ? $this->Html->link($schoolinventory->school->name, ['controller' => 'Schools', 'action' => 'view', $schoolinventory->school->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Logistic') ?></th>
                    <td><?= $schoolinventory->has('logistic') ? $this->Html->link($schoolinventory->logistic->id, ['controller' => 'Logistics', 'action' => 'view', $schoolinventory->logistic->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Item Series') ?></th>
                    <td><?= h($schoolinventory->item_series) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= h($schoolinventory->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received By') ?></th>
                    <td><?= h($schoolinventory->received_by) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($schoolinventory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Received Date') ?></th>
                    <td><?= h($schoolinventory->received_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
