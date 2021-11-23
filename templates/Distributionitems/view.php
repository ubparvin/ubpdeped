<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Distributionitem $distributionitem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Distributionitem'), ['action' => 'edit', $distributionitem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Distributionitem'), ['action' => 'delete', $distributionitem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $distributionitem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Distributionitems'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Distributionitem'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="distributionitems view content">
            <h3><?= h($distributionitem->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Distribution') ?></th>
                    <td><?= $distributionitem->has('distribution') ? $this->Html->link($distributionitem->distribution->id, ['controller' => 'Distributions', 'action' => 'view', $distributionitem->distribution->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $distributionitem->has('product') ? $this->Html->link($distributionitem->product->name, ['controller' => 'Products', 'action' => 'view', $distributionitem->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Program') ?></th>
                    <td><?= $distributionitem->has('program') ? $this->Html->link($distributionitem->program->name, ['controller' => 'Programs', 'action' => 'view', $distributionitem->program->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($distributionitem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Qty') ?></th>
                    <td><?= $this->Number->format($distributionitem->qty) ?></td>
                </tr>
                <tr>
                    <th><?= __('Added') ?></th>
                    <td><?= h($distributionitem->added) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
