<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Schoolitem $schoolitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Schoolitem'), ['action' => 'edit', $schoolitem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Schoolitem'), ['action' => 'delete', $schoolitem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schoolitem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Schoolitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Schoolitem'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schoolitems view content">
            <h3><?= h($schoolitem->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('School') ?></th>
                    <td><?= $schoolitem->has('school') ? $this->Html->link($schoolitem->school->name, ['controller' => 'Schools', 'action' => 'view', $schoolitem->school->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $schoolitem->has('product') ? $this->Html->link($schoolitem->product->name, ['controller' => 'Products', 'action' => 'view', $schoolitem->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($schoolitem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($schoolitem->qty) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
