<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Officeitem $officeitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Officeitem'), ['action' => 'edit', $officeitem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Officeitem'), ['action' => 'delete', $officeitem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $officeitem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Officeitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Officeitem'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="officeitems view content">
            <h3><?= h($officeitem->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('School') ?></th>
                    <td><?= $officeitem->has('school') ? $this->Html->link($officeitem->school->name, ['controller' => 'Schools', 'action' => 'view', $officeitem->school->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $officeitem->has('product') ? $this->Html->link($officeitem->product->name, ['controller' => 'Products', 'action' => 'view', $officeitem->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($officeitem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($officeitem->qty) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
